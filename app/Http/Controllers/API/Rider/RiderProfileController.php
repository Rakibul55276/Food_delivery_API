<?php

namespace App\Http\Controllers\API\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiderProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'rider' => $request->user()->load('rider')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable'
        ]);

        $request->user()->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'message' => 'Profile updated successfully'
        ]);
    }

    public function updateFcmToken(Request $request)
{
    $request->validate([
        'fcm_token' => 'required|string',
    ]);

    $rider = $request->user()->rider;

    if (!$rider) {
        return response()->json([
            'message' => 'Rider profile not found'
        ], 404);
    }

    $rider->update([
        'fcm_token' => $request->fcm_token,
    ]);

    return response()->json([
        'message' => 'FCM token updated successfully'
    ]);
}
}