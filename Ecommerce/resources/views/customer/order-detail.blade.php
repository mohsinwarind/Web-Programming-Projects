@extends('layout')

@section('title', 'Order Details - E-Commerce Store')

@section('content')
<div class="container" style="margin-top: 30px; margin-bottom: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1 style="color: #333; margin: 0;">
                    <i class="fas fa-receipt"></i> Order #{{ $order->id }}
                </h1>
                <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Info -->
        <div class="col-md-8">
            <div style="background: white; padding: 25px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                <h4 style="margin-bottom: 20px; color: #333;">Order Information</h4>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <p><strong>Order Date:</strong></p>
                        <p style="color: #666;">{{ $order->created_at->format('F d, Y - H:i A') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong></p>
                        <p>
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                ];
                                $color = $statusColors[$order->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ ucfirst($order->status) }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div style="background: white; padding: 25px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                <h4 style="margin-bottom: 20px; color: #333;">Order Items</h4>
                <table class="table">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('product.detail', $item->product->slug) }}" style="color: #667eea; text-decoration: none;">
                                        {{ $item->product->name }}
                                    </a>
                                </td>
                                <td>Rs. {{ number_format($item->price, 0) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td><strong>Rs. {{ number_format($item->price * $item->quantity, 0) }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Shipping Info -->
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                <h4 style="margin-bottom: 20px; color: #333;">Shipping Information</h4>
                <p><strong>Address:</strong></p>
                <p style="color: #666;">{{ $order->shipping_address }}</p>
                <p style="margin-top: 15px;"><strong>Phone:</strong></p>
                <p style="color: #666;">{{ $order->phone }}</p>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                <h4 style="margin-bottom: 20px; color: #333;">Order Summary</h4>
                <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Subtotal:</span>
                        <span>Rs. {{ number_format($order->total_amount, 0) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Tax:</span>
                        <span>Included</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: bold; color: #667eea;">
                    <span>Total:</span>
                    <span>Rs. {{ number_format($order->total_amount, 0) }}</span>
                </div>

                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    <h5 style="color: #333;">Customer Information</h5>
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
