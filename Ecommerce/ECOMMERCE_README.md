# Laravel E-Commerce Application

A complete, feature-rich e-commerce application built with Laravel 12, featuring authentication, product management, order processing, an admin dashboard, and customer contact forms.

## Features

### 1. **Authentication System**
- User Registration & Login
- Secure password hashing
- Session management
- Logout functionality

### 2. **Customer Features**
- Browse products by category
- View product details
- Customer dashboard with order history
- Order status tracking
- Contact form (for logged-in users only)

### 3. **Admin Dashboard**
Hierarchical admin panel with full CRUD functionality:

#### Dashboard
- Total customers, orders, and revenue statistics
- Pending orders count
- Total products and messages overview
- Recent orders list

#### Customer Management
- View all customers (Yajra DataTable)
- Customer details with order history
- Total spent tracking

#### Order Management  
- View all orders (Yajra DataTable)
- Order details with items breakdown
- Update order status (pending, processing, shipped, delivered, cancelled)
- Shipping information

#### Product Management
- Add, edit, delete products
- Product inventory management
- Category association
- Image upload support

#### Category Management
- Create, edit, delete categories
- Product count per category
- Yajra DataTable view

#### Message Management
- View all customer contact submissions
- Reply functionality
- Modal message viewer

### 4. **Data & Seeding**
- 10 Random users with Pakistani names
- 10 Product categories
- 20+ Products across categories
- 15+ Sample orders with varying statuses
- Random Pakistani-style addresses and phone numbers

### 5. **UI/UX**
- Beautiful gradient design
- Responsive Bootstrap 5 layout
- Image carousel (slider) on homepage
- Category cards with product counts
- Product cards with pricing
- Admin sidebar navigation
- Modern dashboard cards with statistics

## Database Schema

### Tables
- `users` - Customer and admin accounts
- `categories` - Product categories
- `products` - Product listings
- `orders` - Customer orders
- `order_items` - Order line items
- `contacts` - Customer messages

## Admin Credentials

```
Email: admin@example.com
Password: password
```

## User Credentials (Sample)

Any of the seeded users can login with:
- Email: (registered email)
- Password: password

## Installation

### Prerequisites
- PHP 8.2+
- Composer
- SQLite or MySQL

### Setup Steps

1. **Install Dependencies**
```bash
composer install
```

2. **Run Migrations**
```bash
php artisan migrate:fresh --seed
```

3. **Start Development Server**
```bash
php artisan serve
```

4. **Access Application**
- Frontend: http://localhost:8000
- Admin Login: http://localhost:8000/login

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php          # Login, Register, Logout
│   │   ├── HomeController.php          # Homepage, Products, Categories
│   │   ├── CustomerController.php      # Customer Dashboard, Orders
│   │   └── AdminController.php         # Complete Admin Panel
│   └── Middleware/
│       └── AdminMiddleware.php         # Admin Access Control
│
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Product.php
│   ├── Order.php
│   ├── OrderItem.php
│   └── Contact.php

database/
├── migrations/           # Database schema
├── factories/           # Model factories for seeding
└── seeders/             # Database seeding

resources/views/
├── layout.blade.php                    # Main layout
├── home.blade.php                      # Homepage with slider
├── product-detail.blade.php
├── category-products.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── customer/
│   ├── dashboard.blade.php
│   ├── order-detail.blade.php
│   └── contact-form.blade.php
└── admin/
    ├── layout.blade.php
    ├── dashboard.blade.php
    ├── customers.blade.php
    ├── customer-detail.blade.php
    ├── orders.blade.php
    ├── order-detail.blade.php
    ├── products.blade.php
    ├── create-product.blade.php
    ├── edit-product.blade.php
    ├── categories.blade.php
    ├── create-category.blade.php
    ├── edit-category.blade.php
    └── contacts.blade.php

routes/
└── web.php              # All application routes
```

## Key Features Implementation

### 1. Role-Based Access Control
- Users have `role` field (user/admin)
- Admin middleware checks user role
- Admin panel protected by AdminMiddleware

### 2. Yajra DataTables
Used for:
- Customer listing with pagination/sorting
- Order listing with filtering
- Product listing with search
- Category listing with CRUD actions

### 3. Image Upload
- Product images
- Category images
- Stored in `storage/app/public`

### 4. Order Status Management
Statuses:
- `pending` - Recently created
- `processing` - Being prepared
- `shipped` - On the way
- `delivered` - Completed
- `cancelled` - Cancelled by admin

### 5. Contact Form
- Only accessible to logged-in users
- Stores in database
- Admin can view and reply via email

## Technologies Used

- **Backend**: Laravel 12
- **Database**: SQLite/MySQL
- **Frontend**: Bootstrap 5, Blade Templates
- **DataTables**: Yajra Laravel DataTables
- **CSS**: Bootstrap & Custom Gradient Design
- **JavaScript**: jQuery, Slick Carousel

## API Routes

All routes are web routes (not API). Main groups:

```
Public Routes:
- GET  /                    (Home)
- GET  /product/{slug}      (Product Detail)
- GET  /category/{slug}     (Category Products)

Auth Routes:
- GET  /login               (Login Form)
- POST /login               (Login Submit)
- GET  /register            (Register Form)
- POST /register            (Register Submit)
- POST /logout              (Logout)

Customer Routes (require auth):
- GET  /dashboard           (Customer Dashboard)
- GET  /order/{id}          (Order Details)
- GET  /contact             (Contact Form)
- POST /contact             (Submit Message)

Admin Routes (require admin role):
- GET  /admin/dashboard
- GET  /admin/customers
- GET  /admin/orders
- PUT  /admin/order/{id}/status
- Resource routes for products & categories
```

## Customization

### Add More Categories
Edit `database/seeders/DatabaseSeeder.php` and add to the `$categories` array.

### Change Admin Email
Update the admin creation in the seeder:
```php
User::factory()->admin()->create([
    'email' => 'youradmin@example.com',
]);
```

### Modify Product Pricing
Edit `database/factories/ProductFactory.php` to adjust price ranges.

## Security Features

- CSRF Protection on all forms
- Password hashing with bcrypt
- Role-based authorization
- SQL injection prevention (Eloquent ORM)
- Secure session management

## Future Enhancements

- Shopping cart functionality
- Payment gateway integration
- Email notifications
- Product reviews & ratings
- Inventory alerts
- Advanced search & filtering
- Product recommendations
- User profile management
- Address book for customers

## Support

For issues or questions, please check the Laravel documentation at https://laravel.com/docs

## License

MIT License

---

**Created**: April 2026
**Laravel Version**: 12.0+
**PHP Version**: 8.2+
