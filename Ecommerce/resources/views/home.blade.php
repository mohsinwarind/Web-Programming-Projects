@extends('layout')

@section('title', 'Home - EComm Store')

@section('extra-css')
<style>
    .promo-section {
        background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
        color: white;
        padding: 80px 40px;
        border-radius: 16px;
        margin: 80px 0;
        text-align: center;
    }

    .promo-section h2 {
        font-size: 44px;
        font-weight: 800;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
    }

    .promo-section p {
        font-size: 18px;
        margin-bottom: 32px;
        opacity: 0.95;
    }

    .promo-section .btn {
        background: white;
        color: #6366f1;
        font-weight: 700;
        padding: 12px 40px;
        border-radius: 8px;
        border: none;
        transition: all 0.3s ease;
    }

    .promo-section .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Hero Slider -->
    <div class="hero-slider">
        <div class="slide" style="background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%); display: flex; align-items: center; justify-content: center;">
            <div class="slide-content">
                <h1 class="slide-title">Discover Amazing Products</h1>
                <p class="slide-subtitle">Quality items at unbeatable prices</p>
                <a href="#categories" class="btn btn-primary btn-lg" style="padding: 14px 48px;">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <section style="margin: 80px 0;" id="categories">
        <h2 class="section-title">Shop by Category</h2>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="category-card">
                        <a href="{{ route('category.products', $category->slug) }}">
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" class="category-card-image">
                            <h5>{{ $category->name }}</h5>
                            <p>{{ $category->products()->count() }} items</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Featured Products -->
    <section style="margin: 80px 0;" id="products">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h2 class="section-title" style="margin-bottom: 0;">Featured Products</h2>
            <a href="#" style="color: #6366f1; text-decoration: none; font-weight: 600;">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="row">
            @foreach($featuredProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-img">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <p class="product-price">Rs. {{ number_format($product->price, 0) }}</p>
                            <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-primary btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Latest Products -->
    <section style="margin: 80px 0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h2 class="section-title" style="margin-bottom: 0;">Latest Arrivals</h2>
            <a href="#" style="color: #6366f1; text-decoration: none; font-weight: 600;">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-card">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-img">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <p class="product-price">Rs. {{ number_format($product->price, 0) }}</p>
                            <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-primary btn-sm w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Promo Section -->
    <div class="promo-section">
        <h2>Limited Time Offer!</h2>
        <p>Unlock exclusive deals and save big on premium products</p>
        @guest
            <a href="{{ route('register') }}" class="btn">Create Account</a>
        @else
            <a href="{{ route('cart.view') }}" class="btn">Shop Now</a>
        @endguest
    </div>
</div>

@endsection
