<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:255',
            'payment_method' => 'required|in:cash,card,wallet',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $cartItems = Cart::with('foodItem')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'message' => 'Cart is empty'
            ], 422);
        }

        $restaurantId = $cartItems->first()->foodItem->restaurant_id;

        foreach ($cartItems as $item) {
            if ($item->foodItem->restaurant_id != $restaurantId) {
                return response()->json([
                    'message' => 'All cart items must be from the same restaurant'
                ], 422);
            }
        }

        DB::beginTransaction();

        try {
            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $deliveryFee = 5.00;
            $discount = 0.00;
            $tax = 0.00;
            $totalAmount = $subtotal + $deliveryFee + $tax - $discount;

            $order = Order::create([
                'user_id' => $request->user()->id,
                'restaurant_id' => $restaurantId,
                'order_no' => 'ORD-' . time() . '-' . $request->user()->id,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'discount' => $discount,
                'tax' => $tax,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cash' ? 'pending' : 'paid',
                'order_status' => 'pending',
                'delivery_address' => $request->delivery_address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_item_id' => $item->food_item_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->price * $item->quantity,
                ]);
            }

            Cart::where('user_id', $request->user()->id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order->load('items')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Order failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        $order = Order::with('items')->findOrFail($id);

        if ($order->user_id !== request()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'order' => $order
        ]);
    }

    public function update(Request $request, string $id)
    {
        return response()->json([
            'message' => 'Order update will be used later for restaurant/rider status updates'
        ]);
    }

    public function destroy(string $id)
    {
        return response()->json([
            'message' => 'Order delete is disabled'
        ], 403);
    }


    ///////////////////
    public function updateStatus(Request $request, string $id)
{
    $request->validate([
        'order_status' => 'required|in:pending,accepted,preparing,ready,picked_up,delivered,cancelled'
    ]);

    $order = Order::findOrFail($id);

    $order->update([
        'order_status' => $request->order_status
    ]);

    return response()->json([
        'message' => 'Order status updated successfully',
        'order' => $order
    ]);
}
}