<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Devuelve un array indicando que cada categoria es un tipo de pescado
            // (fresh(id:0), frozen(id:1), cut(id:2), seafood(id:3))
//            'name' => $this->faker->randomElement(['fresh', 'frozen', 'cut', 'seafood']),
                'name' => $this->getCategory(),

        ];
    }

    //this would have to be removes in the future.
    // This function is used to get a random category
    private function getCategory(): string
    {
        $categories = [
            'fresh' => 50,  // 50% chance
            'frozen' => 20, // 20% chance
            'cut' => 20,    // 20% chance
            'seafood' => 10 // 10% chance
        ];

        $totalWeight = array_sum($categories);
        $random = mt_rand(1, $totalWeight);

        foreach ($categories as $category => $weight) {
            if ($random <= $weight) {
                return $category;
            }
            $random -= $weight;
        }

        return 'fresh'; // Default
    }
}
