<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/category/{slug}', [HomeController::class, 'categoryProducts'])->name('category.products');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Customer Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/order/{id}', [CustomerController::class, 'viewOrder'])->name('customer.order.detail');
    Route::get('/contact', [CustomerController::class, 'contactForm'])->name('customer.contact');
    Route::post('/contact', [CustomerController::class, 'submitContact'])->name('customer.contact.submit');
});

// Cart Routes
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/{id}/update', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/{id}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Customers Management
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/customers/data', [AdminController::class, 'getCustomers'])->name('customers.data');
    Route::get('/customer/{id}', [AdminController::class, 'customerDetail'])->name('customer.detail');

    // Orders Management
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/orders/data', [AdminController::class, 'getOrders'])->name('orders.data');
    Route::get('/order/{id}', [AdminController::class, 'orderDetail'])->name('order.detail');
    Route::put('/order/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('order.status.update');

    // Products Management
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/data', [AdminController::class, 'getProducts'])->name('products.data');
    Route::get('/product/create', [AdminController::class, 'createProduct'])->name('product.create');
    Route::post('/product', [AdminController::class, 'storeProduct'])->name('product.store');
    Route::get('/product/{id}/edit', [AdminController::class, 'editProduct'])->name('product.edit');
    Route::put('/product/{id}', [AdminController::class, 'updateProduct'])->name('product.update');
    Route::delete('/product/{id}', [AdminController::class, 'deleteProduct'])->name('product.delete');

    // Categories Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/categories/data', [AdminController::class, 'getCategories'])->name('categories.data');
    Route::get('/category/create', [AdminController::class, 'createCategory'])->name('category.create');
    Route::post('/category', [AdminController::class, 'storeCategory'])->name('category.store');
    Route::get('/category/{id}/edit', [AdminController::class, 'editCategory'])->name('category.edit');
    Route::put('/category/{id}', [AdminController::class, 'updateCategory'])->name('category.update');
    Route::delete('/category/{id}', [AdminController::class, 'deleteCategory'])->name('category.delete');

    // Contacts
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::get('/contact/{id}', [AdminController::class, 'contactDetail'])->name('contact.detail');
    Route::post('/contact/{id}/reply', [AdminController::class, 'submitReply'])->name('contact.reply');
});
