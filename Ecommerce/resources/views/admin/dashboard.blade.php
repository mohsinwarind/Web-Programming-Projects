@extends('admin.layout')

@section('admin-content')
<h1 style="color: #333; margin-bottom: 30px;">
    <i class="fas fa-chart-line"></i> Admin Dashboard
</h1>

<!-- Statistics -->
<div class="row">
    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">Total Customers</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number">{{ $totalOrders }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number">Rs. {{ number_format($totalRevenue, 0) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number" style="color: #ff9500;">{{ $pendingOrders }}</div>
            <div class="stat-label">Pending Orders</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number" style="color: #00c853;">{{ $totalProducts }}</div>
            <div class="stat-label">Total Products</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-box">
            <div class="stat-number" style="color: #2196ff;">{{ $totalContacts }}</div>
            <div class="stat-label">Messages</div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div style="margin-top: 40px; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
    <h3 style="color: #333; margin-bottom: 20px;">
        <i class="fas fa-shopping-bag"></i> Recent Orders
    </h3>
    @if($recentOrders->count() > 0)
        <table class="table table-hover">
            <thead style="background: #f8f9fa;">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
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
        <p>No orders found.</p>
    @endif
</div>

@endsection
