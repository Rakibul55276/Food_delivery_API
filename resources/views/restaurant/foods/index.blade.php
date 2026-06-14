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

    {{-- Group foods by category --}}
    @forelse($foodsByCategory as $categoryName => $foods)

        {{-- Category Header Row --}}
        <tr class="table-primary">
            <td colspan="8">
                <strong>{{ $categoryName }}</strong>
                <span class="text-muted">
                    ({{ $foods->count() }} Items)
                </span>
            </td>
        </tr>

        {{-- Foods under this category --}}
        @foreach($foods as $food)

            <tr>
                {{-- Food ID --}}
                <td>{{ $food->id }}</td>

                {{-- Food Name --}}
                <td>{{ $food->name }}</td>

                {{-- Food Description --}}
                <td>{{ $food->description }}</td>

                {{-- Price --}}
                <td>{{ number_format($food->price, 2) }}</td>

                {{-- Discount Price --}}
                <td>
                    {{ $food->discount_price ? number_format($food->discount_price, 2) : '-' }}
                </td>

                {{-- Image --}}
                <td>
                    @if($food->image)
                        <img
                            src="{{ imageUrl($food->image) }}"
                            alt="{{ $food->name }}"
                            width="100"
                            height="80"
                            style="object-fit:cover;border-radius:8px;"
                        >
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>

                {{-- Category --}}
                <td>{{ $food->category->name ?? '-' }}</td>

                {{-- Actions --}}
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