@extends('restaurant.layouts.app')

@section('content')

<h2>Add Food Item</h2>

<form action="{{ route('restaurant.foods.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text"
               name="name"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description"
                  class="form-control"></textarea>
    </div>
 <div class="mb-3">
    <label>Category</label>

    <select name="category_id" class="form-control" required>
        <option value="">Select Category</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach

    </select>
</div>

<div class="mb-3">
    <label>Discount Price</label>
    <input type="number" step="0.01" name="discount_price" class="form-control">
</div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number"
               step="0.01"
               name="price"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Food Image</label>
        <input type="file"
               name="image"
               class="form-control">
    </div>

    <button type="submit"
            class="btn btn-success">
        Save Food
    </button>

</form>

@endsection