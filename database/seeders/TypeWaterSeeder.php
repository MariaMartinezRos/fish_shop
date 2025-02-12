<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\TypeWater;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TypeWaterSeeder extends Seeder
{
    public function run(): void
    {
        TypeWater::factory()->count(20)->released()->create();
    }
}
