<?php

use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

it('imports products from a valid document', function () {
    // Arrange
    $path = storage_path('app/public/products.xlsx');

    $this->assertFileExists($path);
    // Act
    Excel::import(new ProductsImport, $path);

    // Assert
    $this->assertDatabaseCount(Product::class, 41);
})->todo();

it('updates existing products', function () {
    // Arrange
    Storage::fake('local');
    $existingProduct = Product::factory()->create(['name' => 'Existing Product']);
    $path = storage_path('app/public/products.xlsx');
    $this->assertFileExists($path);

    // Act
    Excel::import(new ProductsImport, $path);

    // Assert
    $this->assertDatabaseHas(Product::class, [
        'name' => 'Existing Product',
        'category_id' => 1, // Assuming the new category_id is 2
        'price_per_kg' => 100, // Assuming the new price_per_kg is 100
        'stock_kg' => 50, // Assuming the new stock_kg is 50
        'description' => 'Updated description', // Assuming the new description
    ]);
})->todo();
