<?php

namespace Database\Factories;

use Database\Seeders\ProductSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $products = ProductSeeder::$products;
        $product = $this->faker->randomElement($products);
        return [
            'name' => $product['name'],
            'category_id' => $product['category_id'],
            'price_per_kg' => $product['price_per_kg'],
            'stock_kg' => $product['stock_kg'],
            'description' => $product['description'],
        ];
    }
}
