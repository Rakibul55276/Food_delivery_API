@extends('admin.layouts.app')

@section('content')

<h2>Restaurant Details</h2>

<a href="{{ route('admin.restaurants.index') }}"
   class="btn btn-secondary btn-sm mb-3">
    Back
</a>

<a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
   class="btn btn-primary btn-sm mb-3">
    Edit Restaurant
</a>

{{-- Restaurant Information Card --}}
<div class="card mb-4">
    <div class="card-body">

        {{-- Restaurant Logo --}}
        @if($restaurant->logo)
            <img
                src="{{ imageUrl($restaurant->logo) }}"
                alt="{{ $restaurant->name }}"
                width="100"
                height="100"
                class="mb-3 rounded border"
                style="object-fit:cover;"
            >
        @else
            <p class="text-muted">No Logo</p>
        @endif

        <h4>{{ $restaurant->name }}</h4>

        <p><strong>Owner:</strong> {{ $restaurant->user->name ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $restaurant->user->email ?? '-' }}</p>
        <p><strong>Phone:</strong> {{ $restaurant->phone }}</p>
        <p><strong>Description:</strong> {{ $restaurant->description }}</p>
        <p><strong>Address:</strong> {{ $restaurant->address }}</p>
        <p><strong>Latitude:</strong> {{ $restaurant->latitude }}</p>
        <p><strong>Longitude:</strong> {{ $restaurant->longitude }}</p>

        <p>
            <strong>Status:</strong>

            @if($restaurant->is_active)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Disabled</span>
            @endif
        </p>
    </div>
</div>

{{-- Add Category / Add Food Buttons --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <a href="{{ route('admin.restaurants.categories.create', $restaurant->id) }}"
       class="btn btn-success">
        Add Category
    </a>

    <a href="{{ route('admin.foods.create', $restaurant->id) }}"
       class="btn btn-success">
        Add Food Item
    </a>

</div>

{{-- Categories And Foods --}}
@forelse($restaurant->categories as $category)

    <div class="card mb-3">

        {{-- Category Header --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <span>{{ $category->name }}</span>

            {{-- Delete Category --}}
            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                  method="POST"
                  onsubmit="return confirm('Delete this category?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-sm btn-danger">
                    Delete
                </button>

            </form>

        </div>

        <div class="card-body">

            @if($category->foodItems->count())

                <table class="table table-bordered align-middle">

                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Food Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th width="170">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($category->foodItems as $food)

                            <tr>
                                {{-- Food Image --}}
                                <td>
                                    @if($food->image)
                                        <img
                                            src="{{ imageUrl($food->image) }}"
                                            alt="{{ $food->name }}"
                                            width="70"
                                            height="60"
                                            class="rounded border"
                                            style="object-fit:cover;"
                                        >
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>

                                {{-- Food Name --}}
                                <td>{{ $food->name }}</td>

                                {{-- Description --}}
                                <td>{{ $food->description }}</td>

                                {{-- Price --}}
                                <td>SAR {{ number_format($food->price, 2) }}</td>

                                {{-- Discount Price --}}
                                <td>
                                    {{ $food->discount_price ? 'SAR '.number_format($food->discount_price, 2) : '-' }}
                                </td>

                                {{-- Actions --}}
                                <td>
                                    <a href="{{ route('admin.foods.edit', $food->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.foods.destroy', $food->id) }}"
                                          method="POST"
                                          style="display:inline-block">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this food item?')">
                                            Delete
                                        </button>

                                    </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <p class="mb-0 text-muted">
                    No food items in this category.
                </p>

            @endif

        </div>

    </div>

@empty

    <div class="alert alert-info">
        No categories found for this restaurant.
    </div>

@endforelse

@endsection