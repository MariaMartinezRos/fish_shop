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
        static $categories = ['fresh', 'frozen', 'cut', 'seafood'];
        $name = array_shift($categories) ?? 'fresh';

        return [
            'name' => $name,
        ];
    }
}
