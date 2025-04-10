<?php

namespace Database\Seeders;

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
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@employee.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role_id' => 2,
        ]);
        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role_id' => 3,
        ]);
    }

    private function isDataAlreadyGiven(): bool
    {
        return User::where('email', 'admin@admin.com')->exists()
            && User::where('email', 'employee@employee.com')->exists()
            && User::where('email', 'customer@customer.com')->exists();
    }
}
