<?php

use App\Events\ProductAdded;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

it('creates product added event with product model', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);
    $event = new ProductAdded($product);

    expect($event->product)->toBe($product)
        ->and($event->product->id)->toBe($product->id)
        ->and($event->broadcastOn())->toBeArray()
        ->and($event->broadcastOn()[0])->toBeInstanceOf(\Illuminate\Broadcasting\PrivateChannel::class);
});

it('handles product with all attributes', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Test Product',
        'description' => 'Test Description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
    ]);

    $event = new ProductAdded($product);

    expect($event->product->name)->toBe('Test Product')
        ->and($event->product->description)->toBe('Test Description')
        ->and($event->product->price_per_kg)->toBe(99.99)
        ->and($event->product->stock_kg)->toBe(100);
});

it('logs message when product is added', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Test Product',
    ]);

    $event = new ProductAdded($product);

    // Trigger the event listener
    app()->make(\App\Listeners\SendNotificationOnProductAdded::class)->handle($event);

    // Check the log file for the message
    $logContent = file_get_contents(storage_path('logs/laravel.log'));
    expect($logContent)->toContain('Product added successfully: '.$product->name);
});
