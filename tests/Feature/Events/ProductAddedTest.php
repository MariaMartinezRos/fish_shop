<?php

use App\Events\ProductAdded;
use App\Models\Product;
use App\Models\Category;

it('creates product added event with product model', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $event = new ProductAdded($product);

    expect($event->product)->toBe($product)
        ->and($event->product->id)->toBe($product->id)
        ->and($event->product->category_id)->toBe($category->id);
});

it('handles product with all attributes', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Test Product',
        'description' => 'Test Description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100
    ]);

    $event = new ProductAdded($product);

    expect($event->product->name)->toBe('Test Product')
        ->and($event->product->description)->toBe('Test Description')
        ->and($event->product->price_per_kg)->toBe(99.99)
        ->and($event->product->stock_kg)->toBe(100);
});
