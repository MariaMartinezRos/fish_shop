<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

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
