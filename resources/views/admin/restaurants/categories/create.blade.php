@extends('admin.layouts.app')

@section('content')

<h2>Add Category for {{ $restaurant->name }}</h2>

<a href="{{ route('admin.restaurants.show', $restaurant->id) }}"
   class="btn btn-secondary mb-3">
    Back
</a>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.restaurants.categories.store', $restaurant->id) }}"
      method="POST">

    @csrf

    <div class="mb-3">
        <label>Category Name</label>
        <input type="text"
               name="name"
               class="form-control"
               required>
    </div>

    <button class="btn btn-success">
        Save Category
    </button>

</form>

@endsection