@extends('admin.layouts.app')

@section('content')

<h2>Customer Details</h2>

<a href="{{ route('admin.customers.index') }}"
   class="btn btn-secondary btn-sm mb-3">
    Back
</a>

<div class="card mb-4">
    <div class="card-body">
        <h4>{{ $user->name }}</h4>

        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
    </div>
</div>

<h4>Addresses</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Address</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Default</th>
        </tr>
    </thead>

    <tbody>
        @forelse($user->addresses as $address)
            <tr>
                <td>{{ $address->title }}</td>
                <td>{{ $address->address }}</td>
                <td>{{ $address->latitude }}</td>
                <td>{{ $address->longitude }}</td>
                <td>
                    {{ $address->is_default ? 'Yes' : 'No' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    No addresses found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<h4 class="mt-4">Order History</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Restaurant ID</th>
            <th>Total</th>
            <th>Status</th>
            <th>Payment</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @forelse($user->orders as $order)
            <tr>
                <td>{{ $order->order_no }}</td>
                <td>{{ $order->restaurant_id }}</td>
                <td>SAR {{ $order->total_amount }}</td>
                <td>{{ $order->order_status }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">
                    No orders found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection