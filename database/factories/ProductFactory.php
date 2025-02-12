<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
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
        protected $model = Product::class;

        public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name,
            'category_id' => $this->faker->numberBetween(1, 5),
            'price_per_kg' => $this->faker->randomFloat(2, 1, 100),
            'stock_kg' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->sentence(10),
        ];
    }
    public function released(?Carbon $date = null): self
    {
        return $this->state(
            fn (array $attributes) => [
                'created_at' => $date ?? Carbon::now(),
                'updated_at' => $date ?? Carbon::now()
            ]
        );
    }

}
