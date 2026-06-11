@extends('restaurant.layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Food Items</h2>

    <a href="{{ route('restaurant.foods.create') }}"
       class="btn btn-primary">
       Add Food
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Discount Price</th>
            <th>Image</th>
            <th>Category</th>
            <th width="180">Actions</th>
        </tr>
    </thead>

    <tbody>

    @forelse($foods as $food)

        <tr>
            <td>{{ $food->id }}</td>
            <td>{{ $food->name }}</td>
            <td>{{ $food->description }}</td>
            <td>{{ $food->price }}</td>
            <td>{{ $food->discount_price }}</td>
            <td>
                @if($food->image)
                    <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" width="100">
                @endif
            </td> 
            <td>{{ $food->category->name ?? '-' }}</td>

<td>
    <a href="{{ route('restaurant.foods.edit', $food->id) }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    <form action="{{ route('restaurant.foods.destroy', $food->id) }}"
          method="POST"
          style="display:inline-block">

        @csrf
        @method('DELETE')

        <button
            onclick="return confirm('Delete this food item?')"
            class="btn btn-danger btn-sm">
            Delete
        </button>

    </form>
</td>
        </tr>

    @empty

        <tr>
            <td colspan="7">
                No food items found
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

@endsection