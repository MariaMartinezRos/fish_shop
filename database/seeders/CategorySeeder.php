<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory()->createMany([
            ['name' => 'fresh'],
            ['name' => 'frozen'],
            ['name' => 'cut'],
            ['name' => 'seafood'],
        ]);
    }
}
