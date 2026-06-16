@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h3>Rider Details</h3>

        <a href="{{ route('admin.riders.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header">Login Details</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $rider->user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $rider->user->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $rider->user->phone ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Rider Details</div>
        <div class="card-body">
            <p><strong>Vehicle Type:</strong> {{ $rider->vehicle_type ?? 'N/A' }}</p>
            <p><strong>Plate Number:</strong> {{ $rider->plate_number ?? 'N/A' }}</p>
            <p><strong>License No:</strong> {{ $rider->license_no ?? 'N/A' }}</p>
            <p><strong>Latitude:</strong> {{ $rider->current_latitude ?? 'N/A' }}</p>
            <p><strong>Longitude:</strong> {{ $rider->current_longitude ?? 'N/A' }}</p>
            <p>
                <strong>Availability:</strong>
                @if($rider->is_available)
                    <span class="badge bg-success">Available</span>
                @else
                    <span class="badge bg-danger">Unavailable</span>
                @endif
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Assigned Orders</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rider->orders as $order)
                        <tr>
                            <td>{{ $order->order_no }}</td>
                            <td>{{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ ucfirst($order->order_status) }}</td>
                            <td>{{ ucfirst($order->payment_status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No assigned orders
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection