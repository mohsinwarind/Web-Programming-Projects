<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::latest()->take(12)->get();
        $featuredProducts = Product::inRandomOrder()->take(8)->get();

        return view('home', compact('categories', 'products', 'featuredProducts'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }

    public function categoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->paginate(12);

        return view('category-products', compact('category', 'products'));
    }
}
