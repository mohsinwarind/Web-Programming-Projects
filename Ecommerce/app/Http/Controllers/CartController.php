<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        // All cart routes require authentication
    }

    /**
     * Display the shopping cart
     */
    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Check if product is already in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            // Update quantity if already in cart
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            // Add new item to cart
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->route('cart.view')
            ->with('success', $product->name . ' added to cart!');
    }

    /**
     * Update cart item quantity
     */
    public function updateQuantity(Request $request, $cartId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return back()->with('error', 'Item not found in cart');
        }

        if ($validated['quantity'] > $cartItem->product->stock) {
            return back()->with('error', 'Insufficient stock available');
        }

        $cartItem->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Quantity updated!');
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart($cartId)
    {
        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return back()->with('error', 'Item not found in cart');
        }

        $productName = $cartItem->product->name;
        $cartItem->delete();

        return back()->with('success', $productName . ' removed from cart!');
    }

    /**
     * Clear entire cart
     */
    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.view')
            ->with('success', 'Cart cleared!');
    }

    /**
     * Get cart count for header
     */
    public function getCartCount()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }
}
