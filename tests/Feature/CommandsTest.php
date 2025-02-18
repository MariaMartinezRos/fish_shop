<?php
use App\Console\Commands\CleanAllCache;
use App\Console\Commands\CleanProductsTable;
use App\Models\Category;
use App\Models\Product;
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
