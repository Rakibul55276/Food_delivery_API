@extends('admin.layouts.app')

@section('content')

<h2>Edit Customer</h2>

<a href="{{ route('admin.customers.index') }}"
   class="btn btn-secondary mb-3">
    Back
</a>

<form action="{{ route('admin.customers.update', $user->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text"
               name="name"
               class="form-control"
               value="{{ $user->name }}"
               required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control"
               value="{{ $user->email }}"
               required>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text"
               name="phone"
               class="form-control"
               value="{{ $user->phone }}">
    </div>

    <div class="mb-3">
        <label>New Password</label>
        <input type="password"
               name="password"
               class="form-control">

        <small class="text-muted">
            Leave blank to keep current password.
        </small>
    </div>

    <button type="submit"
            class="btn btn-primary">
        Update Customer
    </button>

</form>

@endsection