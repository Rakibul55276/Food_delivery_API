@extends('admin.layouts.app')

@section('content')

<h2>Add Customer</h2>

<a href="{{ route('admin.customers.index') }}"
   class="btn btn-secondary mb-3">
    Back
</a>

<form action="{{ route('admin.customers.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text"
               name="name"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text"
               name="phone"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password"
               name="password"
               class="form-control"
               required>
    </div>

    <button type="submit"
            class="btn btn-success">
        Save Customer
    </button>

</form>

@endsection