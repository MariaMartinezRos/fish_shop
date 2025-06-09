<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\Fish;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Create admin user
    $this->admin = User::factory()->create([
        'role_id' => 1 // Assuming 1 is admin role
    ]);

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

    // Attach fish to products
    $this->product1->fishes()->attach($this->fish1->id, [
        'days_on_sale' => 5,
        'supplier' => 'Ocean Fresh'
    ]);

    $this->product2->fishes()->attach($this->fish2->id, [
        'days_on_sale' => 10,
        'supplier' => 'Sea Delights'
    ]);
});

it('shows products without scope when checkbox is unchecked', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('admin.products.index'));

    $response->assertStatus(200)
        ->assertViewHas('products', function ($products) {
            return $products->count() === 2;
        });
});

it('applies inventory metrics scope when checkbox is checked', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('admin.products.index', [
            'use_inventory_metrics' => true,
            'stock_threshold' => 8.0,
            'min_price' => 10.00,
            'max_price' => 20.00
        ]));

    $response->assertStatus(200)
        ->assertViewHas('products', function ($products) {
            return $products->count() === 1
                && $products->first()->id === $this->product1->id;
        });
});

it('includes sales metrics when requested', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('admin.products.index', [
            'use_inventory_metrics' => true,
            'include_sales_metrics' => true
        ]));

    $response->assertStatus(200)
        ->assertViewHas('products', function ($products) {
            $product = $products->first();
            return $product->total_fish_types === 1
                && $product->total_days_on_sale === 5
                && $product->average_days_on_sale === 5.0;
        });
}); 