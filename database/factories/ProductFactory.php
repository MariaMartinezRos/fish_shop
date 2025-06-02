<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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

    public function configure(): self
    {
        return $this->afterCreating(function (Product $product) {
            $fishes = \App\Models\Fish::inRandomOrder()->take(rand(1,3))->get();
            foreach ($fishes as $fish) {
                $product->fishes()->attach($fish->id, [
                    'days_on_sale' => $this->faker->numberBetween(1, 5),
                    'supplier' => $this->faker->company,
                ]);
            }
        });
    }

    public function released(?Carbon $date = null): self
    {
        return $this->state(
            fn (array $attributes) => [
                'created_at' => $date ?? Carbon::now(),
                'updated_at' => $date ?? Carbon::now(),
            ]
        );
    }
}
