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
//            'type_water_id' => TypeWater::factory(),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Fish $fish) {
            // Obtiene un tipo de agua aleatorio o lo crea
//            $typeWater = TypeWater::inRandomOrder()->first() ?? TypeWater::factory()->create();

            if (TypeWater::count() > 0) {
                // Si existen, elige uno aleatorio
                $typeWater = TypeWater::inRandomOrder()->first();
            } else {
                // Si no existen, crea uno
                $typeWater = TypeWater::factory()->create();
            }

            // Asocia el pez con el tipo de agua en la tabla intermedia
            $fish->TypeWater()->attach($typeWater->id);
        });
    }

//    public function configure(): FishFactory
//    {
//        return $this->afterCreating(function (Fish $fish) {
//            $typeWater = TypeWater::inRandomOrder()->first();
//            $fish->typeWater()->attach($typeWater);
//        });
//    }

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
