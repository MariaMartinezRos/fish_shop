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

    public function configure(): self
    {
        return $this->afterCreating(function (TypeWater $typeWater) {
            if ($typeWater->type === 'Freshwater') {
                return [
                    'description' => 'Water with low salt concentration, found in rivers and lakes.',
                    'ph_level' => 7.2,
                    'temperature_range' => '10-25°C',
                    'salinity_level' => 0.05,
                    'region' => 'Rivers, Lakes, Ponds',
                ];
            } else {
                return [
                    'description' => 'Water with high salt concentration, found in oceans and seas.',
                    'ph_level' => 8.1,
                    'temperature_range' => '2-30°C',
                    'salinity_level' => 35.00,
                    'region' => 'Oceans, Seas',
                ];
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
