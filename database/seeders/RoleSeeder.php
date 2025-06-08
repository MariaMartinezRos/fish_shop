<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->isDataAlreadyGiven()) {
            return;
        }

        $roles = [
            ['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'User has full access to manage the system, including user roles and permissions'],
            ['name' => 'employee', 'display_name' => 'Employee', 'description' => 'User has general access to perform assigned tasks and duties'],
            ['supplier', 'display_name' => 'Supplier', 'description' => 'User provides goods to the system'],
            ['name' => 'customer', 'display_name' => 'Client', 'description' => 'User interacts with the system as a client for purchases or services'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }

    private function isDataAlreadyGiven(): bool
    {
        return Role::where('name', 'admin')->exists()
            && Role::where('name', 'employee')->exists()
            && Role::where('name', 'supplier')->exists()
            && Role::where('name', 'customer')->exists();
    }
}
