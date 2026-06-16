<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Rider;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $orders = Order::with(['user', 'restaurant', 'rider.user'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('order_no', 'like', "%{$search}%")
                        ->orWhere('order_status', 'like', "%{$search}%")
                        ->orWhere('payment_status', 'like', "%{$search}%")
                        ->orWhere('payment_method', 'like', "%{$search}%")
                        ->orWhere('total_amount', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        })
                        ->orWhereHas('restaurant', function ($restaurantQuery) use ($search) {
                            $restaurantQuery->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('rider.user', function ($riderQuery) use ($search) {
                            $riderQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'search'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user',
            'restaurant',
            'items.foodItem',
            'rider.user',
        ]);

        $riders = Rider::with('user')
            ->where('is_available', 1)
            ->get();

        return view('admin.orders.show', compact('order', 'riders'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|string',
            'payment_status' => 'required|string',
            'payment_method' => 'required|string',
            'delivery_address' => 'nullable|string',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'delivery_fee' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'rider_id' => 'nullable|exists:riders,id',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:order_items,id',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $subtotal = 0;

        foreach ($request->items as $itemData) {
            $item = OrderItem::where('id', $itemData['id'])
                ->where('order_id', $order->id)
                ->firstOrFail();

            $price = (float) $itemData['price'];
            $quantity = (int) $itemData['quantity'];
            $itemTotal = $price * $quantity;

            $item->update([
                'price' => $price,
                'quantity' => $quantity,
                'total' => $itemTotal,
            ]);

            $subtotal += $itemTotal;
        }

        $deliveryFee = (float) $request->delivery_fee;
        $discount = (float) $request->discount;
        $tax = (float) $request->tax;

        $totalAmount = max(0, $subtotal + $deliveryFee + $tax - $discount);

        $order->update([
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'delivery_address' => $request->delivery_address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'discount' => $discount,
            'tax' => $tax,
            'total_amount' => $totalAmount,
        ]);

        if ($request->filled('rider_id')) {
            $order->rider_id = $request->rider_id;
            $order->rider_status = 'assigned';

            if ($order->order_status === 'pending') {
                $order->order_status = 'accepted';
            }
        } else {
            $order->rider_id = null;

            if ($order->order_status === 'accepted') {
                $order->rider_status = 'waiting_rider';
            } else {
                $order->rider_status = null;
            }
        }

        $order->save();

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}