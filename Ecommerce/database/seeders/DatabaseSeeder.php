<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create admin user
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create regular users with Pakistani names
        User::factory(10)->create();

        // Create categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing & Fashion', 'slug' => 'clothing-fashion'],
            ['name' => 'Home & Kitchen', 'slug' => 'home-kitchen'],
            ['name' => 'Books & Media', 'slug' => 'books-media'],
            ['name' => 'Sports & Outdoors', 'slug' => 'sports-outdoors'],
            ['name' => 'Beauty & Personal Care', 'slug' => 'beauty-care'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games'],
            ['name' => 'Furniture', 'slug' => 'furniture'],
            ['name' => 'Groceries', 'slug' => 'groceries'],
            ['name' => 'Automotive', 'slug' => 'automotive'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => 'High-quality ' . strtolower($category['name']) . ' products',
                'image' => 'https://placehold.co/300x200/667eea/ffffff?text=' . urlencode($category['name']),
            ]);
        }

        // Create products
        $productData = [
            'Electronics' => [
                ['name' => 'Laptop Computer', 'price' => 95000, 'description' => 'High-performance laptop for work and gaming'],
                ['name' => 'Wireless Headphones', 'price' => 3500, 'description' => 'Premium sound quality wireless headphones'],
                ['name' => 'Smartphone', 'price' => 45000, 'description' => 'Latest model smartphone with amazing camera'],
                ['name' => 'Tablet', 'price' => 25000, 'description' => 'Portable tablet for entertainment and work'],
                ['name' => 'Smartwatch', 'price' => 8000, 'description' => 'Fitness tracking smartwatch with heart rate monitor'],
                ['name' => 'Digital Camera', 'price' => 28000, 'description' => 'Professional digital camera for photography'],
                ['name' => 'Portable Speaker', 'price' => 4500, 'description' => 'Waterproof portable Bluetooth speaker'],
                ['name' => 'USB-C Cable', 'price' => 800, 'description' => 'Durable USB-C charging cable'],
            ],
            'Clothing & Fashion' => [
                ['name' => 'Cotton T-Shirt', 'price' => 1200, 'description' => '100% pure cotton comfortable t-shirt'],
                ['name' => 'Denim Jeans', 'price' => 3500, 'description' => 'Premium denim jeans with perfect fit'],
                ['name' => 'Formal Shirt', 'price' => 2000, 'description' => 'Professional formal shirt for office wear'],
                ['name' => 'Cotton Dupatta', 'price' => 1500, 'description' => 'Beautiful traditional cotton dupatta'],
                ['name' => 'Kurta Pajama', 'price' => 3000, 'description' => 'Traditional Pakistani kurta pajama set'],
                ['name' => 'Running Shoes', 'price' => 5000, 'description' => 'Comfortable running shoes with cushioning'],
            ],
            'Home & Kitchen' => [
                ['name' => 'Bed Sheet Set', 'price' => 2200, 'description' => 'Soft cotton bed sheet set of 3 pieces'],
                ['name' => 'Kitchen Knife Set', 'price' => 3000, 'description' => 'Professional kitchen knife set'],
                ['name' => 'Coffee Maker', 'price' => 4500, 'description' => 'Automatic coffee maker machine'],
                ['name' => 'Pressure Cooker', 'price' => 3500, 'description' => 'Stainless steel pressure cooker'],
                ['name' => 'Cooking Pot Set', 'price' => 2000, 'description' => 'Non-stick cooking pot set'],
            ],
            'Books & Media' => [
                ['name' => 'Programming Book', 'price' => 1200, 'description' => 'Learn programming basics'],
                ['name' => 'Urdu Novel', 'price' => 600, 'description' => 'Popular Urdu fiction novel'],
                ['name' => 'English Dictionary', 'price' => 800, 'description' => 'Comprehensive English dictionary'],
            ],
            'Sports & Outdoors' => [
                ['name' => 'Cricket Bat', 'price' => 4000, 'description' => 'Professional cricket bat'],
                ['name' => 'Football', 'price' => 1500, 'description' => 'Professional football for practice'],
                ['name' => 'Tennis Racket', 'price' => 5000, 'description' => 'High-quality tennis racket'],
            ],
        ];

        foreach ($productData as $categoryName => $products) {
            $category = Category::where('name', $categoryName)->first();
            foreach ($products as $product) {
                Product::create([
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'price' => $product['price'],
                    'description' => $product['description'],
                    'stock' => rand(20, 200),
                    'category_id' => $category->id,
                    'image' => 'https://placehold.co/300x300/667eea/ffffff?text=' . urlencode($product['name']),
                ]);
            }
        }

        // Create orders with order items
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        foreach ($users as $user) {
            $numOrders = rand(1, 4);
            for ($i = 0; $i < $numOrders; $i++) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'total_amount' => 0,
                    'status' => collect(['pending', 'processing', 'shipped', 'delivered'])->random(),
                    'shipping_address' => $this->getPakistaniAddress(),
                    'phone' => '03' . rand(100000000, 999999999),
                ]);

                $numItems = rand(1, 4);
                $totalAmount = 0;
                for ($j = 0; $j < $numItems; $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 3);
                    $itemTotal = $product->price * $quantity;
                    $totalAmount += $itemTotal;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ]);
                }

                $order->update(['total_amount' => $totalAmount]);
            }
        }

        // Create contact messages from users
        foreach ($users->random(8) as $user) {
            Contact::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'subject' => collect([
                    'Product Inquiry',
                    'Delivery Issue',
                    'Product Quality',
                    'Return Request',
                    'General Feedback',
                ])->random(),
                'message' => 'This is a test message from ' . $user->name . '. Please assist me with my inquiry.',
            ]);
        }
    }

    private function getPakistaniAddress(): string
    {
        $cities = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Multan', 'Peshawar', 'Quetta', 'Hyderabad'];
        $areas = ['Block A', 'Block B', 'Defence', 'Gulberg', 'DHA', 'Cantonment', 'Saddar', 'Clifton'];

        return rand(1, 500) . ' ' . collect($areas)->random() . ', ' . collect($cities)->random() . ', Pakistan';
    }
}
