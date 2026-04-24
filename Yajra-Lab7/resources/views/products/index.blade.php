<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yajra DataTable Demo</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <style>
        body {
            margin: 0;
            padding: 24px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 6px;
            font-size: 28px;
        }

        p {
            margin-top: 0;
            margin-bottom: 18px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Products DataTable</h1>
        <p>Server-side processing powered by Yajra DataTables with demo seeded data.</p>

        <table id="products-table" class="display" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('products.data') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'category', name: 'category' },
                    { data: 'price', name: 'price' },
                    { data: 'stock', name: 'stock' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'created_at', name: 'created_at' }
                ]
            });
        });
    </script>
</body>
</html>
