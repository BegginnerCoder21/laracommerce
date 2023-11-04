<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(random_int(1,2),true),
            'description' => fake()->sentences(random_int(3,5),true),
            'images' => fake()->imageUrl(),
            'price' => random_int(10000,30000),
            'active' => fake()->boolean(80)
        ];
    }
}
