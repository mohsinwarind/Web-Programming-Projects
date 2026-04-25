@extends('layout')

@section('title', 'Shopping Cart - E-Commerce Store')

@section('content')
<div class="container" style="margin: 40px 0;">
    <h1 style="color: #333; margin-bottom: 30px;">
        <i class="fas fa-shopping-cart"></i> Shopping Cart
    </h1>

    @if($cartItems->count() > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-md-8">
                <div style="background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); overflow: hidden;">
                    <table class="table table-hover" style="margin: 0;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('product.detail', $item->product->slug) }}" style="color: #667eea; text-decoration: none; font-weight: 500;">
                                            {{ $item->product->name }}
                                        </a>
                                        <br>
                                        <small style="color: #999;">Category: {{ $item->product->category->name }}</small>
                                    </td>
                                    <td>
                                        <strong>Rs. {{ number_format($item->product->price, 0) }}</strong>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.update', $item->id) }}" style="display: inline;">
                                            @csrf
                                            <div style="display: flex; gap: 5px;">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control" style="width: 70px; padding: 5px;">
                                                <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 5px 10px;">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <strong style="color: #667eea;">Rs. {{ number_format($item->product->price * $item->quantity, 0) }}</strong>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $item->id) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Remove from cart">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Continue Shopping Link -->
                <div style="margin-top: 20px;">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-md-4">
                <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); position: sticky; top: 20px;">
                    <h4 style="color: #333; margin-bottom: 20px;">Order Summary</h4>

                    <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span>Subtotal:</span>
                            <strong>Rs. {{ number_format($total, 0) }}</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span>Shipping:</span>
                            <strong>Rs. 0</strong>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Tax:</span>
                            <strong>Rs. 0</strong>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 18px;">
                        <strong>Total:</strong>
                        <strong style="color: #667eea;">Rs. {{ number_format($total, 0) }}</strong>
                    </div>

                    <button class="btn btn-primary btn-lg w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; margin-bottom: 10px;">
                        <i class="fas fa-credit-card"></i> Proceed to Checkout
                    </button>

                    <form method="POST" action="{{ route('cart.clear') }}" style="display: inline; width: 100%;">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure you want to clear your cart?');">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div style="text-align: center; padding: 60px 20px;">
            <i class="fas fa-shopping-cart" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></i>
            <h2 style="color: #999; margin-bottom: 20px;">Your cart is empty</h2>
            <p style="color: #999; margin-bottom: 30px;">Add some products to get started!</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                <i class="fas fa-shopping-bag"></i> Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
