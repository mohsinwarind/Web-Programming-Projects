# EComm - Modern E-Commerce Platform

A full-featured e-commerce application built with **Laravel 12**, featuring a modern responsive UI, complete admin dashboard, shopping cart system and comprehensive order management.

##  Project Demo Video
**[Ecommerce Project Video Link](https://drive.google.com/file/d/1fCvI0-o_J4mZfk0SsN2YafNllyDcc_NO/view?usp=sharing)**

---

##  Key Features

###  Customer Features
- **User Authentication**
  - Secure login and registration
  - Session-based authentication with bcrypt password hashing
  - Logout functionality

- **Product Browsing**
  - Modern responsive homepage with hero slider
  - Browse products by categories
  - Detailed product pages with descriptions, pricing, and stock information
  - Search and filter capabilities

- **Shopping Cart**
  - Add/remove products from cart
  - Update product quantities
  - Persistent cart storage
  - Real-time cart count display
  - Clear entire cart functionality

- **Order Management**
  - Place orders from shopping cart
  - View order history
  - Track order status (Pending → Processing → Shipped → Delivered)
  - Order details with items breakdown
  - Shipping address and contact information

- **Customer Contact**
  - Submit contact messages (restricted to logged-in users only)
  - View admin replies on submitted messages
  - In-app conversation with admin support

###  Admin Features
- **Admin Dashboard**
  - 6 main dashboard sections with statistics
  - Real-time sales and order data
  - User and inventory overview

- **Customer Management**
  - View all customers with Yajra DataTables
  - Search and filter customers
  - Customer detail pages with order history
  - Role-based access control

- **Order Management**
  - Complete order listing with advanced filtering (Yajra DataTables)
  - Order status management (update order statuses)
  - Color-coded status badges
  - Detailed order information with line items
  - Shipping and payment details

- **Product Management**
  - Full CRUD operations for products
  - Image upload support with local storage
  - Category association
  - Stock management
  - Price management (in Pakistani Rupees)
  - Slug-based URL generation

- **Category Management**
  - Create, read, update, delete categories
  - Category images
  - Product count per category
  - Description management

- **Contact Management**
  - View all customer inquiries
  - Read detailed messages
  - **Reply to customers directly in-app** (no email referral)
  - Conversation history with customers
  - Admin-to-customer messaging system

---

##  Technology Stack

### Backend
- **Laravel 12** - Modern PHP framework
- **PHP 8.2+** - Latest stable version
- **SQLite** - Database (lightweight, file-based)
- **Eloquent ORM** - Database abstraction layer

### Frontend
- **Bootstrap 5.3.0** - Responsive grid and components
- **Blade Templating** - Server-side rendering
- **Font Awesome 6.4.0** - Icon library
- **Slick Carousel 1.8.1** - Image slider
- **jQuery 3.6.0** - DOM manipulation
- **Modern CSS** - Custom design system with CSS variables

### Data Management
- **Yajra DataTables 10.0** - Server-side processing for:
  - Customer listings
  - Order listings
  - Product listings
  - Category listings

---

##  Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm
- XAMPP or similar local development environment

### Step 1: Clone/Extract Project
```bash
cd c:\xampp\htdocs\Web-Programming-Projects\Ecommerce
```

### Step 2: Install Dependencies
```bash
composer install
npm install
```

### Step 3: Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Database Setup
```bash
# Run migrations and seed database with test data
php artisan migrate:fresh --seed

# Create storage link for image uploads
php artisan storage:link
```

### Step 5: Run Development Server
```bash
php artisan serve
```

Access the application at: **http://localhost:8000**



---

## 🔐 Test Credentials

### Admin Account
- **Email:** admin@example.com
- **Password:** password
- **Role:** Admin (full access to dashboard)

### Customer Accounts
Multiple customer accounts are pre-seeded :
- **Email:** customer@example.com
- **Password:** password
- **Role:** Customer (shopping and order placement)

All test accounts use the password: `password`

---

##  Database Schema

### Tables Created
1. **users** - Customer and admin accounts with roles
2. **categories** - Product categories with images
3. **products** - Product inventory with pricing
4. **orders** - Customer orders with status tracking
5. **order_items** - Individual items in orders
6. **carts** - Shopping cart items
7. **contacts** - Customer contact messages
8. **replies** - Admin replies to customer messages
9. **cache** - Laravel cache table
10. **jobs** - Queue job processing



##  Project Structure

```
Ecommerce/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Login, register, logout
│   │   │   ├── HomeController.php      # Homepage and product browsing
│   │   │   ├── CustomerController.php  # Customer dashboard and orders
│   │   │   ├── AdminController.php     # Admin dashboard (40+ methods)
│   │   │   └── CartController.php      # Shopping cart management
│   │   └── Middleware/
│   │       └── AdminMiddleware.php     # Role-based access control
│   ├── Models/
│   │   ├── User.php          # User model with roles
│   │   ├── Category.php       # Product categories
│   │   ├── Product.php        # Product inventory
│   │   ├── Order.php          # Order records
│   │   ├── OrderItem.php      # Order line items
│   │   ├── Cart.php           # Shopping cart
│   │   ├── Contact.php        # Customer messages
│   │   └── Reply.php          # Admin replies
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/            # 10 migration files
│   ├── factories/             # UserFactory for testing
│   └── seeders/               # DatabaseSeeder with test data
├── resources/
│   ├── css/
│   │   └── app.css            # Main stylesheet
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── layout.blade.php              # Master template
│       ├── home.blade.php                # Homepage
│       ├── product-detail.blade.php      # Product details
│       ├── category-products.blade.php   # Category listings
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── customer/
│       │   ├── dashboard.blade.php       # Customer orders
│       │   ├── order-detail.blade.php
│       │   └── contact-form.blade.php
│       ├── cart/
│       │   └── index.blade.php           # Shopping cart
│       └── admin/                        # 14 admin views
│           ├── dashboard.blade.php
│           ├── customers.blade.php       # Yajra DataTable
│           ├── orders.blade.php          # Yajra DataTable
│           ├── products.blade.php        # Yajra DataTable
│           ├── categories.blade.php      # Yajra DataTable
│           ├── contacts.blade.php
│           └── ...
├── routes/
│   └── web.php                # 30+ routes (public, auth, customer, admin)
├── storage/
│   └── app/public/            # Uploaded product/category images
└── config/
    └── app.php, auth.php, database.php, etc.
```

---

##  Usage Guide

### For Customers

#### 1. Registration & Login
- Click **Register** on homepage
- Fill in name, email, and password
- Login with credentials

#### 2. Browse Products
- View categories on homepage
- Click category to see products
- Click product to view details and price

#### 3. Shopping Cart
- Add products to cart from product details page
- Update quantities in cart
- Proceed to checkout

#### 4. Place Order
- View cart items and total
- Click "Place Order" (creates order from cart)
- Order automatically clears cart

#### 5. Track Orders
- Go to **Dashboard** (top-right menu)
- View all orders with status
- Click order to see details and items

#### 6. Contact Support
- Navigate to **Contact Form** (in customer menu)
- Submit message/inquiry
- View admin replies in message conversation

### For Admins

#### 1. Admin Login
- Login with admin@example.com / password
- Access admin dashboard

#### 2. Manage Customers
- View all customers in DataTable
- Search and filter customers
- Click customer name to see details and order history

#### 3. Manage Orders
- View all orders with status badges
- Change order status (Pending → Processing → Shipped → Delivered)
- View order items and shipping details

#### 4. Manage Products
- Add new products with images and pricing
- Edit existing products
- Delete products
- Assign to categories
- Search products in DataTable

#### 5. Manage Categories
- Create product categories
- Upload category images
- View products in each category
- Edit/delete categories

#### 6. Respond to Customer Inquiries
- View all customer contact messages
- Click on message to see full details
- Write and submit replies directly in the app
- View conversation history

---

##  Security Features

 **CSRF Protection** - All forms include CSRF tokens (@csrf)  
 **Password Hashing** - bcrypt encryption for all passwords  
 **Role-Based Access** - Admin middleware controls dashboard access  
 **Session Authentication** - Laravel's built-in auth system  
 **Form Validation** - Server-side validation on all inputs  
 **Ownership Verification** - Users can only view their own orders  

---

##  Form Validation

All forms include comprehensive validation:
- **Email** - Valid email format, unique for registration
- **Password** - Minimum length, confirmation match
- **Products** - Price, stock, category validation
- **Orders** - Shipping address, phone validation
- **Messages** - Required subject and message content

---

##  Key Packages

```json
{
  "laravel/framework": "^12.0",
  "yajra/laravel-datatables": "^10.0",
  "intervention/image": "^2.7",
  "laravel/tinker": "^2.9",
  "laravel/pint": "^1.0",
  "phpunit/phpunit": "^11.0"
}
```

---

##  Troubleshooting

### Database Issues
```bash
# Reset database with fresh data
php artisan migrate:fresh --seed

# View database file
# SQLite database located at: database/database.sqlite
```

### Asset Loading Issues
```bash
# Rebuild frontend assets
npm run dev

# Create storage link for uploads
php artisan storage:link
```

### Permission Issues
```bash
# Ensure storage folder is writable
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---




## 👤 Author

Name : Muhammad Mohsin
Roll No : COSC231101024
---
