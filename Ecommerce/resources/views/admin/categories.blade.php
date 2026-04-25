@extends('admin.layout')

@section('admin-content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="color: #333; margin: 0;">
        <i class="fas fa-list"></i> Categories
    </h1>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        <i class="fas fa-plus"></i> Add Category
    </a>
</div>

<div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
    <table class="table table-striped table-hover" id="categories-table">
        <thead style="background: #f8f9fa;">
            <tr>
                <th>Name</th>
                <th>Products</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#categories-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.categories.data') }}",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'products_count', name: 'products_count' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
