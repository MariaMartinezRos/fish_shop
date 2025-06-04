<?php

use App\Models\Fish;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $role = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $role->id]);
    loginAsUser($admin);
});

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

it('lists all fishes', function () {
    $fishes = Fish::factory()->count(3)->create();

    $response = $this->getJson('/api/v1/fishes');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'image',
                    'type',
                    'description',
                ],
            ],
        ]);
});

it('shows a specific fish', function () {
    $fish = Fish::factory()->create();

    $response = $this->getJson("/api/v1/fishes/{$fish->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'image',
                'type',
                'description',
            ],
        ])
        ->assertJson([
            'data' => [
                'id' => $fish->id,
                'name' => $fish->name,
            ],
        ]);
});

it('returns 404 for a non-existent fish', function () {
    $response = $this->getJson('/api/v1/fishes/999999');
    $response->assertStatus(404);
});

it('stores a new fish successfully', function () {
    Storage::fake('public');
    $typeWater = \App\Models\TypeWater::factory()->create();

    $data = [
        'name' => 'Salmon',
        'scientific_name' => 'Salmo salar',
        'description' => 'A popular fish species',
        'average_size_cm' => 75.5,
        'diet' => 'Omnivore',
        'lifespan_years' => 7,
        'habitat' => 'Freshwater',
        'conservation_status' => 'Least Concern',
        'type_water_id' => $typeWater->id,
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '10-20',
            'ph_range' => '6.5-7.5',
            'salinity' => '0.5-1.5',
            'oxygen_level' => '6-8',
            'migration_pattern' => 'Non-migratory',
            'notes' => 'Test notes',
        ],
    ];
    $this->postJson('/api/v1/fishes', $data)
        ->assertStatus(201);
})->todo('Deprecated');

it('fails to store a fish with missing required fields', function () {
    $data = [
        'type' => 'Freshwater',
        'diet' => 'Omnivore',
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '10-20',
            'ph_range' => '6.5-7.5',
            'migration_pattern' => 'Non-migratory',
        ],
    ];
    $this->postJson('/api/v1/fishes', $data)
        ->assertStatus(422);
});

it('updates an existing fish successfully', function () {
    $fish = Fish::factory()->create();
    $updateData = [
        'name' => 'Updated Fish',
        'description' => 'Updated description',
        'type' => 'Saltwater',
        'diet' => 'Carnivore',
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '10-20',
            'ph_range' => '6.5-7.5',
            'migration_pattern' => 'Non-migratory',
        ],
    ];
    $this->putJson("/api/v1/fishes/{$fish->id}", $updateData)
        ->assertStatus(200)
        ->assertJson(['data' => ['name' => 'Updated Fish']]);
});

it('fails to update a fish with missing required fields', function () {
    $fish = Fish::factory()->create();
    $updateData = [
        'type' => 'Saltwater',
        'diet' => 'Carnivore',
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '10-20',
            'ph_range' => '6.5-7.5',
            'migration_pattern' => 'Non-migratory',
        ],
    ];
    $this->putJson("/api/v1/fishes/{$fish->id}", $updateData)
        ->assertStatus(422);
});

it('deletes a fish successfully', function () {
    $fish = Fish::factory()->create();
    $this->deleteJson("/api/v1/fishes/{$fish->id}")
        ->assertStatus(200);
});

it('returns 404 when deleting a non-existent fish', function () {
    $this->deleteJson('/api/v1/fishes/999999')
        ->assertStatus(404);
});
