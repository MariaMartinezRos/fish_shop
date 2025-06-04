<?php

use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    DB::beginTransaction();
});

afterEach(function () {
    DB::rollBack();
});

it('creates a new product if valid and does not exist', function () {
    $category = Category::factory()->create();
    $row = ['Salmon', $category->id, 25, 100, 'Fresh salmon'];

    $import = new ProductsImport;
    $product = $import->model($row);

    expect($product)->toBeInstanceOf(Product::class)
        ->and($product->name)->toBe('Salmon')
        ->and($product->category_id)->toBe($category->id);
});

it('skips the row if category does not exist', function () {
    $row = ['Tuna', 999, 20, 50, 'Fresh tuna'];

    $import = new ProductsImport;
    $product = $import->model($row);

    expect($product)->toBeNull();
});

it('updates existing product and returns null', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'name' => 'Mackerel',
        'category_id' => $category->id,
    ]);

    $newData = ['Mackerel', $category->id, 30, 150, 'Updated description'];

    $import = new ProductsImport;
    $result = $import->model($newData);

    $updatedProduct = Product::where('name', 'Mackerel')->first();

    expect($result)->toBeNull()
        ->and($updatedProduct->price_per_kg)->toBe(30)
        ->and($updatedProduct->stock_kg)->toBe(150)
        ->and($updatedProduct->description)->toBe('Updated description');
});
