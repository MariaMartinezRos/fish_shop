<?php

use App\Models\Category;
use App\Models\Role;
use App\Models\User;

beforeEach(function () {
    $admin = User::factory()->create(['role_id' => 1]);
    loginAsUser($admin);
});

it('returns a successful response for fetching all categories', function () {
    $category = Category::factory()->create();

    $response = $this->getJson('/api/v2/categories');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [[
                'id',
                'name',
                'display_name',
                'description',
                'created_at',
                'updated_at',
            ]],
        ]);
});

it('returns a successful response for fetching a single category', function () {
    $category = Category::factory()->create();

    $response = $this->getJson("/api/v2/categories/{$category->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'display_name',
                'description',
                'created_at',
                'updated_at',
            ],
        ]);
});

it('stores a new category successfully', function () {
    $data = [
        'name' => 'test-category',
        'display_name' => 'Test Category',
        'description' => 'A test category description',
    ];

    $response = $this->postJson('/api/v2/categories', $data);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'display_name',
                'description',
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('categories', [
        'name' => 'test-category',
        'display_name' => 'Test Category',
        'description' => 'A test category description',
    ]);
});

it('updates an existing category successfully', function () {
    $category = Category::factory()->create();

    $updateData = [
        'name' => 'updated-category',
        'display_name' => 'Updated Category',
        'description' => 'Updated category description',
    ];

    $response = $this->putJson("/api/v2/categories/{$category->id}", $updateData);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'display_name',
                'description',
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'updated-category',
        'display_name' => 'Updated Category',
        'description' => 'Updated category description',
    ]);
});

it('deletes a category successfully', function () {
    $category = Category::factory()->create(['name' => 'test-category']);

    $response = $this->deleteJson("/api/v2/categories/{$category->id}");

    $response->assertStatus(204);

    $this->assertSoftDeleted('categories', ['id' => $category->id]);
});

it('validates required fields when storing a category', function () {
    $response = $this->postJson('/api/v2/categories', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
        ]);
})->todo();

it('validates required fields when updating a category', function () {
    $category = Category::factory()->create();

    $response = $this->putJson("/api/v2/categories/{$category->id}", []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
        ]);
});

it('prevents duplicate category names', function () {
    $existingCategory = Category::factory()->create(['name' => 'test-category']);

    $data = [
        'name' => 'test-category',
        'display_name' => 'Another Test Category',
        'description' => 'Another test category description',
    ];

    $response = $this->postJson('/api/v2/categories', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
        ]);
});
