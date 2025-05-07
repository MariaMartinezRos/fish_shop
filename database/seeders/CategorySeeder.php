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
            ['name' => 'fresh', 'display_name' => 'Fresh', 'description' => 'Fresh fish, straight from the sea'],
            ['name' => 'frozen', 'display_name' => 'Frozen', 'description' => 'Frozen fish, mostly already prepared meals'],
            ['name' => 'cut', 'display_name' => 'Cut', 'description' => 'Cut fish, big fishes that need to be cut'],
            ['name' => 'seafood', 'display_name' => 'Seafood', 'description' => 'Seafood, food with a hard shell'],
            ['name' => 'other', 'display_name' => 'Other', 'description' => 'Other fish'],
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return Category::where('name', 'fresh')->exists()
            && Category::where('name', 'frozen')->exists()
            && Category::where('name', 'cut')->exists()
            && Category::where('name', 'seafood')->exists()
            && Category::where('name', 'other')->exists();
    }
}
