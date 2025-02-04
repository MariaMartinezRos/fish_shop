<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'guest',
            'display_name' => 'Visitor',
            'description' => 'User has limited access for viewing public resources',
        ];
    }
}
