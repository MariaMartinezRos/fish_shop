<?php

namespace Database\Factories;

use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * @throws \Exception
     */
    public function definition(): array
    {
        //        $products = ProductSeeder::$products;
        //        $product = $this->faker->randomElement($products);
        $product = ProductSeeder::getProduct();

//        return [
//            'name' => $this->faker->name,
//            'category_id' => $this->faker->randomElement([1, 2, 3, 4]),
//            'price_per_kg' => $this->faker->randomFloat(2, 1, 100),
//            'stock_kg' => $this->faker->randomFloat(2, 1, 100),
//            'description' => Str::substr($this->faker->paragraph(), 0, 50),
//        ];

//        return [
//            'title' => $title,
//            'slug' => Str::slug($title),
//            'body' => $this->faker->paragraph() . "\n\n" . $this->faker->paragraph() . "\n\n" . $this->faker->paragraph(),
//            'summary' => Str::substr($this->faker->paragraph(), 0, 50),
//            'published_at' => random_int(0, 2)
//                ? $this->faker->dateTimeBetween('-1 month', '+1 months')
//                : null,
//            'status' => $options[$num],
//            'reading_time' => random_int(1, 10),
//        ];
        return [
            'name' => $product['name'],
            'category_id' => $product['category_id'],
            'price_per_kg' => $product['price_per_kg'],
            'stock_kg' => $product['stock_kg'],
            'description' => $product['description'],
        ];
    }
}
