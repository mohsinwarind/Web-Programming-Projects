@extends('layout')

@section('title', $category->name . ' - E-Commerce Store')

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div style="background: white; padding: 30px; border-radius: 10px;">
                <h1 style="color: #333; margin-bottom: 30px;">
                    <i class="fas fa-folder"></i> {{ $category->name }}
                </h1>
                @if($category->description)
                    <p style="color: #666; margin-bottom: 30px;">{{ $category->description }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 40px;">
        @forelse($products as $product)
            <div class="col-md-3 col-sm-6">
                <div class="card product-card">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top product-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text" style="color: #999; font-size: 14px;">{{ Str::limit($product->description, 50) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="product-price">Rs. {{ number_format($product->price, 0) }}</span>
                            <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i> No products found in this category.
                </div>
            </div>
        @endforelse
    </div>

    @if($products->hasPages())
        <div class="row" style="margin-top: 40px;">
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection
