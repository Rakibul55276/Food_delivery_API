<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <div class="card shadow">
            <div class="card-header">
                <h4>Dashboard Login</h4>
            </div>

            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

             <form method="POST" action="{{ route('web.login') }}">
    @csrf

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-primary w-100">
        Login
    </button>
</form>

<hr>

<div class="text-center">
    <p class="mb-2">New Restaurant?</p>

    <a href="{{ route('restaurant.register') }}"
       class="btn btn-success">
        Register Restaurant
    </a>
</div>

            </div>
        </div>
    </div>
</div>

</body>
</html>