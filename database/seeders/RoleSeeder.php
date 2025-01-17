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
            ['name' => 'tpv', 'display_name' => 'Terminal', 'description' => 'User is responsible for managing transactions and sales operations'],
            ['name' => 'employee', 'display_name' => 'Member', 'description' => 'User has general access to perform assigned tasks and duties'],
            ['name' => 'customer', 'display_name' => 'Client', 'description' => 'User interacts with the system as a client for purchases or services'],
            ['name' => 'guest', 'display_name' => 'Visitor', 'description' => 'User has limited access for viewing public resources'],
            ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }

    private function isDataAlreadyGiven(): bool
    {
        return Role::where('name', 'admin')->exists()
            && Role::where('name', 'tpv')->exists()
            && Role::where('name', 'employee')->exists()
            && Role::where('name', 'customer')->exists()
            && Role::where('name', 'guest')->exists();
    }
}
