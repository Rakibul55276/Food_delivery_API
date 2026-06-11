@extends('restaurant.layouts.app')

@section('content')

<h2>Add Category</h2>

<form action="{{ route('restaurant.categories.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">
        <label>Category Name</label>

        <input type="text"
               name="name"
               class="form-control"
               required>
    </div>

    <button class="btn btn-success">
        Save Category
    </button>

</form>

@endsection