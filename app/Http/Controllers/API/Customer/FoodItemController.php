<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    public function index()
    {
        return response()->json([
            'food_items' => FoodItem::with(['restaurant', 'category'])->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $restaurant = Restaurant::findOrFail($request->restaurant_id);

        if ($restaurant->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $category = Category::findOrFail($request->category_id);

        if ($category->restaurant_id != $request->restaurant_id) {
            return response()->json([
                'message' => 'Category does not belong to this restaurant'
            ], 422);
        }

        $foodItem = FoodItem::create([
            'restaurant_id' => $request->restaurant_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'is_available' => $request->is_available ?? true,
        ]);

        return response()->json([
            'message' => 'Food item created successfully',
            'food_item' => $foodItem
        ], 201);
    }

    public function show(string $id)
    {
        return response()->json([
            'food_item' => FoodItem::with(['restaurant', 'category'])->findOrFail($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $foodItem = FoodItem::findOrFail($id);

        if ($foodItem->restaurant->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $foodItem->update($request->only([
            'category_id',
            'name',
            'description',
            'price',
            'discount_price',
            'is_available',
        ]));

        return response()->json([
            'message' => 'Food item updated successfully',
            'food_item' => $foodItem
        ]);
    }

    public function destroy(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);

        if ($foodItem->restaurant->user_id !== request()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $foodItem->delete();

        return response()->json([
            'message' => 'Food item deleted successfully'
        ]);
    }
}