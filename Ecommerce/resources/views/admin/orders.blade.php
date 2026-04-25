@extends('admin.layout')

@section('admin-content')
<h1 style="color: #333; margin-bottom: 30px;">
    <i class="fas fa-shopping-bag"></i> Orders
</h1>

<div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
    <table class="table table-striped table-hover" id="orders-table">
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
    </table>
</div>

@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.orders.data') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'customer_email', name: 'customer_email' },
                { data: 'order_date', name: 'order_date' },
                { data: 'total', name: 'total' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
