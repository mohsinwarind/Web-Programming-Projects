@extends('layout')

@section('title', 'Admin Dashboard')

@section('extra-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
<style>
    .admin-sidebar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .admin-sidebar a {
        display: block;
        color: rgba(255,255,255,0.8);
        padding: 10px 15px;
        margin: 5px 0;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .admin-sidebar a:hover {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .stat-box {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        text-align: center;
        margin-bottom: 20px;
        border-left: 4px solid #667eea;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #667eea;
    }

    .stat-label {
        color: #999;
        margin-top: 10px;
    }

    .dataTables_wrapper {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-3">
            <div class="admin-sidebar">
                <h5 style="margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px;">
                    <i class="fas fa-cog"></i> Admin Menu
                </h5>
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a href="{{ route('admin.customers') }}"><i class="fas fa-users"></i> Customers</a>
                <a href="{{ route('admin.orders') }}"><i class="fas fa-shopping-bag"></i> Orders</a>
                <a href="{{ route('admin.products') }}"><i class="fas fa-cube"></i> Products</a>
                <a href="{{ route('admin.categories') }}"><i class="fas fa-list"></i> Categories</a>
                <a href="{{ route('admin.contacts') }}"><i class="fas fa-envelope"></i> Messages</a>
            </div>
        </div>

        <div class="col-md-9">
            @yield('admin-content')
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@yield('extra-js')
@endsection
