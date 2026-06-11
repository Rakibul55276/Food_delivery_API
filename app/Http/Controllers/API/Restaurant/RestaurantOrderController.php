<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;


class RestaurantOrderController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $orders = Order::where('restaurant_id', $restaurant->id)
            ->with('items.foodItem', 'user')
            ->latest()
            ->get();

        return view('restaurant.orders.index', compact('orders'));
    }

 public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'order_status' => 'required|in:accepted,preparing,ready,cancelled',
    ]);

    $current = $order->order_status;
    $next = $request->order_status;

    $allowed = [
        'pending' => ['accepted', 'cancelled'],
        'accepted' => ['preparing', 'cancelled'],
        'preparing' => ['ready'],
    ];

    if (!isset($allowed[$current]) || !in_array($next, $allowed[$current])) {
        return back()->with('error', 'Invalid status sequence.');
    }

    $order->update([
        'order_status' => $next,
    ]);

    return back()->with('success', 'Order status updated successfully.');
}

public function updatePayment(Request $request, Order $order)
{
    if ($order->payment_status === 'paid') {
        return back()->with('error', 'Payment is already paid. Restaurant cannot change it.');
    }

    $request->validate([
        'payment_status' => 'required|in:pending,paid,failed',
    ]);

    $order->update([
        'payment_status' => $request->payment_status,
    ]);

    return back()->with('success', 'Payment status updated successfully.');
}
public function show(Order $order)
{
    $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

    if ($order->restaurant_id !== $restaurant->id) {
        abort(403);
    }

    $order->load('items.foodItem', 'user');

    return view('restaurant.orders.show', compact('order'));
}

}