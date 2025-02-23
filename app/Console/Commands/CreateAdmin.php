<?php

namespace App\Console\Commands;

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

        // Validate password confirmation
        if ($password !== $password2) {
            $this->error('Passwords do not match.');

            return;
        }

        // Create the admin user
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role_id' => 'admin',
            ]);

            $this->info('Admin user created successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to create admin user: '.$e->getMessage());
        }
    }
}
