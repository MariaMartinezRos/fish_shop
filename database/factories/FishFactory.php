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
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->text,
        ];
    }

    public function configure(): FishFactory
    {
        return $this->afterCreating(function (Fish $fish) {
            $typeWater = TypeWater::inRandomOrder()->first();
            $fish->typeWater()->attach($typeWater);
        });
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
