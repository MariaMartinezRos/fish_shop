<?php
use App\Console\Commands\CleanAllCache;
use App\Console\Commands\CleanProductsTable;
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

it('cleans products table', function () {
    // Arrange
    Artisan::call('migrate:fresh');
    Product::factory()->count(3)->create();
    // Act
    $this->artisan(CleanProductsTable::class);
    // Assert
    $this->assertDatabaseCount('products', 0);
});

