<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'total_amount' => fake()->randomFloat(2, 5000, 100000),
            'status' => collect($statuses)->random(),
            'shipping_address' => fake()->address(),
            'phone' => '03' . fake()->numerify('#########'),
        ];
    }
}
