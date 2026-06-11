<?php

namespace App\Http\Controllers\API\Rider;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class RiderOrderController extends Controller
{
public function index(Request $request)
{
    $rider = $request->user()->rider;

    $orders = Order::with([
        'user',
        'restaurant',
        'items.foodItem'
    ])
    ->where('rider_id', $rider->id)
    ->whereIn('order_status', [
        'accepted',
        'ready',
        'picked_up'
    ])
    ->latest()
    ->get();

    return response()->json([
        'orders' => $orders
    ]);
}

    public function show(Request $request, $id)
    {
        $rider = $request->user()->rider;

        $order = Order::with([
            'user',
            'restaurant',
            'items.foodItem'
        ])
        ->where('rider_id', $rider->id)
        ->findOrFail($id);

        return response()->json([
            'order' => $order
        ]);
    }

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'order_status' => 'required|in:picked_up,delivered'
    ]);

    $rider = $request->user()->rider;

    $order = Order::where('rider_id', $rider->id)
        ->findOrFail($id);

    if ($request->order_status === 'picked_up') {
        if (!in_array($order->order_status, ['accepted', 'ready'])) {
            return response()->json([
                'message' => 'Order is not ready for pickup'
            ], 422);
        }
    }

    if ($request->order_status === 'delivered') {
        if ($order->order_status !== 'picked_up') {
            return response()->json([
                'message' => 'Order must be picked up first'
            ], 422);
        }
    }

    $order->update([
        'order_status' => $request->order_status
    ]);

    return response()->json([
        'message' => 'Order status updated successfully',
        'order' => $order->load([
            'user',
            'restaurant',
            'items.foodItem'
        ])
    ]);
}


public function accept(Request $request, $id)
{
    $rider = $request->user()->rider;

    $order = Order::where('rider_id', $rider->id)
        ->where('order_status', 'accepted')
        ->where('rider_status', 'assigned')
        ->findOrFail($id);

    $order->update([
        'rider_status' => 'accepted',
    ]);

    return response()->json([
        'message' => 'Pickup accepted successfully',
        'order' => $order->load([
            'user',
            'restaurant',
            'items.foodItem'
        ])
    ]);
}
}