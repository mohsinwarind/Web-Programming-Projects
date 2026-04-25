@extends('layout')

@section('title', $product->name . ' - E-Commerce Store')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-6">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid" style="border-radius: 10px;">
        </div>
        <div class="col-md-6">
            <h1 style="color: #333; margin-bottom: 20px;">{{ $product->name }}</h1>
            
            <div style="background: #f0f0f0; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
                <p class="product-price">Rs. {{ number_format($product->price, 0) }}</p>
                <p style="color: #999; margin: 10px 0;">Category: <strong>{{ $product->category->name }}</strong></p>
                <p style="color: #999; margin: 10px 0;">Stock: <strong>{{ $product->stock }} items available</strong></p>
            </div>

            <div style="margin-bottom: 30px;">
                <h4>Product Description</h4>
                <p>{{ $product->description }}</p>
            </div>

            @auth
                <form method="POST" action="{{ route('cart.add') }}" style="margin-bottom: 30px;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width: 100px;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Please <a href="{{ route('login') }}">login</a> to place an order.
                </div>
            @endauth
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section style="margin-top: 60px;">
        <h2 style="font-size: 28px; margin-bottom: 30px;">Related Products</h2>
        <div class="row">
            @foreach($relatedProducts as $related)
                <div class="col-md-3 col-sm-6">
                    <div class="card product-card">
                        <img src="{{ $related->image }}" alt="{{ $related->name }}" class="card-img-top product-img">
                        <div class="card-body">
                            <h5 class="card-title">{{ $related->name }}</h5>
                            <p class="card-text" style="color: #999; font-size: 14px;">{{ Str::limit($related->description, 50) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">Rs. {{ number_format($related->price, 0) }}</span>
                                <a href="{{ route('product.detail', $related->slug) }}" class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
