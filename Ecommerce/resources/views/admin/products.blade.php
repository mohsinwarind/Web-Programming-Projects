@extends('admin.layout')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #333; margin: 0;">
        <i class="fas fa-cube"></i> Products
    </h1>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        <i class="fas fa-plus"></i> Add Product
    </a>
</div>

<div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
    <table class="table table-striped table-hover" id="products-table">
        <thead style="background: #f8f9fa;">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.products.data') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'category_name', name: 'category_name' },
                { data: 'price', name: 'price' },
                { data: 'stock', name: 'stock' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
