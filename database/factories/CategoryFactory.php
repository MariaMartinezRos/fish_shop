<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
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
//        static $categories = ['fresh', 'frozen', 'cut', 'seafood', 'other'];
//        $name = array_shift($categories) ?? 'other';

//        return [
//            'name' => $name,
//        ];
        return [
            'name' => fake()->name(),
        ];

    }
}
