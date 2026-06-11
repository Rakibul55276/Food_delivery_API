@extends('restaurant.layouts.app')

@section('content')

<h2>Edit Category</h2>

<form action="{{ route('restaurant.categories.update', $category->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Category Name</label>

        <input type="text"
               name="name"
               value="{{ $category->name }}"
               class="form-control"
               required>
    </div>

    <button class="btn btn-success">
        Update Category
    </button>

</form>

@endsection