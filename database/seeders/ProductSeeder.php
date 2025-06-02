<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (\App\Models\Fish::count() === 0) {
            \App\Models\Fish::factory()->count(10)->create();
        }

        if ($this->isDataAlreadyGiven()) {
            return;
        }
        Product::factory()->count(30)->released()->create();
    }

    private function isDataAlreadyGiven(): bool
    {
        return Product::exists();
    }
}
