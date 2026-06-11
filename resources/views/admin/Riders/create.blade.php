@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h3>Create Rider</h3>

        <a href="{{ route('admin.riders.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.riders.store') }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">Login Details</div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control"
                           required>
                </div>

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Rider Details</div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Vehicle Type</label>
                    <input type="text" name="vehicle_type" class="form-control"
                           value="{{ old('vehicle_type') }}"
                           placeholder="Bike / Car">
                </div>

                <div class="mb-3">
                    <label class="form-label">Plate Number</label>
                    <input type="text" name="plate_number" class="form-control"
                           value="{{ old('plate_number') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">License No</label>
                    <input type="text" name="license_no" class="form-control"
                           value="{{ old('license_no') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Latitude</label>
                    <input type="text" name="current_latitude" class="form-control"
                           value="{{ old('current_latitude') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Longitude</label>
                    <input type="text" name="current_longitude" class="form-control"
                           value="{{ old('current_longitude') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Availability</label>
                    <select name="is_available" class="form-select">
                        <option value="1">Available</option>
                        <option value="0">Unavailable</option>
                    </select>
                </div>

            </div>
        </div>

        <button class="btn btn-success">
            Create Rider
        </button>
    </form>
</div>
@endsection