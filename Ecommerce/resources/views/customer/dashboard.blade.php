@extends('layout')

@section('title', 'Dashboard - E-Commerce Store')

@section('extra-css')
<style>
    .dashboard-card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #667eea;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #667eea;
    }

    .stat-label {
        color: #999;
        font-size: 14px;
        margin-top: 5px;
    }

    .order-table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    .order-table table {
        margin-bottom: 0;
    }

    .order-badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending {
        background: #fff3cd;
        color: #856404;
    }

    .badge-processing {
        background: #cfe2ff;
        color: #084298;
    }

    .badge-shipped {
        background: #cff4fc;
        color: #055160;
    }

    .badge-delivered {
        background: #d1e7dd;
        color: #0f5132;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-12">
            <h1 style="color: #333; margin-bottom: 30px;">
                <i class="fas fa-user-circle"></i> Welcome, {{ auth()->user()->name }}!
            </h1>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row">
        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="stat-number">{{ $totalOrders }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="stat-number">Rs. {{ number_format($totalSpent, 0) }}</div>
                <div class="stat-label">Total Spent</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card">
                <div class="stat-number">{{ auth()->user()->contacts()->count() }}</div>
                <div class="stat-label">Messages Sent</div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row" style="margin-top: 40px;">
        <div class="col-md-12">
            <h3 style="color: #333; margin-bottom: 20px;">Recent Orders</h3>
            @if($recentOrders->count() > 0)
                <div class="order-table">
                    <table class="table table-hover" style="margin-bottom: 0;">
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
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><strong>#{{ $order->id }}</strong></td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>{{ $order->items()->count() }} item(s)</td>
                                    <td><strong>Rs. {{ number_format($order->total_amount, 0) }}</strong></td>
                                    <td>
                                        <span class="order-badge badge-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.order.detail', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> You haven't placed any orders yet. <a href="{{ route('home') }}">Start shopping now!</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row" style="margin-top: 40px; margin-bottom: 40px;">
        <div class="col-md-12">
            <h3 style="color: #333; margin-bottom: 20px;">Quick Actions</h3>
            <a href="{{ route('home') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                <i class="fas fa-shopping-cart"></i> Continue Shopping
            </a>
            <a href="{{ route('customer.contact') }}" class="btn btn-outline-primary">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
        </div>
    </div>
</div>
@endsection
