<?php

namespace App\Http\Controllers\API\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\FoodItem;
use App\Models\Category;
use App\Services\CloudinaryService;

class RestaurantFoodController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        $foods = $restaurant
            ? $restaurant->foodItems()->with('category')->latest()->get()
            : collect();

        return view('restaurant.foods.index', compact('foods'));
    }

    public function create()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        if (!$restaurant) {
            return redirect()->route('restaurant.dashboard')
                ->with('error', 'No restaurant profile found for this user.');
        }

        $categories = Category::where('restaurant_id', $restaurant->id)->get();

        return view('restaurant.foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $restaurant = Restaurant::where('user_id', auth()->id())->first();

        if (!$restaurant) {
            return redirect()->route('restaurant.dashboard')
                ->with('error', 'No restaurant profile found for this user.');
        }

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
            ->route('restaurant.foods.index')
            ->with('success', 'Food item added successfully');
    }

    public function edit($id)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $food = FoodItem::where('restaurant_id', $restaurant->id)
            ->findOrFail($id);

        $categories = Category::where('restaurant_id', $restaurant->id)->get();

        return view('restaurant.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $food = FoodItem::where('restaurant_id', $restaurant->id)
            ->findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
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
            ->route('restaurant.foods.index')
            ->with('success', 'Food updated successfully');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $food = FoodItem::where('restaurant_id', $restaurant->id)
            ->findOrFail($id);

        $food->delete();

        return redirect()
            ->route('restaurant.foods.index')
            ->with('success', 'Food deleted successfully');
    }
}