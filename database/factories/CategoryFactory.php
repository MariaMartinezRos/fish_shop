<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Devuelve un array indicando que cada categoria es un tipo de pescado
            // (fresh(id:0), frozen(id:1), cut(id:2), seafood(id:3))
            'name' => $this->faker->randomElement(['fresh', 'frozen', 'cut', 'seafood']),
        ];
    }
}
