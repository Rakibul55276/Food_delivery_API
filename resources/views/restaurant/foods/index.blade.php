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

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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

    @forelse($foods as $food)

        <tr>
            {{-- Food ID --}}
            <td>{{ $food->id }}</td>

            {{-- Food Name --}}
            <td>{{ $food->name }}</td>

            {{-- Food Description --}}
            <td>{{ $food->description }}</td>

            {{-- Regular Price --}}
            <td>{{ number_format($food->price, 2) }}</td>

            {{-- Discount Price --}}
            <td>
                {{ $food->discount_price ? number_format($food->discount_price, 2) : '-' }}
            </td>

            {{-- Food Image --}}
            <td>
                @if($food->image)

                    {{-- 
                        imageUrl() is your common helper.
                        It supports:
                        1. Cloudinary full URL
                        2. Local storage path
                    --}}
                    <img
                        src="{{ imageUrl($food->image) }}"
                        alt="{{ $food->name }}"
                        width="100"
                        height="80"
                        style="object-fit: cover; border-radius: 8px;"
                    >

                @else

                    {{-- If no image exists --}}
                    <span class="text-muted">No Image</span>

                @endif
            </td>

            {{-- Food Category --}}
            <td>{{ $food->category->name ?? '-' }}</td>

            {{-- Actions --}}
            <td>
                {{-- Edit Button --}}
                <a href="{{ route('restaurant.foods.edit', $food->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                {{-- Delete Form --}}
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