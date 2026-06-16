@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h3>Riders</h3>

        <a href="{{ route('admin.riders.create') }}" class="btn btn-primary">
            Add Rider
        </a>
    </div>

  
    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Vehicle</th>
                <th>Plate</th>
                <th>Available</th>
                <th width="260">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($riders as $rider)
                <tr>
                    <td>{{ $rider->user->name ?? 'N/A' }}</td>
                    <td>{{ $rider->user->email ?? 'N/A' }}</td>
                    <td>{{ $rider->user->phone ?? 'N/A' }}</td>
                    <td>{{ $rider->vehicle_type ?? 'N/A' }}</td>
                    <td>{{ $rider->plate_number ?? 'N/A' }}</td>

                    <td>
                        @if($rider->is_available)
                            <span class="badge bg-success">Available</span>
                        @else
                            <span class="badge bg-danger">Unavailable</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.riders.show', $rider->id) }}"
                           class="btn btn-sm btn-info">
                            View
                        </a>

                        <a href="{{ route('admin.riders.edit', $rider->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.riders.toggle', $rider->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    class="btn btn-sm {{ $rider->is_available ? 'btn-danger' : 'btn-success' }}">
                                {{ $rider->is_available ? 'Set Offline' : 'Set Online' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No riders found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($riders->hasPages())
        {{ $riders->links() }}
    @endif
</div>
@endsection