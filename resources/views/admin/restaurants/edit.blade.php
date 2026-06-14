@extends('admin.layouts.app')

@section('content')

<h2>Edit Restaurant</h2>

<a href="{{ route('admin.restaurants.index') }}"
   class="btn btn-secondary mb-3">
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

<form action="{{ route('admin.restaurants.update', $restaurant->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- Owner Information --}}
    <div class="card mb-3">
        <div class="card-header">
            Owner Information
        </div>

        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">Owner Name</label>
                <input type="text"
                       name="owner_name"
                       class="form-control"
                       value="{{ old('owner_name', $restaurant->user->name ?? '') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $restaurant->user->email ?? '') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text"
                       name="phone"
                       class="form-control"
                       value="{{ old('phone', $restaurant->phone) }}">
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
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $restaurant->name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description', $restaurant->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address"
                          class="form-control"
                          rows="3">{{ old('address', $restaurant->address) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Latitude</label>
                    <input type="text"
                           name="latitude"
                           class="form-control"
                           value="{{ old('latitude', $restaurant->latitude) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Longitude</label>
                    <input type="text"
                           name="longitude"
                           class="form-control"
                           value="{{ old('longitude', $restaurant->longitude) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>

                <select name="is_active"
                        class="form-control">

                    <option value="1"
                        {{ old('is_active', $restaurant->is_active) == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ old('is_active', $restaurant->is_active) == 0 ? 'selected' : '' }}>
                        Disabled
                    </option>

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Logo</label>

                {{-- Current Logo Preview --}}
                @if($restaurant->logo)
                    <div class="mb-2">
                        <img
                            src="{{ imageUrl($restaurant->logo) }}"
                            alt="{{ $restaurant->name }}"
                            width="120"
                            height="100"
                            class="rounded border"
                            style="object-fit:cover;"
                        >
                    </div>
                @else
                    <p class="text-muted mb-2">No logo uploaded.</p>
                @endif

                {{-- Upload New Logo --}}
                <input type="file"
                       name="logo"
                       class="form-control"
                       accept="image/*">

                <small class="text-muted">
                    Leave empty to keep existing logo.
                </small>
            </div>

            <button type="submit" class="btn btn-success">
                Update Restaurant
            </button>

        </div>
    </div>

</form>

@endsection