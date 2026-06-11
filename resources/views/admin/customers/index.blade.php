@extends('admin.layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2>Customers</h2>

    <a href="{{ route('admin.customers.create') }}"
       class="btn btn-success">
        Add Customer
    </a>
</div>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Total Orders</th>
            <th>Joined</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->orders_count }}</td>
                <td>{{ $customer->created_at->format('d M Y') }}</td>
                <td>
                   <a href="{{ route('admin.customers.show', $customer->id) }}"
   class="btn btn-sm btn-info">
    View
</a>

<a href="{{ route('admin.customers.edit', $customer->id) }}"
   class="btn btn-sm btn-primary">
    Edit
</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No customers found</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection