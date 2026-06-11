<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRiderController extends Controller
{
    public function index()
    {
        $riders = Rider::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.riders.index', compact('riders'));
    }

    public function create()
    {
        return view('admin.riders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6',

            'vehicle_type' => 'nullable|string|max:255',
            'plate_number' => 'nullable|string|max:255',
            'license_no' => 'nullable|string|max:255',
            'current_latitude' => 'nullable|numeric',
            'current_longitude' => 'nullable|numeric',
            'is_available' => 'nullable|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'rider',
        ]);

        Rider::create([
            'user_id' => $user->id,
            'vehicle_type' => $request->vehicle_type,
            'plate_number' => $request->plate_number,
            'license_no' => $request->license_no,
            'current_latitude' => $request->current_latitude,
            'current_longitude' => $request->current_longitude,
            'is_available' => $request->is_available ?? 1,
        ]);

        return redirect()
            ->route('admin.riders.index')
            ->with('success', 'Rider created successfully.');
    }

    public function show(Rider $rider)
    {
        $rider->load(['user', 'orders']);

        return view('admin.riders.show', compact('rider'));
    }

    public function edit(Rider $rider)
    {
        $rider->load('user');

        return view('admin.riders.edit', compact('rider'));
    }

    public function update(Request $request, Rider $rider)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $rider->user_id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6',

            'vehicle_type' => 'nullable|string|max:255',
            'plate_number' => 'nullable|string|max:255',
            'license_no' => 'nullable|string|max:255',
            'current_latitude' => 'nullable|numeric',
            'current_longitude' => 'nullable|numeric',
            'is_available' => 'nullable|boolean',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'rider',
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $rider->user->update($userData);

        $rider->update([
            'vehicle_type' => $request->vehicle_type,
            'plate_number' => $request->plate_number,
            'license_no' => $request->license_no,
            'current_latitude' => $request->current_latitude,
            'current_longitude' => $request->current_longitude,
            'is_available' => $request->is_available ?? 0,
        ]);

        return redirect()
            ->route('admin.riders.index')
            ->with('success', 'Rider updated successfully.');
    }

    public function toggle(Rider $rider)
    {
        $rider->update([
            'is_available' => !$rider->is_available,
        ]);

        return back()->with('success', 'Rider availability updated.');
    }
}