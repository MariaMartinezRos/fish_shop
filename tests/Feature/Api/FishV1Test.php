<?php

use App\Models\Fish;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

it('returns a successful response for fetching all fishes', function () {
    Fish::factory()->count(3)->create();

    $response = $this->getJson('/api/v1/fishes');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

it('returns a successful response for fetching a single fish', function () {
    $fish = Fish::factory()->create();

    $response = $this->getJson("/api/v1/fishes/{$fish->id}");

    $response->assertStatus(200)
        ->assertJson(['data' => ['id' => $fish->id]]);
});

it('stores a new fish successfully', function () {
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    Storage::fake('public');
    $file = asset('images/fishes/image1.jpg');

    $data = [
        'name' => 'Salmon',
        'type' => 'Freshwater',
        'price' => 10.5,
        'photo' => $file,
    ];

    $this->actingAs($admin)
        ->postJson('/api/v1/fishes', $data)
        ->assertStatus(201);
})->todo();

it('updates an existing fish successfully', function () {
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    Storage::fake('public');
    $file = asset('images/fishes/image1.jpg');
    $fish = Fish::factory()->create();

    $updateData = [
        'name' => 'Updated Fish',
        'description' => 'Updated description',
        'type' => 'Saltwater',
    ];

    $this->actingAs($admin)
        ->putJson("/api/v1/fishes/{$fish->id}", $updateData)
        ->assertStatus(200)
        ->assertJson(['data' => ['name' => 'Updated Fish']]);
});

it('deletes a fish successfully', function () {
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    Storage::fake('public');
    $file = asset('images/fishes/image1.jpg');
    $fish = Fish::factory()->create();

    $this->actingAs($admin)
        ->deleteJson("/api/v1/fishes/{$fish->id}")
        ->assertStatus(200)
        ->assertJson(['message' => 'Fish deleted successfully']);
});
