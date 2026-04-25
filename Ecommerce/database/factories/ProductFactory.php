<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $pakistaniProducts = [
            'Laptop Computer' => 45000,
            'Wireless Headphones' => 3500,
            'Smartphone' => 35000,
            'Tablet' => 25000,
            'smartwatch' => 8000,
            'Digital Camera' => 28000,
            'Portable Speaker' => 4500,
            'USB-C Cable' => 800,
            'Power Bank' => 2500,
            'Phone Case' => 600,
            'Cotton T-Shirt' => 1200,
            'Denim Jeans' => 3500,
            'Formal Shirt' => 2000,
            'Cotton Dupatta' => 1500,
            'Kurta Pajama' => 3000,
            'Running Shoes' => 5000,
            'Leather Wallet' => 1800,
            'Watch' => 6000,
            'Sunglasses' => 2500,
            'Bed Sheet Set' => 2200,
            'Kitchen Knife Set' => 3000,
            'Coffee Maker' => 4500,
            'Pressure Cooker' => 3500,
            'Cooking Pot Set' => 2000,
            'Frying Pan' => 1200,
        ];

        $productName = array_key_first($pakistaniProducts);
        $price = $pakistaniProducts[$productName];
        unset($pakistaniProducts[$productName]);

        return [
            'name' => $productName,
            'slug' => Str::slug($productName),
            'description' => fake()->paragraph(),
            'price' => $price,
            'stock' => fake()->numberBetween(10, 500),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'image' => 'https://via.placeholder.com/300x300?text=' . urlencode($productName),
        ];
    }
}
