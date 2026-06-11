<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantProfileController extends Controller
{
    public function edit()
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        return view('restaurant.profile.edit', compact('restaurant'));
    }

    public function update(Request $request)
    {
        $restaurant = Restaurant::where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('logo')) {
            $restaurant->logo = $request->file('logo')->store('restaurants', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $restaurant->cover_image = $request->file('cover_image')->store('restaurants/covers', 'public');
        }

        $restaurant->update([
            'name' => $request->name,
            'description' => $request->description,
            'phone' => $request->phone,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'logo' => $restaurant->logo,
            'cover_image' => $restaurant->cover_image,
        ]);

        return redirect()
            ->route('restaurant.profile')
            ->with('success', 'Profile updated successfully');
    }
}