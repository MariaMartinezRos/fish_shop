<?php

namespace Database\Seeders;

use App\Models\TypeWater;
use Illuminate\Database\Seeder;

class TypeWaterSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        //        TypeWater::factory()->create(['type' => 'Freshwater']);
        //        TypeWater::factory()->create(['type' => 'Saltwater']);

        $types = [
            ['type' => 'Freshwater'],
            ['type' => 'Saltwater'],
        ];

        foreach ($types as $type) {
            TypeWater::create($type);
        }
    }

    private function isDataAlreadyGiven(): bool
    {
        return TypeWater::where('type', 'Freshwater')->exists()
            && TypeWater::where('type', 'Saltwater')->exists();
    }
}
