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
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'price' => fake()->numberBetween(10, 100) * 1000,
            'category' => fake()->randomElement([
                'makanan',
                'minuman',
                'sembako',
                'alat tulis'
            ])
        ];
    }
}
