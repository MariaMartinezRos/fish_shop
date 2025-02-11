<?php

namespace Database\Factories;

use App\Models\Fish;
use Illuminate\Database\Eloquent\Factories\Factory;

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
}
