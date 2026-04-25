@extends('admin.layout')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #333; margin: 0;">
        <i class="fas fa-user-circle"></i> Customer Details
    </h1>
    <a href="{{ route('admin.customers') }}" class="btn btn-outline-secondary">Back to Customers</a>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Customer Info -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 20px;">
            <h4 style="color: #333; margin-bottom: 20px;">Customer Information</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong></p>
                    <p style="color: #666;">{{ $customer->name }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Email:</strong></p>
                    <p style="color: #666;">{{ $customer->email }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <p><strong>Member Since:</strong></p>
                    <p style="color: #666;">{{ $customer->created_at->format('M d, Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone:</strong></p>
                    <p style="color: #666;">Not provided</p>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h4 style="color: #333; margin-bottom: 20px;">Orders ({{ $totalOrders }})</h4>
            @if($orders->count() > 0)
                <table class="table table-hover">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>{{ $order->items()->count() }}</td>
                                <td><strong>Rs. {{ number_format($order->total_amount, 0) }}</strong></td>
                                <td>
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
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.detail', $order->id) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No orders found.</p>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <!-- Stats -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 10px; text-align: center; margin-bottom: 20px;">
            <h3>{{ $totalOrders }}</h3>
            <p style="margin: 0;">Total Orders</p>
        </div>

        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 25px; border-radius: 10px; text-align: center;">
            <h3>Rs. {{ number_format($totalSpent, 0) }}</h3>
            <p style="margin: 0;">Total Spent</p>
        </div>
    </div>
</div>

@endsection
