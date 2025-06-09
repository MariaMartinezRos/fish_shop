<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\Fish;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    // Create test categories
    $this->category1 = Category::factory()->create();
    $this->category2 = Category::factory()->create();

    // Create test fish
    $this->fish1 = Fish::factory()->create();
    $this->fish2 = Fish::factory()->create();

    // Create test products
    $this->product1 = Product::factory()->create([
        'category_id' => $this->category1->id,
        'stock_kg' => 10.5,
        'price_per_kg' => 15.50
    ]);

    $this->product2 = Product::factory()->create([
        'category_id' => $this->category2->id,
        'stock_kg' => 5.0,
        'price_per_kg' => 25.75
    ]);

    // Attach fish to products with different days on sale
    $this->product1->fishes()->attach($this->fish1->id, [
        'days_on_sale' => 5,
        'supplier' => 'Ocean Fresh'
    ]);

    $this->product2->fishes()->attach($this->fish2->id, [
        'days_on_sale' => 10,
        'supplier' => 'Sea Delights'
    ]);
});

it('filters products by category', function () {
    $result = Product::byInventoryMetrics(
        categoryIds: [$this->category1->id]
    )->get();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($this->product1->id);
});

it('filters products by stock threshold', function () {
    $result = Product::byInventoryMetrics(
        stockThreshold: 8.0
    )->get();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($this->product1->id);
});

it('filters products by price range', function () {
    $result = Product::byInventoryMetrics(
        minPrice: 20.00,
        maxPrice: 30.00
    )->get();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($this->product2->id);
});

it('filters products by days on sale', function () {
    $result = Product::byInventoryMetrics(
        daysOnSaleThreshold: 8
    )->get();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($this->product2->id);
});

it('includes sales metrics when requested', function () {
    $result = Product::byInventoryMetrics(
        includeSalesMetrics: true
    )->first();

    expect($result)->toHaveKeys([
        'total_fish_types',
        'total_days_on_sale',
        'average_days_on_sale'
    ])
    ->and($result->total_fish_types)->toBe(1)
    ->and($result->total_days_on_sale)->toBe(5)
    ->and($result->average_days_on_sale)->toBe(5.0);
})->todo();

it('combines multiple filters', function () {
    $result = Product::byInventoryMetrics(
        categoryIds: [$this->category1->id],
        stockThreshold: 5.0,
        minPrice: 10.00,
        maxPrice: 20.00,
        daysOnSaleThreshold: 3
    )->get();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($this->product1->id);
});
