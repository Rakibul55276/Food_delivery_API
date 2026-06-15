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

        if (!$rider || !$rider->is_available) {
            return response()->json([
                'orders' => []
            ]);
        }

        $orders = Order::with([
            'user',
            'restaurant',
            'items.foodItem'
        ])
        ->where(function ($query) use ($rider) {

            // Orders available for all active riders
            $query->where(function ($q) {
                $q->whereNull('rider_id')
                  ->where('order_status', 'accepted')
                  ->where('rider_status', 'waiting_rider');
            })

            // Orders manually assigned to this rider by admin
            ->orWhere(function ($q) use ($rider) {
                $q->where('rider_id', $rider->id)
                  ->where('rider_status', 'assigned')
                  ->whereIn('order_status', ['accepted', 'ready']);
            })

            // Orders already accepted by this rider
            ->orWhere(function ($q) use ($rider) {
                $q->where('rider_id', $rider->id)
                  ->whereIn('rider_status', [
                      'accepted',
                      'picked_up',
                      'on_the_way'
                  ]);
            });
        })
        ->latest()
        ->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function show(Request $request, $id)
    {
        $rider = $request->user()->rider;

        if (!$rider) {
            return response()->json([
                'message' => 'Rider profile not found'
            ], 404);
        }

        $order = Order::with([
            'user',
            'restaurant',
            'items.foodItem'
        ])
        ->where(function ($query) use ($rider) {
            $query->whereNull('rider_id')
                ->orWhere('rider_id', $rider->id);
        })
        ->findOrFail($id);

        return response()->json([
            'order' => $order
        ]);
    }

    public function accept(Request $request, $id)
    {
        $rider = $request->user()->rider;

        if (!$rider || !$rider->is_available) {
            return response()->json([
                'message' => 'Rider is not available'
            ], 422);
        }

        $order = Order::where('id', $id)
            ->where('order_status', 'accepted')
            ->where(function ($query) use ($rider) {

                // Open order for all riders
                $query->where(function ($q) {
                    $q->whereNull('rider_id')
                      ->where('rider_status', 'waiting_rider');
                })

                // Manually assigned order
                ->orWhere(function ($q) use ($rider) {
                    $q->where('rider_id', $rider->id)
                      ->where('rider_status', 'assigned');
                });
            })
            ->firstOrFail();

        $order->update([
            'rider_id' => $rider->id,
            'rider_status' => 'accepted',
        ]);

        return response()->json([
            'message' => 'Order accepted successfully',
            'order' => $order->load([
                'user',
                'restaurant',
                'items.foodItem'
            ])
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:picked_up,on_the_way,delivered'
        ]);

        $rider = $request->user()->rider;

        if (!$rider) {
            return response()->json([
                'message' => 'Rider profile not found'
            ], 404);
        }

        $order = Order::where('rider_id', $rider->id)
            ->findOrFail($id);

        if ($request->order_status === 'picked_up') {
            if ($order->rider_status !== 'accepted') {
                return response()->json([
                    'message' => 'Accept order first'
                ], 422);
            }

            $order->update([
                'order_status' => 'picked_up',
                'rider_status' => 'picked_up',
            ]);
        }

        if ($request->order_status === 'on_the_way') {
            if ($order->rider_status !== 'picked_up') {
                return response()->json([
                    'message' => 'Order must be picked up first'
                ], 422);
            }

            $order->update([
                'rider_status' => 'on_the_way',
            ]);
        }

        if ($request->order_status === 'delivered') {
            if (!in_array($order->rider_status, ['picked_up', 'on_the_way'])) {
                return response()->json([
                    'message' => 'Order must be picked up first'
                ], 422);
            }

            $order->update([
                'order_status' => 'delivered',
                'rider_status' => 'delivered',
            ]);
        }

        return response()->json([
            'message' => 'Order status updated successfully',
            'order' => $order->load([
                'user',
                'restaurant',
                'items.foodItem'
            ])
        ]);
    }

public function decline(Request $request, $id)
{
    $rider = $request->user()->rider;

    if (!$rider) {
        return response()->json([
            'message' => 'Rider profile not found'
        ], 404);
    }

    $order = Order::where('id', $id)
        ->where('order_status', 'accepted')
        ->where(function ($query) use ($rider) {
            $query->where(function ($q) {
                $q->whereNull('rider_id')
                  ->where('rider_status', 'waiting_rider');
            })
            ->orWhere(function ($q) use ($rider) {
                $q->where('rider_id', $rider->id)
                  ->where('rider_status', 'assigned');
            });
        })
        ->firstOrFail();

    return response()->json([
        'message' => 'Order declined successfully'
    ]);
}
}