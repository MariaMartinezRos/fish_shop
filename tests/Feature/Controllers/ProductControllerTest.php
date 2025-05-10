<?php

use App\Models\Product;
use App\Models\Role;
use App\Models\User;

beforeEach(function () {
    $role = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $role->id]);
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