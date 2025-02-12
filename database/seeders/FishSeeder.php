<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Fish;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FishSeeder extends Seeder
{
    public function run(): void
    {

        if ($this->isDataAlreadyGiven()) {
            return;
        }
        Fish::factory()->count(20)->released()->create();
    }

    private function isDataAlreadyGiven(): bool
    {
        return Fish::exists();
    }
}
