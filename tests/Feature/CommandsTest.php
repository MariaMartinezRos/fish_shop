<?php

use App\Console\Commands\CleanAllCache;
use App\Console\Commands\CleanTests;
use App\Console\Commands\CreateCategories;
use App\Console\Commands\TestVacationRequestEmail;
use App\Jobs\GenerateWeeklyTransactionsReportJob;
use App\Mail\VacationRequestNotification;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;
use Carbon\Carbon;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\NullOutput;

it('cleans all cache', function () {
    // Arrange
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('app:clean-log');
    // Act
    $this->artisan(CleanAllCache::class);
    // Assert
    $this->artisan('view:clear')->assertExitCode(0);
    $this->artisan('cache:clear')->assertExitCode(0);
    $this->artisan('route:clear')->assertExitCode(0);
    $this->artisan('config:clear')->assertExitCode(0);
    $this->artisan('app:clean-log')->assertExitCode(0);
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

it('executes clean:test command successfully', function () {
    Artisan::shouldReceive('call')
        ->once()
        ->with('app:clean-all-cache')
        ->andReturn(0);

    Artisan::shouldReceive('call')
        ->once()
        ->with('test', [], Mockery::any())
        ->andReturn(0);

    $command = new CleanTests;
    $command->setLaravel(app());

    $input = new StringInput('');
    $output = new NullOutput;
    $outputStyle = new OutputStyle($input, $output);
    $command->setOutput($outputStyle);

    $exitCode = $command->handle();

    expect($exitCode)->toBe(0);
});

it('runs the clean:test command and calls subcommands', function () {
    // Arrange
    Artisan::call('app:clean-all-cache');
    // Act
    $this->artisan('app:clean-all-cache')->assertExitCode(0);

    $this->artisan('clean:test')
        ->expectsOutput('Clearing caches...')
        ->expectsOutput('All caches cleared successfully!')
        ->expectsOutput('Running tests...')
        ->expectsOutput('All tests ejecuted successfully!')
        ->assertExitCode(0);
})->skip('This test is slow because it runs all tests, but it ensures CleanTests command is covered.');

it('sends test vacation request email', function () {
    Mail::fake();

    $roleAdmin = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $roleAdmin->id, 'email' => 'mariaamartinezros@gmail.com']);

    $roleEmployee = Role::factory()->create(['name' => 'employee']);
    $employee = User::factory()->create(['role_id' => $roleEmployee->id, 'email' => 'test@example.com']);

    $command = new TestVacationRequestEmail;
    $command->setLaravel(app());

    // Como un '''faker''' para mockear los comandos
    $input = new StringInput('');
    $output = new BufferedOutput;
    $outputStyle = new OutputStyle($input, $output);
    $command->setOutput($outputStyle);

    $command->handle();

    expect(User::where('email', $employee->email)->exists())->toBeTrue()
        ->and(VacationRequest::where('user_id', User::where('email', $employee->email)->first()->id)->exists())->toBeTrue();

    Mail::assertSent(VacationRequestNotification::class, function ($mail) use ($admin) {
        return $mail->hasTo($admin->email);
    });
});
