@extends('admin.layout')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #333; margin: 0;">
        <i class="fas fa-box"></i> Order #{{ $order->id }}
    </h1>
    <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary">Back to Orders</a>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Order Info -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #333; margin-bottom: 20px;">Order Information</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order Date:</strong></p>
                    <p style="color: #666;">{{ $order->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Customer:</strong></p>
                    <p style="color: #666;">{{ $order->user->name }} ({{ $order->user->email }})</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <p><strong>Current Status:</strong></p>
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'processing' => 'info',
                            'shipped' => 'primary',
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #333; margin-bottom: 20px;">Update Order Status</h4>
            <form method="POST" action="{{ route('admin.order.status.update', $order->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select form-select-lg" id="status" name="status">
                        <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                        <option value="processing" @if($order->status == 'processing') selected @endif>Processing</option>
                        <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                        <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                        <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </form>
        </div>

        <!-- Order Items -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h4 style="color: #333; margin-bottom: 20px;">Order Items</h4>
            <table class="table table-hover">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>Rs. {{ number_format($item->price, 0) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td><strong>Rs. {{ number_format($item->price * $item->quantity, 0) }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Shipping Info -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #333; margin-bottom: 20px;">Shipping Information</h4>
            <p><strong>Address:</strong></p>
            <p style="color: #666;">{{ $order->shipping_address }}</p>
            <p style="margin-top: 15px;"><strong>Phone:</strong></p>
            <p style="color: #666;">{{ $order->phone }}</p>
        </div>

        <!-- Order Summary -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h4 style="color: #333; margin-bottom: 20px;">Order Summary</h4>
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                <span>Subtotal:</span>
                <span>Rs. {{ number_format($order->total_amount, 0) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: bold; color: #667eea;">
                <span>Total:</span>
                <span>Rs. {{ number_format($order->total_amount, 0) }}</span>
            </div>
        </div>
    </div>
</div>

@endsection
