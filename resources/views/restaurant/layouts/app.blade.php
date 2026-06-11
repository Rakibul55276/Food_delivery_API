<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">

    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4>Restaurant Panel</h4>

        <a href="{{ route('restaurant.dashboard') }}" class="d-block text-white mt-4">Dashboard</a>

        <a href="{{ route('restaurant.categories.index') }}"
   class="d-block text-white mt-3">
    Categories
</a>

<a href="{{ route('restaurant.foods.index') }}"
   class="d-block text-white mt-3">
    Food Items
</a>
        <a href="{{ route('restaurant.orders.index') }}" class="d-block text-white mt-3">
    Orders
</a>
        <a href="{{ route('restaurant.profile') }}" class="d-block text-white mt-3">
    Profile
</a>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>

    <div class="p-4 w-100">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </div>

</div>

</body>
</html>