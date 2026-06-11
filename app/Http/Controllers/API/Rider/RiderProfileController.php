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
}