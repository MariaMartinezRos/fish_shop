<?php

namespace Database\Factories;

use App\Models\TypeWater;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TypeWaterFactory extends Factory
{
    protected $model = TypeWater::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Freshwater', 'Saltwater']),
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

