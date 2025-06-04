<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ask for the admin details
        $name = $this->ask('Enter the admin name: ');
        $email = $this->ask('Enter the admin email: ');
        $password = $this->secret('Enter the admin password: ');
        $password2 = $this->secret('Enter the admin password (again): ');

        // Validate email format (basic check)
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address.');

            return;
        }

        // validate that the email is unique
        if (User::where('email', $email)->exists()) {
            $this->error('Email already exists.');

            return;
        }

        // Validate password confirmation
        if ($password !== $password2) {
            $this->error('Passwords do not match.');

            return;
        }

        // check if the role admin its created. if not, create it
        if (! (Role::where('name', 'admin')->exists())) {
            Role::create([
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'User has full access to manage the system, including user roles and permissions',
            ]);
        }

        // Create the admin user
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role_id' => 1,
            ]);

            $this->info('Admin user created successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to create admin user: '.$e->getMessage());
        }
    }
}
