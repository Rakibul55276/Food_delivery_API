@extends('restaurant.layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Categories</h2>

    <a href="{{ route('restaurant.categories.create') }}"
       class="btn btn-primary">
        Add Category
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
           
            <th width="180">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
               
                <td>
                    <a href="{{ route('restaurant.categories.edit', $category->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('restaurant.categories.destroy', $category->id) }}"
                          method="POST"
                          style="display:inline-block">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this category?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No categories found</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection