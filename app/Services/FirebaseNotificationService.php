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
        Log::info('FCM START', [
            'order_id' => $order->id,
            'order_no' => $order->order_no,
        ]);

        $credentialsPath = storage_path('app/firebase/firebase-service-account.json');

        // Check service account file exists
     Log::error('CHECK FIREBASE FILE', [
    'path' => $credentialsPath,
    'exists' => file_exists($credentialsPath),
]);

if (!file_exists($credentialsPath)) {
    Log::error('Firebase service account file not found');
    return;
}

        try {

            // Read Firebase JSON
            $json = json_decode(
                file_get_contents($credentialsPath),
                true
            );

            $projectId = $json['project_id'] ?? null;

            Log::info('Firebase Project Loaded', [
                'project_id' => $projectId,
            ]);

            if (!$projectId) {
                Log::error('Firebase project_id missing');
                return;
            }

            // Create Access Token
            $scopes = [
                'https://www.googleapis.com/auth/firebase.messaging'
            ];

            $credentials = new ServiceAccountCredentials(
                $scopes,
                $credentialsPath
            );

            $authToken = $credentials->fetchAuthToken();

            $token = $authToken['access_token'] ?? null;

            if (!$token) {
                Log::error('Firebase access token not generated', [
                    'response' => $authToken,
                ]);
                return;
            }

            Log::info('Firebase Access Token Generated');

            // Get Active Riders
            $riders = Rider::where('is_available', 1)
                ->whereNotNull('fcm_token')
                ->get();

            Log::info('Active Riders Found', [
                'count' => $riders->count(),
            ]);

            if ($riders->count() === 0) {
                Log::warning('No active riders with FCM token found');
                return;
            }

            foreach ($riders as $rider) {

                Log::info('Sending Notification', [
                    'rider_id' => $rider->id,
                    'token_preview' => substr($rider->fcm_token, 0, 25),
                ]);

                $response = Http::withToken($token)
                    ->post(
                        "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send",
                        [
                            'message' => [
                                'token' => $rider->fcm_token,

                                'notification' => [
                                    'title' => 'New Delivery Order',
                                    'body' =>
                                        'Order ' .
                                        $order->order_no .
                                        ' is available for pickup',
                                ],

                                'data' => [
                                    'type' => 'new_order',
                                    'order_id' => (string)$order->id,
                                    'order_no' => (string)$order->order_no,
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

            Log::info('FCM FINISHED');

        } catch (\Throwable $e) {

            Log::error('Firebase Notification Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }
}