@extends('admin.layouts.app')

@section('content')

<h2>Admin Dashboard</h2>

<div class="row mt-4">

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Customers</h6>
                <h3>{{ $totalCustomers }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Restaurants</h6>
                <h3>{{ $totalRestaurants }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Orders</h6>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Revenue</h6>
                <h3>SAR {{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </div>
    </div>

</div>

@endsection