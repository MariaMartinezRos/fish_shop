<?php

use App\Console\Commands\CleanAllCache;
use App\Console\Commands\CreateCategories;
use App\Jobs\GenerateWeeklyTransactionsReportJob;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

it('cleans all cache', function () {
    // Arrange
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    // Act
    $this->artisan(CleanAllCache::class);
    // Assert
    $this->artisan('view:clear')->assertExitCode(0);
    $this->artisan('cache:clear')->assertExitCode(0);
    $this->artisan('route:clear')->assertExitCode(0);
    $this->artisan('config:clear')->assertExitCode(0);
});

it('cleans the laravel.logs file', function () {
    // Arrange
    $logFile = storage_path('logs/laravel.log');
    file_put_contents($logFile, 'This is a log file');
    // Act
    $this->artisan('app:clean-log');
    // Assert
    $this->assertEmpty(file_get_contents($logFile));
});

it('creates a new admin user successfully', function () {
    // Arrange
    $name = 'Admin User';
    $email = 'admin@example.com';
    $password = 'password123';
    $password2 = 'password123';

    // Act
    $this->artisan('app:create-admin')
        ->expectsQuestion('Enter the admin name: ', $name)
        ->expectsQuestion('Enter the admin email: ', $email)
        ->expectsQuestion('Enter the admin password: ', $password)
        ->expectsQuestion('Enter the admin password (again): ', $password2)
        ->assertExitCode(0);

    // Assert
    $user = User::where('email', $email)->first();
    $this->assertNotNull($user);
    $this->assertTrue(Hash::check($password, $user->password));
    $this->assertTrue($user->role_id === 1);
});

it('creates predefined categories successfully', function () {
    // Act
    $this->artisan(CreateCategories::class)->assertExitCode(0);

    // Assert
    $this->assertDatabaseHas('categories', ['name' => 'fresh']);
    $this->assertDatabaseHas('categories', ['name' => 'frozen']);
    $this->assertDatabaseHas('categories', ['name' => 'cut']);
    $this->assertDatabaseHas('categories', ['name' => 'seafood']);
    $this->assertDatabaseHas('categories', ['name' => 'other']);
});

it('loads soft deleted records from tables', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $user = User::factory()->create(['role_id' => $role->id]);
    $user->delete();

    // Act & Assert
    $this->assertDatabaseHas('users', ['deleted_at' => Carbon::now()]);

    $this->artisan('app:soft-deletes')
        ->expectsOutput('No deleted records found in the categories table.')
        ->expectsOutput('No deleted records found in the products table.')
        ->expectsOutput('No deleted records found in the roles table.')
        ->expectsOutput('No deleted records found in the transactions table.');

});

it('dispatches the GenerateWeeklyTransactionsReportJob when the command is run', function () {
    Bus::fake();

    $this->artisan('app:run-weekly-report')
        ->assertExitCode(0);

    Bus::assertDispatched(GenerateWeeklyTransactionsReportJob::class);
});


