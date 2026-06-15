<?php

namespace App\Services;

use App\Models\Rider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Log;

class FirebaseNotificationService
{
    public static function sendNewOrderToActiveRiders($order): void
    {
        $credentialsPath = storage_path('app/firebase/firebase-service-account.json');

        if (!file_exists($credentialsPath)) {
            Log::error('Firebase service account file not found');
            return;
        }

        $json = json_decode(file_get_contents($credentialsPath), true);
        $projectId = $json['project_id'];

        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

        $credentials = new ServiceAccountCredentials($scopes, $credentialsPath);
        $token = $credentials->fetchAuthToken()['access_token'] ?? null;

        if (!$token) {
            Log::error('Firebase access token not generated');
            return;
        }

        $riders = Rider::where('is_available', 1)
            ->whereNotNull('fcm_token')
            ->get();

        foreach ($riders as $rider) {
            Http::withToken($token)->post(
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
        }
    }
}