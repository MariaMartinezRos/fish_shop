<?php

use App\Models\Category;
use App\Models\Fish;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $admin = User::factory()->create(['role_id' => 1]);
    loginAsUser($admin);
});

it('returns a successful response for fetching all products', function () {
    $category = Category::factory()->create();
    $fish = Fish::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);
    $product->fishes()->attach($fish->id, [
        'days_on_sale' => 15,
        'supplier' => 'Test Supplier',
    ]);

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
                    'display_name',
                ],
                'fishes' => [[
                    'id',
                    'name',
                    'days_on_sale',
                    'supplier',
                ]],
                'created_at',
                'updated_at',
            ]],
        ]);
});

it('returns a successful response for fetching a single product', function () {
    $category = Category::factory()->create();
    $fish = Fish::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);
    $product->fishes()->attach($fish->id, [
        'days_on_sale' => 15,
        'supplier' => 'Test Supplier',
    ]);

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
                    'display_name',
                ],
                'fishes' => [[
                    'id',
                    'name',
                    'days_on_sale',
                    'supplier',
                ]],
                'created_at',
                'updated_at',
            ],
        ]);
});

it('stores a new product successfully', function () {
    $category = Category::factory()->create();

    $data = [
        'name' => 'Test Product',
        'description' => 'A test product description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
        'category_id' => $category->id,
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
                'category' => [
                    'id',
                    'name',
                    'display_name',
                ],
                'fishes' => [[
                    'id',
                    'name',
                    'days_on_sale',
                    'supplier',
                ]],
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('products', [
        'name' => 'Test Product',
        'description' => 'A test product description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
        'category_id' => $category->id,
    ]);
})->todo();

it('updates an existing product successfully', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $updateData = [
        'name' => 'Updated Product',
        'description' => 'Updated product description',
        'price_per_kg' => 149.99,
        'stock_kg' => 50,
        'category_id' => $category->id,
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
                'category' => [
                    'id',
                    'name',
                    'display_name',
                ],
                'fishes' => [[
                    'id',
                    'name',
                    'days_on_sale',
                    'supplier',
                ]],
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Product',
        'description' => 'Updated product description',
        'price_per_kg' => 149.99,
        'stock_kg' => 50,
        'category_id' => $category->id,
    ]);
})->todo();

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
            'category_id',
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
            'category_id',
        ]);
});

it('stores a new product with fish relationships successfully', function () {
    $category = Category::factory()->create();
    $fish1 = Fish::factory()->create();
    $fish2 = Fish::factory()->create();

    $data = [
        'name' => 'Test Product',
        'description' => 'A test product description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
        'category_id' => $category->id,
        'fishes' => [
            [
                'fish_id' => $fish1->id,
                'days_on_sale' => 5,
                'supplier' => 'Supplier 1',
            ],
            [
                'fish_id' => $fish2->id,
                'days_on_sale' => 10,
                'supplier' => 'Supplier 2',
            ],
        ],
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
                'fishes' => [[
                    'id',
                    'name',
                    'days_on_sale',
                    'supplier',
                ]],
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('products', [
        'name' => 'Test Product',
        'description' => 'A test product description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
        'category_id' => $category->id,
    ]);

    $product = Product::where('name', 'Test Product')->first();
    $this->assertDatabaseHas('fish_product', [
        'product_id' => $product->id,
        'fish_id' => $fish1->id,
        'days_on_sale' => 5,
        'supplier' => 'Supplier 1',
    ]);
    $this->assertDatabaseHas('fish_product', [
        'product_id' => $product->id,
        'fish_id' => $fish2->id,
        'days_on_sale' => 10,
        'supplier' => 'Supplier 2',
    ]);
});

it('updates a product with fish relationships successfully', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);
    $fish1 = Fish::factory()->create();
    $fish2 = Fish::factory()->create();
    $fish3 = Fish::factory()->create();

    // First attach some initial fish relationships
    $product->fishes()->attach($fish1->id, [
        'days_on_sale' => 5,
        'supplier' => 'Initial Supplier 1',
    ]);

    $updateData = [
        'name' => 'Updated Product',
        'description' => 'Updated product description',
        'price_per_kg' => 149.99,
        'stock_kg' => 50,
        'category_id' => $category->id,
        'fishes' => [
            [
                'fish_id' => $fish2->id,
                'days_on_sale' => 7,
                'supplier' => 'New Supplier 2',
            ],
            [
                'fish_id' => $fish3->id,
                'days_on_sale' => 12,
                'supplier' => 'New Supplier 3',
            ],
        ],
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
                'category',
                'fishes' => [[
                    'id',
                    'name',
                    'days_on_sale',
                    'supplier',
                ]],
                'created_at',
                'updated_at',
            ],
        ]);

    // Verify the product was updated
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Product',
        'description' => 'Updated product description',
        'price_per_kg' => 149.99,
        'stock_kg' => 50,
        'category_id' => $category->id,
    ]);

    // Verify old relationship was removed
    $this->assertDatabaseMissing('fish_product', [
        'product_id' => $product->id,
        'fish_id' => $fish1->id,
    ]);

    // Verify new relationships were added
    $this->assertDatabaseHas('fish_product', [
        'product_id' => $product->id,
        'fish_id' => $fish2->id,
        'days_on_sale' => 7,
        'supplier' => 'New Supplier 2',
    ]);
    $this->assertDatabaseHas('fish_product', [
        'product_id' => $product->id,
        'fish_id' => $fish3->id,
        'days_on_sale' => 12,
        'supplier' => 'New Supplier 3',
    ]);
});

it('validates fish relationship data when storing a product', function () {
    $category = Category::factory()->create();
    $nonExistentFishId = 99999;

    $data = [
        'name' => 'Test Product',
        'description' => 'A test product description',
        'price_per_kg' => 99.99,
        'stock_kg' => 100,
        'category_id' => $category->id,
        'fishes' => [
            [
                'fish_id' => $nonExistentFishId,
                'days_on_sale' => 'not-a-number',
                'supplier' => 123, // Not a string
            ],
        ],
    ];

    $response = $this->postJson('/api/v2/products', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'fishes.0.fish_id',
            'fishes.0.days_on_sale',
            'fishes.0.supplier',
        ]);
});

it('validates fish relationship data when updating a product', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);
    $nonExistentFishId = 99999;

    $updateData = [
        'name' => 'Updated Product',
        'description' => 'Updated product description',
        'price_per_kg' => 149.99,
        'stock_kg' => 50,
        'category_id' => $category->id,
        'fishes' => [
            [
                'fish_id' => $nonExistentFishId,
                'days_on_sale' => 'not-a-number',
                'supplier' => 123, // Not a string
            ],
        ],
    ];

    $response = $this->putJson("/api/v2/products/{$product->id}", $updateData);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'fishes.0.fish_id',
            'fishes.0.days_on_sale',
            'fishes.0.supplier',
        ]);
});
