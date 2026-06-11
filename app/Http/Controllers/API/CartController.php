<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Cart::with('foodItem')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'cart_items' => $cartItems,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_item_id' => 'required|exists:food_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $foodItem = FoodItem::findOrFail($request->food_item_id);

        $price = $foodItem->discount_price ?? $foodItem->price;

        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('food_item_id', $request->food_item_id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
                'price' => $price,
            ]);
        } else {
            $cartItem = Cart::create([
                'user_id' => $request->user()->id,
                'food_item_id' => $request->food_item_id,
                'quantity' => $request->quantity,
                'price' => $price,
            ]);
        }

        return response()->json([
            'message' => 'Item added to cart successfully',
            'cart_item' => $cartItem->load('foodItem'),
        ], 201);
    }

    public function show(string $id)
    {
        $cartItem = Cart::with('foodItem')->findOrFail($id);

        if ($cartItem->user_id !== request()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'cart_item' => $cartItem,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Cart updated successfully',
            'cart_item' => $cartItem->load('foodItem'),
        ]);
    }

    public function destroy(string $id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id !== request()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from cart successfully',
        ]);
    }
}