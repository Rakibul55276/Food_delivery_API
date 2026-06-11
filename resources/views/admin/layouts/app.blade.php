<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="d-flex">

    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4>Admin Panel</h4>

        <a href="{{ route('admin.dashboard') }}" class="d-block text-white mt-4">Dashboard</a>
        <a href="{{ route('admin.restaurants.index') }}"
   class="d-block text-white mt-3">
    Restaurants
</a>
        <a href="{{ route('admin.customers.index') }}" class="d-block text-white mt-3">
    Customers
</a>
        <a href="{{ route('admin.orders.index') }}" class="d-block text-white mt-3">
    Orders
</a>
        <a href="{{ route('admin.riders.index') }}" class="d-block text-white mt-3">
    Riders
</a>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>

    <div class="p-4 w-100">

      @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>
    </div>
@endif

        @yield('content')

    </div>

</div>

</body>
</html>