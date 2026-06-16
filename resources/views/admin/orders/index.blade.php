@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">All Orders</h3>

        <form method="GET" action="{{ route('admin.orders.index') }}">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control me-2"
                placeholder="Search order, customer, restaurant..."
                style="width: 300px;"
            >

            <button type="submit" class="btn btn-primary">
                Search
            </button>

            @if(request('search'))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary ms-2">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Restaurant</th>
                <th>Total</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Date</th>
                <th width="150">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
                @php
                    $orderStatus = strtolower($order->order_status ?? '');
                    $paymentStatus = strtolower($order->payment_status ?? '');

                    $statusClass = match($orderStatus) {
                        'pending' => 'bg-warning',
                        'accepted' => 'bg-primary',
                        'preparing' => 'bg-info',
                        'ready', 'completed', 'delivered' => 'bg-success',
                        'cancelled' => 'bg-danger',
                        default => 'bg-secondary',
                    };

                    $paymentClass = match($paymentStatus) {
                        'paid' => 'bg-success',
                        'pending' => 'bg-warning',
                        'failed' => 'bg-danger',
                        default => 'bg-secondary',
                    };
                @endphp

                <tr>
                    <td>#{{ $order->order_no }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->restaurant->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>

                    <td>
                        <span class="badge {{ $statusClass }}">
                            {{ ucfirst($order->order_status ?? 'N/A') }}
                        </span>
                    </td>

                    <td>
                        <span class="badge {{ $paymentClass }}">
                            {{ ucfirst($order->payment_status ?? 'N/A') }}
                        </span>
                    </td>

                    <td>{{ optional($order->created_at)->format('d M Y') }}</td>

                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="btn btn-sm btn-primary">
                            View
                        </a>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No orders found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->appends(request()->query())->links() }}
</div>
@endsection