<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('products.index');
    }

    public function data(Request $request, DataTables $dataTables): JsonResponse
    {
        $query = Product::query()->select([
            'id',
            'name',
            'category',
            'price',
            'stock',
            'is_active',
            'created_at',
        ]);

        return $dataTables->eloquent($query)
            ->editColumn('price', static fn (Product $product): string => '$' . number_format((float) $product->price, 2))
            ->editColumn('is_active', static fn (Product $product): string => $product->is_active ? 'Active' : 'Inactive')
            ->editColumn(
                'created_at',
                static fn (Product $product): string => $product->created_at?->format('Y-m-d H:i') ?? '-'
            )
            ->toJson();
    }
}
