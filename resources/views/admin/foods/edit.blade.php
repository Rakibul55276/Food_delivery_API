@extends('admin.layouts.app')

@section('content')

<h2>Edit Food Item</h2>

<form action="{{ route('admin.foods.update', $food->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Category</label>

        <select name="category_id"
                class="form-control">

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ $food->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label>Name</label>

        <input type="text"
               name="name"
               value="{{ $food->name }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>

        <textarea name="description"
                  class="form-control">{{ $food->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Price</label>

        <input type="number"
               step="0.01"
               name="price"
               value="{{ $food->price }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Discount Price</label>

        <input type="number"
               step="0.01"
               name="discount_price"
               value="{{ $food->discount_price }}"
               class="form-control">
    </div>

    <div class="mb-3">

        <label>Current Image</label>

        <br>

       @if($food->image)

    {{-- Food Image Preview --}}
    <img
        src="{{ imageUrl($food->image) }}"
        alt="{{ $food->name }}"
        width="120"
        height="100"
        class="border rounded"
        style="object-fit:cover;"
    >

@endif

    </div>

    <div class="mb-3">

        <label>Change Image</label>

        <input type="file"
               name="image"
               class="form-control">

    </div>

    <button class="btn btn-success">
        Update Food Item
    </button>

</form>

@endsection