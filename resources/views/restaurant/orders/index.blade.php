@extends('restaurant.layouts.app')

@section('content')

<h2 class="mb-4">Restaurant Orders</h2>



<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Order Status</th>
            <th>Payment</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    @forelse($orders as $order)

        <tr>

            <td>
                {{ $order->order_no }}
            </td>

            <td>
                {{ $order->user->name ?? '-' }}
            </td>

            <td>
                SAR {{ number_format($order->total_amount, 2) }}
            </td>

            {{-- ORDER STATUS --}}
            <td style="min-width:260px">

    @php
        $nextStatus = null;
        $buttonText = null;
        $buttonClass = 'btn-primary';

        if ($order->order_status == 'pending') {
            $nextStatus = 'accepted';
            $buttonText = 'Accept Order';
            $buttonClass = 'btn-info';
        } elseif ($order->order_status == 'accepted') {
            $nextStatus = 'preparing';
            $buttonText = 'Start Preparing';
            $buttonClass = 'btn-warning';
        } elseif ($order->order_status == 'preparing') {
            $nextStatus = 'ready';
            $buttonText = 'Mark Ready';
            $buttonClass = 'btn-success';
        }
    @endphp

    <div class="d-flex align-items-center gap-2">

        @if($order->order_status == 'pending')
            <span class="badge bg-secondary">Pending</span>
        @elseif($order->order_status == 'accepted')
            <span class="badge bg-info">Accepted</span>
        @elseif($order->order_status == 'preparing')
            <span class="badge bg-warning text-dark">Preparing</span>
        @elseif($order->order_status == 'ready')
            <span class="badge bg-success">Ready</span>
        @elseif($order->order_status == 'picked_up')
            <span class="badge bg-primary">Picked Up</span>
        @elseif($order->order_status == 'delivered')
            <span class="badge bg-dark">Delivered</span>
        @elseif($order->order_status == 'cancelled')
            <span class="badge bg-danger">Cancelled</span>
        @endif

        @if($nextStatus)
            <form action="{{ route('restaurant.orders.updateStatus', $order->id) }}"
                  method="POST">
                @csrf
                @method('PATCH')

                <input type="hidden" name="order_status" value="{{ $nextStatus }}">

                <button class="btn btn-sm {{ $buttonClass }}">
                    {{ $buttonText }}
                </button>
            </form>
        @endif

        @if(in_array($order->order_status, ['pending', 'accepted']))
            <form action="{{ route('restaurant.orders.updateStatus', $order->id) }}"
                  method="POST"
                  onsubmit="return confirm('Cancel this order?')">
                @csrf
                @method('PATCH')

                <input type="hidden" name="order_status" value="cancelled">

                <button class="btn btn-sm btn-danger">
                    Cancel
                </button>
            </form>
        @endif

    </div>

</td>
            {{-- PAYMENT STATUS --}}
           <td style="min-width:320px">

    @if($order->payment_status === 'paid')

        <span class="badge bg-success">
            Paid
        </span>

        <small class="text-muted d-block mt-1">
            Locked by admin/payment
        </small>

    @else

        <form action="{{ route('restaurant.orders.updatePayment',$order->id) }}"
              method="POST"
              class="d-flex align-items-center gap-2">

            @csrf
            @method('PATCH')

            <select name="payment_status"
                    class="form-select form-select-sm"
                    style="width:130px">

                <option value="pending"
                    {{ $order->payment_status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="paid"
                    {{ $order->payment_status == 'paid' ? 'selected' : '' }}>
                    Paid
                </option>

                <option value="failed"
                    {{ $order->payment_status == 'failed' ? 'selected' : '' }}>
                    Failed
                </option>

            </select>

            <button class="btn btn-success btn-sm">
                Save
            </button>

            @if($order->payment_status == 'pending')
                <span class="badge bg-warning text-dark">
                    Pending
                </span>
            @elseif($order->payment_status == 'failed')
                <span class="badge bg-danger">
                    Failed
                </span>
            @endif

        </form>

    @endif

</td>
            <td>
                {{ $order->created_at->format('d M Y') }}
            </td>

            <td>
            
                    <a href="{{ route('restaurant.orders.show', $order->id) }}"
                    class="btn btn-sm btn-outline-primary mt-2">
                        View
                    </a>
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="6" class="text-center">
                No orders found
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

@endsection