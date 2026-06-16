<?php

namespace App\Http\Controllers\API\Rider;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RiderOrderDecline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $declinedOrderIds = RiderOrderDecline::where('rider_id', $rider->id)
            ->pluck('order_id')
            ->toArray();

        $orders = Order::with([
            'user',
            'restaurant',
            'items.foodItem'
        ])
            ->where(function ($query) use ($rider, $declinedOrderIds) {
                $query->where(function ($q) use ($declinedOrderIds) {
                    $q->whereNull('rider_id')
                        ->where('order_status', 'accepted')
                        ->where('rider_status', 'waiting_rider');

                    if (!empty($declinedOrderIds)) {
                        $q->whereNotIn('id', $declinedOrderIds);
                    }
                })
                ->orWhere(function ($q) use ($rider) {
                    $q->where('rider_id', $rider->id)
                        ->where('rider_status', 'assigned')
                        ->whereIn('order_status', ['accepted', 'ready']);
                })
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

        $declined = RiderOrderDecline::where('rider_id', $rider->id)
            ->where('order_id', $id)
            ->exists();

        if ($declined) {
            return response()->json([
                'message' => 'Order declined by this rider'
            ], 403);
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

        $alreadyDeclined = RiderOrderDecline::where('order_id', $id)
            ->where('rider_id', $rider->id)
            ->exists();

        if ($alreadyDeclined) {
            return response()->json([
                'message' => 'You already declined this order'
            ], 422);
        }

        return DB::transaction(function () use ($rider, $id) {
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
                ->lockForUpdate()
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
        });
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
            ->whereNull('rider_id')
            ->where('rider_status', 'waiting_rider')
            ->firstOrFail();

        RiderOrderDecline::firstOrCreate([
            'order_id' => $order->id,
            'rider_id' => $rider->id,
        ]);

        return response()->json([
            'message' => 'Order declined successfully'
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->status
            ?? $request->order_status
            ?? $request->rider_status;

        $request->merge([
            'order_status' => $status,
        ]);

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

        if ($status === 'picked_up') {
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

        if ($status === 'on_the_way') {
            if ($order->rider_status !== 'picked_up') {
                return response()->json([
                    'message' => 'Order must be picked up first'
                ], 422);
            }

            $order->update([
                'rider_status' => 'on_the_way',
            ]);
        }

        if ($status === 'delivered') {
            if (!in_array($order->rider_status, ['picked_up', 'on_the_way'])) {
                return response()->json([
                    'message' => 'Order must be picked up first'
                ], 422);
            }

            $order->update([
                'order_status' => 'delivered',
                'rider_status' => 'delivered',
                'payment_status' => $order->payment_method === 'cash'
                    ? 'paid'
                    : $order->payment_status,
            ]);
        }

        return response()->json([
            'message' => 'Order status updated successfully',
            'order' => $order->fresh()->load([
                'user',
                'restaurant',
                'items.foodItem'
            ])
        ]);
    }
}