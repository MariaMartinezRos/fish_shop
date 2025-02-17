<?php

use App\Models\Fish;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('shows the data for the index endpoint', function () {
    Fish::factory()->count(3)->create();

    $response = $this->getJson('/api/fishes');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

it('shows the data for the show endpoint', function () {
    $fish = Fish::factory()->create();

    $response = $this->getJson("/api/fishes/{$fish->id}");

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $fish->id,
                'name' => $fish->name,
            ],
        ]);
});

it('creates a new fish', function () {
    Storage::fake('public');

    $data = [
        'name' => 'Salmon',
        'type' => 'Freshwater',
        'price' => 10.5,
        'photo' => UploadedFile::fake()->image('photo.jpg'),
    ];

    $response = $this->postJson('/api/fishes', $data);

    $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => 'Salmon',
                'type' => 'Freshwater',
            ],
        ]);

    Storage::disk('public')->assertExists('fishes/' . $response->json('data.photo'));

});


it('updates an existing fish', function () {
    $fish = Fish::factory()->create();

    $data = [
        'name' => 'Updated Fish',
        'type' => 'Saltwater',
        'price' => 15.0,
    ];

    $response = $this->putJson("/api/fishes/{$fish->id}", $data);

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'name' => 'Updated Fish',
                'type' => 'Saltwater',
            ],
        ]);
});

it('deletes an existing fish', function () {$fish = Fish::factory()->create();

    $response = $this->deleteJson("/api/fishes/{$fish->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('fishes', ['id' => $fish->id]);
});

it('lists all the fishes by type', function () {
    Fish::factory()->create(['type' => 'Freshwater']);
    Fish::factory()->create(['type' => 'Saltwater']);

    $response = $this->getJson('/api/fishes/filter/Freshwater');

    $response->assertStatus(200)
        ->assertJsonCount(1, 'data');
});

it('searchs for a fish by name', function () {
    Fish::factory()->create(['name' => 'Salmon']);
    Fish::factory()->create(['name' => 'Tuna']);

    $response = $this->getJson('/api/fishes/search/Salmon');

    $response->assertStatus(200)
        ->assertJsonCount(1, 'data');
});
