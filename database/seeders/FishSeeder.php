<?php

namespace Database\Seeders;

use App\Models\Fish;
use Illuminate\Database\Seeder;

class FishSeeder extends Seeder
{
    public function run(): void
    {

        if ($this->isDataAlreadyGiven()) {
            return;
        }
        Fish::factory()->count(20)->create();
    }

    private function isDataAlreadyGiven(): bool
    {
        return Fish::exists();
    }
}
