@extends('admin.layouts.app')

@section('content')

<h2>Edit Restaurant</h2>

<a href="{{ route('admin.restaurants.index') }}"
   class="btn btn-secondary mb-3">
    Back
</a>

<form action="{{ route('admin.restaurants.update', $restaurant->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="card">

        <div class="card-header">
            Owner Information
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label>Owner Name</label>
                <input type="text"
                       name="owner_name"
                       class="form-control"
                       value="{{ $restaurant->user->name ?? '' }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ $restaurant->user->email ?? '' }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ $restaurant->phone }}">
            </div>

        </div>
    </div>

    <br>

    <div class="card">

        <div class="card-header">
            Restaurant Information
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label>Restaurant Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ $restaurant->name }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ $restaurant->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address"
                          class="form-control"
                          rows="3">{{ $restaurant->address }}</textarea>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <label>Latitude</label>
                    <input type="text"
                           name="latitude"
                           class="form-control"
                           value="{{ $restaurant->latitude }}">
                </div>

                <div class="col-md-6">
                    <label>Longitude</label>
                    <input type="text"
                           name="longitude"
                           class="form-control"
                           value="{{ $restaurant->longitude }}">
                </div>

            </div>

            <br>

            <div class="mb-3">

                <label>Status</label>

                <select name="is_active"
                        class="form-control">

                    <option value="1"
                        {{ $restaurant->is_active ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ !$restaurant->is_active ? 'selected' : '' }}>
                        Disabled
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label>Logo</label>

                @if($restaurant->logo)
                    <br>
                    <img src="{{ asset('storage/'.$restaurant->logo) }}"
                         width="120"
                         class="mb-2">
                @endif

                <input type="file"
                       name="logo"
                       class="form-control">

            </div>

            <button class="btn btn-success">
                Update Restaurant
            </button>

        </div>

    </div>

</form>

@endsection