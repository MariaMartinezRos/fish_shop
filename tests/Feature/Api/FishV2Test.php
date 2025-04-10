<?php

use App\Models\Fish;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

it('returns a successful response for fetching all fishes', function () {
    Fish::factory()->count(3)->create();

    $response = $this->getJson('/api/v2/fishes');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

it('returns a successful response for fetching a single fish', function () {
    $fish = Fish::factory()->create();

    $response = $this->getJson("/api/v2/fishes/{$fish->id}");

    $response->assertStatus(200)
        ->assertJson(['data' => ['id' => $fish->id]]);
});

it('stores a new fish successfully', function () {
    loginAsAdmin();
    Storage::fake('public');
    $file = asset('images/fishes/image1.jpg');

    $data = [
        'name' => 'Salmon',
        'type' => 'Freshwater',
        'price' => 10.5,
        'photo' => $file,
        'temperature_range' => '22-28°C',
        'ph_range' => '6.5-7.5',
        'salinity' => 1.025,
        'oxygen_level' => 5.0,
        'notes' => 'Test notes',
        'state' => 'allowed',
    ];

    $this->postJson('/api/v2/fishes', $data)
        ->assertStatus(201);
})->todo();

it('updates an existing fish successfully', function () {
    loginAsAdmin();
    Storage::fake('public');
    $file = asset('images/fishes/image1.jpg');
    $fish = Fish::factory()->create();

    $updateData = [
        'name' => 'Updated Fish',
        'description' => 'Updated description',
        'type' => 'Saltwater',
    ];

    $this->putJson("/api/v2/fishes/{$fish->id}", $updateData)
        ->assertStatus(200)
        ->assertJson(['data' => ['name' => 'Updated Fish']]);
});

it('deletes a fish successfully', function () {
    loginAsAdmin();
    Storage::fake('public');
    $file = asset('images/fishes/image1.jpg');
    $fish = Fish::factory()->create();

    $this->deleteJson("/api/v2/fishes/{$fish->id}")
        ->assertStatus(200)
        ->assertJson(['message' => 'Fish deleted successfully']);
});
