@extends('admin.layout')

@section('admin-content')
<h1 style="color: #333; margin-bottom: 30px;">
    <i class="fas fa-users"></i> Customers
</h1>

<div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
    <table class="table table-striped table-hover" id="customers-table">
        <thead style="background: #f8f9fa;">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Total Orders</th>
                <th>Total Spent</th>
                <th>Join Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.customers.data') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'total_orders', name: 'total_orders' },
                { data: 'total_spent', name: 'total_spent' },
                { data: 'join_date', name: 'join_date' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
