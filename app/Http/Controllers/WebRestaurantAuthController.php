<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WebRestaurantAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('restaurant.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'owner_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6',

            'restaurant_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
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
                'name' => $request->restaurant_name,
                'description' => $request->description,
                'logo' => $logoPath,
                'cover_image' => null,
                'phone' => $request->phone,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'is_active' => 1,
            ]);
        });

        return redirect()
            ->route('login')
            ->with('success', 'Restaurant registered successfully. Please login.');
    }
}