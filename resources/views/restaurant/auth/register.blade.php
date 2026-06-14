<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 mb-5">

    <div class="card shadow">
        <div class="card-header">
            <h3>Restaurant Registration</h3>
        </div>

        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Registration Form --}}
            <form method="POST"
                  action="{{ secure_url('/restaurant/register') }}"
                  enctype="multipart/form-data">

                @csrf

                <h5>Owner Information</h5>

                <div class="mb-3">
                    <label>Owner Name</label>
                    <input type="text"
                           name="owner_name"
                           class="form-control"
                           value="{{ old('owner_name') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ old('phone') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <hr>

                <h5>Restaurant Information</h5>

                <div class="mb-3">
                    <label>Restaurant Logo</label>
                    <input type="file"
                           name="logo"
                           class="form-control"
                           accept="image/*">
                </div>

                <div class="mb-3">
                    <label>Restaurant Name</label>
                    <input type="text"
                           name="restaurant_name"
                           class="form-control"
                           value="{{ old('restaurant_name') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description"
                              class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address"
                              class="form-control"
                              required>{{ old('address') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text"
                               name="latitude"
                               class="form-control"
                               value="{{ old('latitude') }}">
                    </div>

                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text"
                               name="longitude"
                               class="form-control"
                               value="{{ old('longitude') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-4">
                    Register Restaurant
                </button>

                <a href="{{ secure_url('/login') }}" class="btn btn-secondary mt-4">
                    Back to Login
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>