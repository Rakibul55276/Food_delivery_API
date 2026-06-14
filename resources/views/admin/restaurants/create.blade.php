@extends('admin.layouts.app')

@section('content')

{{-- Page Title --}}
<h2>Add Restaurant</h2>

{{-- Back Button --}}
<a href="{{ route('admin.restaurants.index') }}"
   class="btn btn-secondary mb-3">
    Back
</a>

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

{{-- Restaurant Create Form --}}
<form action="{{ route('admin.restaurants.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    {{-- Owner Information --}}
    <div class="card mb-3">
        <div class="card-header">
            Owner Information
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">Owner Name</label>
                <input
                    type="text"
                    name="owner_name"
                    class="form-control"
                    value="{{ old('owner_name') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required
                >
            </div>

        </div>
    </div>

    {{-- Restaurant Information --}}
    <div class="card">
        <div class="card-header">
            Restaurant Information
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">Restaurant Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="3"
                >{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea
                    name="address"
                    class="form-control"
                    rows="3"
                >{{ old('address') }}</textarea>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Latitude</label>
                    <input
                        type="text"
                        name="latitude"
                        class="form-control"
                        value="{{ old('latitude') }}"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Longitude</label>
                    <input
                        type="text"
                        name="longitude"
                        class="form-control"
                        value="{{ old('longitude') }}"
                    >
                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Logo</label>
                <input
                    type="file"
                    name="logo"
                    class="form-control"
                    accept="image/*"
                >

                <small class="text-muted">
                    Upload JPG, JPEG, PNG, or WEBP image.
                </small>
            </div>

            <button type="submit" class="btn btn-success">
                Save Restaurant
            </button>

        </div>
    </div>

</form>

@endsection