<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EComm - Modern Shopping')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --secondary: #ec4899;
            --dark: #1f2937;
            --gray: #6b7280;
            --light-gray: #f3f4f6;
            --border: #e5e7eb;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: #ffffff;
            color: var(--dark);
            line-height: 1.6;
        }

        /* Header & Navigation */
        header {
            background: var(--dark);
            color: white;
            padding: 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand i {
            color: var(--primary);
        }

        .navbar-nav {
            align-items: center;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7) !important;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
            margin: 0 8px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
        }

        .btn-cart {
            background: var(--primary) !important;
            color: white !important;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .btn-cart:hover {
            background: var(--primary-dark) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            color: white !important;
        }

        .btn-logout {
            background: var(--danger) !important;
            border: none;
            color: white !important;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: #dc2626 !important;
            transform: translateY(-2px);
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 200px);
        }

        /* Cards & General Styles */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            transform: translateY(-4px);
        }

        /* Product Cards */
        .product-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .product-card:hover {
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
            transform: translateY(-8px);
        }

        .product-img {
            height: 280px;
            object-fit: cover;
            background: var(--light-gray);
        }

        .product-card .card-body {
            flex: 1;
            padding: 16px;
            display: flex;
            flex-direction: column;
        }

        .product-card .card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
            line-height: 1.4;
            flex: 1;
        }

        .product-card .card-text {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .product-card .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 24px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
            color: white;
        }

        .btn-secondary {
            background: var(--light-gray);
            color: var(--dark);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--border);
            color: var(--dark);
        }

        .btn-outline-secondary {
            border: 2px solid var(--border);
            color: var(--dark);
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-sm {
            border-radius: 6px;
            font-size: 13px;
            padding: 6px 12px;
        }

        /* Forms */
        .form-control,
        .form-select {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
            border-left: 4px solid;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            border-left-color: var(--success);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border-left-color: var(--danger);
        }

        .alert-info {
            background: rgba(99, 102, 241, 0.1);
            color: #3730a3;
            border-left-color: var(--primary);
        }

        /* Hero & Sections */
        .hero-slider {
            margin-bottom: 60px;
        }

        .slide {
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            overflow: hidden;
        }

        .slide-content {
            text-align: center;
            z-index: 2;
        }

        .slide-title {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 16px;
            color: white;
            letter-spacing: -1px;
        }

        .slide-subtitle {
            font-size: 20px;
            margin-bottom: 32px;
            color: rgba(255, 255, 255, 0.9);
        }

        .section-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 40px;
            color: var(--dark);
            letter-spacing: -0.5px;
        }

        /* Category Cards */
        .category-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            padding: 24px;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .category-card:hover {
            border-color: var(--primary);
            box-shadow: 0 12px 24px rgba(99, 102, 241, 0.15);
            transform: translateY(-8px);
        }

        .category-card a {
            text-decoration: none;
            color: inherit;
            width: 100%;
        }

        .category-card-image {
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 16px;
            width: 100%;
        }

        .category-card h5 {
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .category-card p {
            color: var(--gray);
            font-size: 14px;
            margin: 0;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 20px;
            margin-top: 80px;
            border-top: 1px solid var(--border);
        }

        .footer h5 {
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .footer ul {
            list-style: none;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
            display: block;
            margin-bottom: 8px;
        }

        .footer a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 40px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        /* Utility Classes */
        .text-muted {
            color: var(--gray) !important;
        }

        .badge {
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 6px;
        }

        .badge.bg-success {
            background: rgba(16, 185, 129, 0.2) !important;
            color: var(--success);
        }

        .badge.bg-warning {
            background: rgba(245, 158, 11, 0.2) !important;
            color: #92400e;
        }

        .badge.bg-danger {
            background: rgba(239, 68, 68, 0.2) !important;
            color: #991b1b;
        }

        .badge.bg-info {
            background: rgba(99, 102, 241, 0.2) !important;
            color: #3730a3;
        }

        .badge.bg-primary {
            background: rgba(99, 102, 241, 0.2) !important;
            color: var(--primary);
        }

        .slick-prev, .slick-next {
            z-index: 10;
            background: rgba(0, 0, 0, 0.3) !important;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
        }

        .slick-prev:hover, .slick-next:hover {
            background: rgba(0, 0, 0, 0.5) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .slide-title {
                font-size: 36px;
            }

            .slide-subtitle {
                font-size: 18px;
            }

            .section-title {
                font-size: 28px;
            }

            .navbar-brand {
                font-size: 20px;
            }

            .nav-link {
                margin: 8px 0;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-shopping-bag"></i> EComm
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: rgba(255,255,255,0.5);">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn-cart" href="{{ route('cart.view') }}">
                                    <i class="fas fa-shopping-cart"></i> Cart
                                </a>
                            </li>
                            @if(auth()->user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.contact') }}">Contact</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-logout">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container" style="margin-top: 24px; margin-bottom: 40px;">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-circle"></i> Errors:</strong>
                    <ul class="mb-0" style="margin-top: 8px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row" style="margin-bottom: 40px;">
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5><i class="fas fa-shopping-bag"></i> EComm</h5>
                    <p style="font-size: 14px; color: rgba(255,255,255,0.7); margin-top: 12px;">Your trusted destination for quality products and amazing shopping experience.</p>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('home') }}#categories">Categories</a></li>
                        <li><a href="{{ route('home') }}#products">Products</a></li>
                        @auth
                            <li><a href="{{ route('customer.dashboard') }}">My Orders</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5>Support</h5>
                    <ul>
                        <li><a href="{{ route('customer.contact') }}">Contact Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <h5>Follow Us</h5>
                    <div style="display: flex; gap: 12px; margin-top: 12px;">
                        <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 8px; color: white; transition: all 0.3s;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 8px; color: white; transition: all 0.3s;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 8px; color: white; transition: all 0.3s;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 8px; color: white; transition: all 0.3s;">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 EComm Store. All rights reserved. | <a href="#" style="color: rgba(255,255,255,0.7);">Privacy Policy</a> | <a href="#" style="color: rgba(255,255,255,0.7);">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.hero-slider').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                dots: true,
                arrows: true,
                infinite: true,
                speed: 500
            });
        });
    </script>
</body>
</html>
