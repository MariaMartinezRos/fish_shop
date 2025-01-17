<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        $categories = Category::factory()->createMany([
            ['name' => 'fresh'],
            ['name' => 'frozen'],
            ['name' => 'cut'],
            ['name' => 'seafood'],
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return Category::where('name', 'fresh')->exists()
            && Category::where('name', 'frozen')->exists()
            && Category::where('name', 'cut')->exists()
            && Category::where('name', 'seafood')->exists();
    }
}
