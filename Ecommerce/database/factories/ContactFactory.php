<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'subject' => fake()->sentence(),
            'message' => fake()->paragraph(),
        ];
    }
}
