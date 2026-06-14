@extends('admin.layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-4">
        <h3>Edit Order #{{ $order->id }}</h3>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <!-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix below errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header">Customer Details</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Restaurant Details</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->restaurant->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $order->restaurant->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $order->restaurant->phone ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Order Control</div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Order Status</label>
                        <select name="order_status" class="form-select">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $order->order_status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="preparing" {{ $order->order_status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="ready" {{ $order->order_status == 'ready' ? 'selected' : '' }}>Ready</option>
                            <option value="picked_up" {{ $order->order_status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                            <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Payment Status</label>
                        <select name="payment_status" class="form-select">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select">
                            <option value="cash" {{ $order->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="card" {{ $order->payment_method == 'card' ? 'selected' : '' }}>Card</option>
                            <option value="wallet" {{ $order->payment_method == 'wallet' ? 'selected' : '' }}>Wallet</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Assign Rider</label>
                        <select name="rider_id" class="form-select">
    <option value="">Not Assigned</option>

    @foreach($riders as $rider)
        <option value="{{ $rider->id }}"
            {{ $order->rider_id == $rider->id ? 'selected' : '' }}>
            {{ $rider->user->name ?? 'Rider' }}
            - {{ $rider->user->phone ?? $rider->user->email }}
            - {{ $rider->plate_number ?? 'No Plate' }}
        </option>
    @endforeach
</select>
                    </div>
                </div>

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Delivery Address</div>
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Delivery Address</label>
                    <textarea name="delivery_address" class="form-control" rows="3">{{ old('delivery_address', $order->delivery_address) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Latitude</label>
                        <input type="text" name="latitude" class="form-control"
                               value="{{ old('latitude', $order->latitude) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="text" name="longitude" class="form-control"
                               value="{{ old('longitude', $order->longitude) }}">
                    </div>
                </div>

            </div>
        </div>

       <div class="card mb-3">
    <div class="card-header">Amount Details</div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Subtotal</label>
                <input type="number" step="0.01" name="subtotal_display"
                       class="form-control" id="subtotal"
                       value="{{ $order->subtotal }}" readonly>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Delivery Fee</label>
                <input type="number" step="0.01" name="delivery_fee"
                       class="form-control calculate-total"
                       value="{{ old('delivery_fee', $order->delivery_fee) }}">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Discount</label>
                <input type="number" step="0.01" name="discount"
                       class="form-control calculate-total"
                       value="{{ old('discount', $order->discount) }}">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Tax</label>
                <input type="number" step="0.01" name="tax"
                       class="form-control calculate-total"
                       value="{{ old('tax', $order->tax) }}">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Total Amount</label>
                <input type="number" step="0.01" name="total_amount_display"
                       class="form-control" id="total_amount"
                       value="{{ $order->total_amount }}" readonly>
            </div>
        </div>

    </div>
</div>

<div class="card mb-3">
    <div class="card-header">Order Items</div>
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Item Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($order->items as $index => $item)
                    <tr>
                        <td width="100">

                                 @if(!empty($item->foodItem->image))

    <img
        src="{{ imageUrl($item->foodItem->image) }}"
        alt="{{ $item->foodItem->name ?? 'Food Item' }}"
        width="70"
        height="70"
        class="border rounded"
        style="object-fit:cover;"
    >

@else

    <img
        src="https://via.placeholder.com/70"
        width="70"
        height="70"
        class="border rounded"
    >

@endif

                                </td>

                                <td>
                                    {{ $item->foodItem->name ?? 'N/A' }}

                                    <input type="hidden"
                                        name="items[{{ $index }}][id]"
                                        value="{{ $item->id }}">
                                </td>

                        <td>
                            <input type="number"
                                   step="0.01"
                                   name="items[{{ $index }}][price]"
                                   class="form-control item-price"
                                   value="{{ old('items.'.$index.'.price', $item->price) }}">
                        </td>

                        <td>
                            <input type="number"
                                   name="items[{{ $index }}][quantity]"
                                   class="form-control item-qty"
                                   value="{{ old('items.'.$index.'.quantity', $item->quantity) }}">
                        </td>

                        <td>
                            <input type="number"
                                   step="0.01"
                                   class="form-control item-subtotal"
                                   value="{{ $item->price * $item->quantity }}"
                                   readonly>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            No items found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

        <button type="submit" class="btn btn-success mb-5">
            Update Order
        </button>

    </form>

</div>



<script>
    function calculateTotals() {
        let subtotal = 0;

        document.querySelectorAll('tbody tr').forEach(function(row) {
            let priceInput = row.querySelector('.item-price');
            let qtyInput = row.querySelector('.item-qty');
            let itemSubtotalInput = row.querySelector('.item-subtotal');

            if (priceInput && qtyInput && itemSubtotalInput) {
                let price = parseFloat(priceInput.value) || 0;
                let qty = parseInt(qtyInput.value) || 0;

                let itemSubtotal = price * qty;

                itemSubtotalInput.value = itemSubtotal.toFixed(2);
                subtotal += itemSubtotal;
            }
        });

        let deliveryFee = parseFloat(document.querySelector('[name="delivery_fee"]').value) || 0;
        let discount = parseFloat(document.querySelector('[name="discount"]').value) || 0;
        let tax = parseFloat(document.querySelector('[name="tax"]').value) || 0;

        let total = subtotal + deliveryFee + tax - discount;

        if (total < 0) {
            total = 0;
        }

        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('total_amount').value = total.toFixed(2);
    }

    document.addEventListener('input', function(e) {
        if (
            e.target.classList.contains('item-price') ||
            e.target.classList.contains('item-qty') ||
            e.target.classList.contains('calculate-total')
        ) {
            calculateTotals();
        }
    });

    calculateTotals();
</script>
@endsection