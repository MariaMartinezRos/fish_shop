<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $role = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $role->id]);
    loginAsUser($admin);
});

it('returns a successful response for fetching all products', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $response = $this->getJson('/api/v2/products');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [[
                'id',
                'name',
                'description',
                'price_per_kg',
                'stock_kg',
                'category' => [
                    'id',
                    'name',
                    'display_name'
                ],
                'created_at',
                'updated_at'
            ]]
        ]);
});

it('returns a successful response for fetching a single product', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $response = $this->getJson("/api/v2/products/{$product->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price_per_kg',
                'stock_kg',
                'category' => [
                    'id',
                    'name',
                    'display_name'
                ],
                'created_at',
                'updated_at'
            ]
        ]);
});

it('stores a new product successfully', function () {
    $category = Category::factory()->create();

    $data = [
        'name' => 'Test Product',
        'description' => 'A test product description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
        'category_id' => $category->id
    ];

    $response = $this->postJson('/api/v2/products', $data);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price_per_kg',
                'stock_kg',
                'category',
                'created_at',
                'updated_at'
            ]
        ]);

    $this->assertDatabaseHas('products', [
        'name' => 'Test Product',
        'description' => 'A test product description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
        'category_id' => $category->id
    ]);
});

it('updates an existing product successfully', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $updateData = [
        'name' => 'Updated Product',
        'description' => 'Updated product description',
        'price_per_kg' => 149.99,
        'stock_kg' => 50,
        'category_id' => $category->id
    ];

    $response = $this->putJson("/api/v2/products/{$product->id}", $updateData);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price_per_kg',
                'stock_kg',
                'created_at',
                'updated_at'
            ]
        ]);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Product',
        'description' => 'Updated product description',
        'price_per_kg' => 149.99,
        'stock_kg' => 50,
        'category_id' => $category->id
    ]);
});

it('deletes a product successfully', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $response = $this->deleteJson("/api/v2/products/{$product->id}");

    $response->assertStatus(204);

    $this->assertSoftDeleted('products', ['id' => $product->id]);
});

it('validates required fields when storing a product', function () {
    $response = $this->postJson('/api/v2/products', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
            'price_per_kg',
            'stock_kg',
            'category_id'
        ]);
});

it('validates required fields when updating a product', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $response = $this->putJson("/api/v2/products/{$product->id}", []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
            'price_per_kg',
            'stock_kg',
            'category_id'
        ]);
});

