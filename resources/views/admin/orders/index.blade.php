@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">All Orders</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Restaurant</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->restaurant->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
                   <td>
    @php
        $statusClass = match(strtolower($order->order_status ?? '')) {
            'pending' => 'bg-warning',
            'accepted' => 'bg-primary',
            'preparing' => 'bg-info',
            'ready' => 'bg-success',
            'completed' => 'bg-success',
            'delivered' => 'bg-success',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary',
        };
    @endphp

    <span class="badge {{ $statusClass }}">
        {{ ucfirst($order->order_status ?? 'N/A') }}
    </span>
</td>
                    <td>
    @php
        $paymentClass = match(strtolower($order->payment_status ?? '')) {
            'paid' => 'bg-success',
            'pending' => 'bg-warning',
            'failed' => 'bg-danger',
            default => 'bg-secondary',
        };
    @endphp

    <span class="badge {{ $paymentClass }}">
        {{ ucfirst($order->payment_status ?? 'N/A') }}
    </span>
</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                   <td>
    <a href="{{ route('admin.orders.show', $order->id) }}"
       class="btn btn-sm btn-primary">
        View
    </a>

    <form action="{{ route('admin.orders.destroy', $order->id) }}"
          method="POST"
          style="display:inline-block;"
          onsubmit="return confirm('Are you sure you want to delete this order?');">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-sm btn-danger">
            Delete
        </button>
    </form>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        No orders found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection