<?php

namespace Database\Factories;

use App\Models\Fish;
use App\Models\TypeWater;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FishFactory extends Factory
{
    protected $model = Fish::class;

    public function definition(): array
    {

        return [
            'name' => $this->faker->name,
            'scientific_name' => $this->faker->name,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->text,
            'average_size_cm' => $this->faker->randomFloat(2, 1.0, 100.0),
            'diet' => $this->faker->randomElement(['Carnivore', 'Herbivore', 'Omnivore']),
            'lifespan_years' => $this->faker->numberBetween(1, 100),
            'habitat' => $this->faker->name,
            'conservation_status' => $this->faker->name,
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Fish $fish) {
            if (TypeWater::count() > 0) {
                $typeWater = TypeWater::inRandomOrder()->first();
            } else {
                $typeWater = TypeWater::factory()->create();
            }

            $fish->typeWater()->attach($typeWater->id, [
                'state' => $this->faker->randomElement(['Allowed', 'Forbidden', 'Biological rest']),
                'temperature_range' => $this->faker->randomElement(['22-28°C', '24-30°C', '20-25°C']),
                'ph_range' => $this->faker->randomElement(['6.5-7.5', '7.0-8.0', '6.0-7.0']),
                'salinity' => $this->faker->randomFloat(2, 1.020, 1.030),
                'oxygen_level' => $this->faker->randomFloat(2, 4.0, 8.0),
                'notes' => $this->faker->paragraph,
            ]);
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
