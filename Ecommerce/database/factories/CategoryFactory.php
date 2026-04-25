<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $pakistaniCategories = [
            'Electronics' => 'electronics',
            'Clothing' => 'clothing',
            'Home & Kitchen' => 'home-kitchen',
            'Books' => 'books',
            'Sports & Outdoors' => 'sports-outdoors',
            'Beauty & Personal Care' => 'beauty-personal-care',
            'Toys & Games' => 'toys-games',
            'Furniture' => 'furniture',
            'Groceries' => 'groceries',
            'Automotive' => 'automotive',
        ];

        $name = array_key_first($pakistaniCategories);
        $slug = $pakistaniCategories[$name];
        unset($pakistaniCategories[$name]);

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => fake()->paragraph(),
            'image' => 'https://via.placeholder.com/300x200?text=' . urlencode($name),
        ];
    }
}
