@extends('admin.layouts.app')

@section('content')

<h2>Add Restaurant</h2>

<a href="{{ route('admin.restaurants.index') }}" class="btn btn-secondary mb-3">
    Back
</a>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.restaurants.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="card mb-3">
        <div class="card-header">Owner Information</div>

        <div class="card-body">
            <div class="mb-3">
                <label>Owner Name</label>
                <input type="text" name="owner_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Restaurant Information</div>

        <div class="card-body">
            <div class="mb-3">
                <label>Restaurant Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Latitude</label>
                    <input type="text" name="latitude" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Longitude</label>
                    <input type="text" name="longitude" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
            </div>

            <button class="btn btn-success">
                Save Restaurant
            </button>
        </div>
    </div>

</form>

@endsection