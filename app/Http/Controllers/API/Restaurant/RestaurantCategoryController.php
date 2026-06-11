<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;

class RestaurantCategoryController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $categories = Category::where('restaurant_id', $restaurant->id)
            ->latest()
            ->get();

        return view('restaurant.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('restaurant.categories.create');
    }

    public function store(Request $request)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'restaurant_id' => $restaurant->id,
            'name' => $request->name,
        ]);

        return redirect()
            ->route('restaurant.categories.index')
            ->with('success', 'Category added successfully');
    }

    public function edit($id)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $category = Category::where('restaurant_id', $restaurant->id)
            ->findOrFail($id);

        return view('restaurant.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $category = Category::where('restaurant_id', $restaurant->id)
            ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('restaurant.categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $category = Category::where('restaurant_id', $restaurant->id)
            ->findOrFail($id);

        $category->delete();

        return redirect()
            ->route('restaurant.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}