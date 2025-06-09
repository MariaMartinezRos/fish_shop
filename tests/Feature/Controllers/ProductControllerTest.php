<?php

use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $admin = User::factory()->create(['role_id' => 1]);
    $this->category = \App\Models\Category::factory()->create();
    loginAsUser($admin);
});

it('shows the product index page', function () {
    $response = $this->get(route('products.index'));
    $response->assertStatus(200);
});

it('shows a single product', function () {
    $product = Product::factory()->create(['category_id' => $this->category->id]);
    $response = $this->get(route('products.show', $product->id));
    $response->assertStatus(200);
});

it('creates a new product', function () {
    $data = [
        'name' => 'Test Product',
        'price_per_kg' => 10.5,
        'stock_kg' => 100,
        'category_id' => $this->category->id,
        'description' => 'A test product',
    ];
    $response = $this->post(route('products.store'), $data);
    $response->assertStatus(302); // redirect after store
});

it('fails to create a product with missing fields', function () {
    $data = [
        'price' => 10.5,
    ];
    $response = $this->post(route('products.store'), $data);
    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name', 'category_id']);
});

it('updates a product', function () {
    $product = Product::factory()->create(['category_id' => $this->category->id]);
    $data = [
        'name' => 'Updated Product',
        'price_per_kg' => 20.0,
        'stock_kg' => 150,
        'category_id' => $this->category->id,
        'description' => 'Updated description',
    ];
    $response = $this->put(route('products.update', $product->id), $data);
    $response->assertStatus(302);
});

it('deletes a product', function () {
    $product = Product::factory()->create(['category_id' => $this->category->id]);
    $response = $this->delete(route('products.destroy', $product->id));
    $response->assertStatus(302);
});

it('shows product list for client', function () {
    $products = Product::factory()->create(['category_id' => $this->category->id]);

    $response = $this->get(route('stock-client'));

    $response->assertStatus(200)
        ->assertViewHas('products');
});

it('filters products by search term', function () {
    $product1 = Product::factory()->create(['name' => 'Test Product 1', 'category_id' => $this->category->id]);
    $product2 = Product::factory()->create(['name' => 'Another Product', 'category_id' => $this->category->id]);

    $response = $this->get(route('stock-client', ['search' => 'Test']));

    $response->assertStatus(200)
        ->assertViewIs('dashboard.stock-client')
        ->assertViewHas('products', function ($products) use ($product1) {
            return $products->contains($product1) && ! $products->contains('name', 'Another Product');
        });
});

it('shows individual product to client', function () {
    $product = Product::factory()->create(['category_id' => $this->category->id]);

    $response = $this->get(route('products.show-client', $product->id));

    $response->assertStatus(200)
        ->assertViewIs('products.show-client')
        ->assertViewHas('product', $product);
});

it('returns 404 for non-existent product', function () {
    $response = $this->get(route('products.show-client', 99999));

    $response->assertStatus(404);
});

it('paginates products list', function () {
    Product::factory()->count(15)->create(['category_id' => $this->category->id]);

    $response = $this->get(route('stock-client'));

    $response->assertStatus(200)
        ->assertViewIs('dashboard.stock-client')
        ->assertViewHas('products', function ($products) {
            return $products->count() === 10; // Default pagination is 10
        });
});
