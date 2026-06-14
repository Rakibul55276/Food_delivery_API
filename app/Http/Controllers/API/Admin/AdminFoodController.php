<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\Category;
use App\Models\Restaurant;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminFoodController extends Controller
{
    public function create(Restaurant $restaurant)
    {
        $categories = Category::where('restaurant_id', $restaurant->id)->get();

        return view('admin.foods.create', compact('restaurant', 'categories'));
    }

    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('restaurant_id', $restaurant->id),
            ],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = CloudinaryService::upload(
                $request->file('image'),
                'food_delivery/foods'
            );
        }

        FoodItem::create([
            'restaurant_id' => $restaurant->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'image' => $imagePath,
            'is_available' => 1,
        ]);

        return redirect()
            ->route('admin.restaurants.show', $restaurant->id)
            ->with('success', 'Food item added successfully');
    }

    public function edit(FoodItem $food)
    {
        $categories = Category::where('restaurant_id', $food->restaurant_id)->get();

        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, FoodItem $food)
    {
        $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('restaurant_id', $food->restaurant_id),
            ],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $food->image = CloudinaryService::upload(
                $request->file('image'),
                'food_delivery/foods'
            );
        }

        $food->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'image' => $food->image,
        ]);

        return redirect()
            ->route('admin.restaurants.show', $food->restaurant_id)
            ->with('success', 'Food item updated successfully');
    }

    public function destroy(FoodItem $food)
    {
        $restaurantId = $food->restaurant_id;

        $food->delete();

        return redirect()
            ->route('admin.restaurants.show', $restaurantId)
            ->with('success', 'Food item deleted successfully');
    }
}