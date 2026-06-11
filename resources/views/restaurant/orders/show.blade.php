@extends('restaurant.layouts.app')

@section('content')

<h2>Order Details</h2>

<a href="{{ route('restaurant.orders.index') }}"
   class="btn btn-secondary btn-sm mb-3">
    Back
</a>

<div class="card mb-3">
    <div class="card-body">
        <h5>{{ $order->order_no }}</h5>
        <p><strong>Customer:</strong> {{ $order->user->name ?? '-' }}</p>
        <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
        <p><strong>Payment:</strong> {{ ucfirst($order->payment_status) }}</p>
    </div>
</div>

<h4>Items</h4>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Image</th>
            <th>Food</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>
                    @if($item->foodItem && $item->foodItem->image)
                        <img src="{{ asset('storage/'.$item->foodItem->image) }}"
                             width="80">
                    @else
                        No image
                    @endif
                </td>

                <td>{{ $item->foodItem->name ?? 'Unknown Item' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>SAR {{ $item->price }}</td>
                <td>SAR {{ $item->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="card">
    <div class="card-body">
        <p><strong>Subtotal:</strong> SAR {{ $order->subtotal }}</p>
        <p><strong>Delivery Fee:</strong> SAR {{ $order->delivery_fee }}</p>
        <h5>Total: SAR {{ $order->total_amount }}</h5>
    </div>
</div>

@endsection