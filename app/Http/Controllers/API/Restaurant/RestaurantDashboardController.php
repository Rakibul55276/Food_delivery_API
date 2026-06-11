<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\FoodItem;
use App\Models\Order;

class RestaurantDashboardController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        $foodItemsCount = 0;
        $totalOrders = 0;
        $pendingOrders = 0;
        $preparingOrders = 0;
        $readyOrders = 0;
        $deliveredOrders = 0;
        $cancelledOrders = 0;
        $totalSales = 0;
        $newOrders = collect();

        if ($restaurant) {
            $foodItemsCount = FoodItem::where('restaurant_id', $restaurant->id)->count();

            $totalOrders = Order::where('restaurant_id', $restaurant->id)->count();

            $pendingOrders = Order::where('restaurant_id', $restaurant->id)
                ->where('order_status', 'pending')
                ->count();

            $preparingOrders = Order::where('restaurant_id', $restaurant->id)
                ->where('order_status', 'preparing')
                ->count();

            $readyOrders = Order::where('restaurant_id', $restaurant->id)
                ->where('order_status', 'ready')
                ->count();

            $deliveredOrders = Order::where('restaurant_id', $restaurant->id)
                ->where('order_status', 'delivered')
                ->count();

            $cancelledOrders = Order::where('restaurant_id', $restaurant->id)
                ->where('order_status', 'cancelled')
                ->count();

            $totalSales = Order::where('restaurant_id', $restaurant->id)
                ->where('payment_status', 'paid')
                ->sum('total_amount');

            $newOrders = Order::with('user')
                ->where('restaurant_id', $restaurant->id)
                ->whereIn('order_status', [
                    'pending',
                    'accepted',
                    'preparing',
                    'ready',
                ])
                ->latest()
                ->take(10)
                ->get();
        }

        return view('restaurant.dashboard', compact(
            'restaurant',
            'foodItemsCount',
            'totalOrders',
            'pendingOrders',
            'preparingOrders',
            'readyOrders',
            'deliveredOrders',
            'cancelledOrders',
            'totalSales',
            'newOrders'
        ));
    }
}