@extends('restaurant.layouts.app')

@section('content')

<h2>Restaurant Dashboard</h2>

<p>
    Welcome, {{ auth()->user()->name }}
    @if($restaurant)
        - {{ $restaurant->name }}
    @endif
</p>

<div class="row mt-4">

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Orders</h6>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Pending Orders</h6>
                <h3>{{ $pendingOrders }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Preparing Orders</h6>
                <h3>{{ $preparingOrders }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Ready Orders</h6>
                <h3>{{ $readyOrders }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Delivered Orders</h6>
                <h3>{{ $deliveredOrders }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Cancelled Orders</h6>
                <h3>{{ $cancelledOrders }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Food Items</h6>
                <h3>{{ $foodItemsCount }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Sales</h6>
                <h3>{{ number_format($totalSales, 2) }} SAR</h3>
            </div>
        </div>
    </div>

</div>

<hr class="my-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>New Orders</h4>

    <a href="{{ route('restaurant.orders.index') }}" class="btn btn-outline-primary btn-sm">
        View All Orders
    </a>
</div>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
            <th>Next Action</th>
            <th>Payment</th>
            <th>Date</th>
            <th>View</th>
        </tr>
    </thead>

    <tbody>
        @forelse($newOrders as $order)
            @php
                $nextStatus = null;
                $buttonText = null;
                $buttonClass = 'btn-primary';

                if ($order->order_status == 'pending') {
                    $nextStatus = 'accepted';
                    $buttonText = 'Accept';
                    $buttonClass = 'btn-info';
                } elseif ($order->order_status == 'accepted') {
                    $nextStatus = 'preparing';
                    $buttonText = 'Start Preparing';
                    $buttonClass = 'btn-warning';
                } elseif ($order->order_status == 'preparing') {
                    $nextStatus = 'ready';
                    $buttonText = 'Mark Ready';
                    $buttonClass = 'btn-success';
                }
            @endphp

            <tr>
                <td>{{ $order->order_no }}</td>

                <td>{{ $order->user->name ?? '-' }}</td>

                <td>SAR {{ number_format($order->total_amount, 2) }}</td>

                <td>
                    @if($order->order_status == 'pending')
                        <span class="badge bg-secondary">Pending</span>
                    @elseif($order->order_status == 'accepted')
                        <span class="badge bg-info">Accepted</span>
                    @elseif($order->order_status == 'preparing')
                        <span class="badge bg-warning text-dark">Preparing</span>
                    @elseif($order->order_status == 'ready')
                        <span class="badge bg-success">Ready</span>
                    @else
                        <span class="badge bg-dark">{{ ucfirst($order->order_status) }}</span>
                    @endif
                </td>

                <td>
                    @if($nextStatus)
                        <form action="{{ route('restaurant.orders.updateStatus', $order->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="order_status" value="{{ $nextStatus }}">

                            <button class="btn btn-sm {{ $buttonClass }}">
                                {{ $buttonText }}
                            </button>
                        </form>
                    @else
                        <span class="text-muted">No action</span>
                    @endif

                    @if(in_array($order->order_status, ['pending', 'accepted']))
                        <form action="{{ route('restaurant.orders.updateStatus', $order->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Cancel this order?')">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="order_status" value="cancelled">

                            <button class="btn btn-sm btn-danger">
                                Cancel
                            </button>
                        </form>
                    @endif
                </td>

                <td>{{ ucfirst($order->payment_status) }}</td>

                <td>{{ $order->created_at->format('d M Y') }}</td>

                <td>
                    <a href="{{ route('restaurant.orders.show', $order->id) }}"
                       class="btn btn-sm btn-outline-primary">
                        View
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">
                    No new orders found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection