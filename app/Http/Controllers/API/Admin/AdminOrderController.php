<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Rider;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'restaurant'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user',
            'restaurant',
            'items.foodItem'
        ]);

        $riders = Rider::with('user')
    ->where('is_available', 1)
    ->get();

        return view('admin.orders.show', compact('order', 'riders'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',

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

            $item->price = $price;
            $item->quantity = $quantity;
            $item->total = $itemTotal;
            $item->save();

            $subtotal += $itemTotal;
        }

        $deliveryFee = (float) $request->delivery_fee;
        $discount = (float) $request->discount;
        $tax = (float) $request->tax;

        $totalAmount = $subtotal + $deliveryFee + $tax - $discount;

        if ($totalAmount < 0) {
            $totalAmount = 0;
        }

        $order->order_status = $request->order_status;
        $order->payment_status = $request->payment_status;
        $order->payment_method = $request->payment_method;
        $order->delivery_address = $request->delivery_address;
        $order->latitude = $request->latitude;
        $order->longitude = $request->longitude;
        $order->subtotal = $subtotal;
        $order->delivery_fee = $deliveryFee;
        $order->discount = $discount;
        $order->tax = $tax;
        $order->total_amount = $totalAmount;
        $order->rider_id = $request->rider_id;

if ($request->rider_id) {
    if ($order->rider_status === null) {
        $order->rider_status = 'assigned';
    }
} else {
    $order->rider_status = null;
}
        $order->save();

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Order updated successfully.');
    }


    public function destroy(Order $order)
{
    $order->delete();

    return redirect()
        ->route('admin.orders.index')
        ->with('success', 'Order deleted successfully.');
}
}