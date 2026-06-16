<?php

namespace App\Services;

use App\Models\Rider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Google\Auth\Credentials\ServiceAccountCredentials;

class FirebaseNotificationService
{
    public static function sendNewOrderToActiveRiders($order): void
    {
        try {
            $firebaseJson = env('FIREBASE_SERVICE_ACCOUNT_JSON');

            if (!$firebaseJson) {
                Log::error('Firebase service account env missing');
                return;
            }

            $json = json_decode($firebaseJson, true);

            if (!$json || !isset($json['project_id'])) {
                Log::error('Invalid Firebase service account JSON');
                return;
            }

            $projectId = $json['project_id'];

            $tempPath = storage_path('app/firebase-temp.json');
            file_put_contents($tempPath, json_encode($json));

            $credentials = new ServiceAccountCredentials(
                ['https://www.googleapis.com/auth/firebase.messaging'],
                $tempPath
            );

            $authToken = $credentials->fetchAuthToken();
            $token = $authToken['access_token'] ?? null;

            if (!$token) {
                Log::error('Firebase access token not generated', [
                    'response' => $authToken,
                ]);
                return;
            }

            $riders = Rider::where('is_available', 1)
                ->whereNotNull('fcm_token')
                ->get();

            foreach ($riders as $rider) {
                $response = Http::withToken($token)->post(
                    "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send",
                    [
                        'message' => [
                            'token' => $rider->fcm_token,
                            'notification' => [
                                'title' => 'New Delivery Order',
                                'body' => 'Order ' . $order->order_no . ' is available for pickup',
                            ],
                            'data' => [
                                'type' => 'new_order',
                                'order_id' => (string) $order->id,
                                'order_no' => (string) $order->order_no,
                            ],
                            'android' => [
                                'priority' => 'HIGH',
                                'notification' => [
                                    'channel_id' => 'rider_orders_channel',
                                    'sound' => 'default',
                                ],
                            ],
                        ],
                    ]
                );

                Log::info('FCM Response', [
                    'rider_id' => $rider->id,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('Firebase Notification Error', [
                'message' => $e->getMessage(),
            ]);
        }
    }
}