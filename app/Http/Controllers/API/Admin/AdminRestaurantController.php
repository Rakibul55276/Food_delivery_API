<?php

namespace App\Http\Controllers\API\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminRestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::latest()->get();

        return view(
            'admin.restaurants.index',
            compact('restaurants')
        );
    }

    public function toggle(Restaurant $restaurant)
    {
        $restaurant->update([
            'is_active' => !$restaurant->is_active
        ]);

        return back()->with(
            'success',
            'Restaurant status updated'
        );
    }


    public function create()
{
    return view('admin.restaurants.create');
}

public function store(Request $request)
{
    $request->validate([
        'owner_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:20',
        'password' => 'required|min:6',

        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    DB::transaction(function () use ($request) {
        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('restaurants', 'public');
        }

        $user = User::create([
            'name' => $request->owner_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'restaurant',
        ]);

        Restaurant::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $logoPath,
            'phone' => $request->phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'is_active' => 1,
        ]);
    });

    return redirect()
        ->route('admin.restaurants.index')
        ->with('success', 'Restaurant created successfully');
}

public function createCategory(Restaurant $restaurant)
{
    return view('admin.restaurants.categories.create', compact('restaurant'));
}

public function storeCategory(Request $request, Restaurant $restaurant)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Category::create([
        'restaurant_id' => $restaurant->id,
        'name' => $request->name,
    ]);

    return redirect()
        ->route('admin.restaurants.show', $restaurant->id)
        ->with('success', 'Category added successfully');
}

public function destroyCategory(Category $category)
{
    if ($category->foodItems()->count() > 0) {
        return back()->with(
            'error',
            'Delete food items first.'
        );
    }

    $restaurantId = $category->restaurant_id;

    $category->delete();

    return redirect()
    ->route('admin.restaurants.show', $restaurantId)
    ->with('success', 'Category deleted successfully');

    return back()->with(
    'error',
    'Delete food items first.'
);
}
public function show(Restaurant $restaurant)
{
    $restaurant->load([
        'user',
        'categories.foodItems',
    ]);

    return view('admin.restaurants.show', compact('restaurant'));
}

public function edit(Restaurant $restaurant)
{
    $restaurant->load('user');

    return view('admin.restaurants.edit', compact('restaurant'));
}

public function update(Request $request, Restaurant $restaurant)
{
    $restaurant->load('user');

    $request->validate([
        'owner_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $restaurant->user_id,
        'phone' => 'nullable|string|max:20',

        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'is_active' => 'required|boolean',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('logo')) {
        if ($restaurant->logo && Storage::disk('public')->exists($restaurant->logo)) {
            Storage::disk('public')->delete($restaurant->logo);
        }

        $restaurant->logo = $request->file('logo')->store('restaurants', 'public');
    }

    $restaurant->user->update([
        'name' => $request->owner_name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    $restaurant->update([
        'name' => $request->name,
        'description' => $request->description,
        'phone' => $request->phone,
        'address' => $request->address,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'is_active' => $request->is_active,
        'logo' => $restaurant->logo,
    ]);

    return redirect()
        ->route('admin.restaurants.show', $restaurant->id)
        ->with('success', 'Restaurant updated successfully');
}
}