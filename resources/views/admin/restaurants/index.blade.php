@extends('admin.layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Restaurants</h2>

    <a href="{{ route('admin.restaurants.create') }}"
       class="btn btn-success">
        Add Restaurant
    </a>
</div>

<table class="table table-bordered align-middle">

    <thead>
        <tr>
            <th>ID</th>
            <th>Logo</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Status</th>
            <th width="260">Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse($restaurants as $restaurant)

            <tr>
                <td>{{ $restaurant->id }}</td>

              <td>
    @if($restaurant->logo)

        {{-- Works with both Cloudinary and Local Storage --}}
        <img
            src="{{ imageUrl($restaurant->logo) }}"
            alt="{{ $restaurant->name }}"
            width="60"
            height="60"
            class="rounded border"
            style="object-fit:cover;"
        >

    @else

        <span class="text-muted">
            No Logo
        </span>

    @endif
</td>

                <td>{{ $restaurant->name }}</td>

                <td>{{ $restaurant->phone }}</td>

                <td>
                    @if($restaurant->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Disabled</span>
                    @endif
                </td>

                <td>
                    <div class="d-flex gap-2">

                        <a href="{{ route('admin.restaurants.show', $restaurant->id) }}"
                           class="btn btn-sm btn-info">
                            View
                        </a>

                        <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
                           class="btn btn-sm btn-primary">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.restaurants.toggle', $restaurant->id) }}">

                            @csrf
                            @method('PATCH')

                            <button class="btn btn-sm btn-warning">
                                {{ $restaurant->is_active ? 'Disable' : 'Enable' }}
                            </button>

                        </form>

                    </div>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center">
                    No restaurants found
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

@endsection