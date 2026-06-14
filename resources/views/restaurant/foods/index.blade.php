@extends('restaurant.layouts.app')

@section('content')

{{-- Page Header --}}
<div class="d-flex justify-content-between mb-3">
    <h2>Food Items</h2>

    {{-- Add Food Button --}}
    <a href="{{ route('restaurant.foods.create') }}"
       class="btn btn-primary">
        Add Food
    </a>
</div>



{{-- Food Items Table --}}
<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
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

    <!-- @forelse($foods as $food) -->

       @forelse($foodsByCategory as $categoryName => $foods)

    <tr class="table-primary">
        <td colspan="8">
            <strong>{{ $categoryName }}</strong>
            ({{ $foods->count() }} Items)
        </td>
    </tr>

    @foreach($foods as $food)

    <tr>
        <td>{{ $food->id }}</td>
        <td>{{ $food->name }}</td>
        <td>{{ $food->description }}</td>
        <td>{{ number_format($food->price, 2) }}</td>
        <td>
            {{ $food->discount_price ? number_format($food->discount_price, 2) : '-' }}
        </td>

        <td>
            @if($food->image)
                <img
                    src="{{ imageUrl($food->image) }}"
                    alt="{{ $food->name }}"
                    width="100"
                    height="80"
                    style="object-fit:cover;border-radius:8px;">
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
                    type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Delete this food item?')">
                    Delete
                </button>

            </form>
        </td>
    </tr>

    @endforeach

@empty

<tr>
    <td colspan="8" class="text-center">
        No food items found
    </td>
</tr>

@endforelse

    @empty

        {{-- Empty State --}}
        <tr>
            <td colspan="8" class="text-center text-muted">
                No food items found
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

@endsection