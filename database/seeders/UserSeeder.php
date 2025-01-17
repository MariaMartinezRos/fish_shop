<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'role_id' => 1,
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return User::where('email', 'admin@admin.com')->exists();
    }
}
