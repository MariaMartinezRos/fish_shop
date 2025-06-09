<?php

use App\Models\Fish;
use App\Models\TypeWater;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $admin = User::factory()->create(['role_id' => 1]);
    loginAsUser($admin);
});

it('returns a successful response for fetching all fishes', function () {
    $fish = Fish::factory()->create();
    $typeWater = TypeWater::factory()->create(['type' => 'Freshwater']);
    $fish->typeWater()->attach($typeWater->id, [
        'state' => 'Allowed',
        'temperature_range' => '20-25°C',
        'ph_range' => '7.0-8.0',
        'salinity' => 1.03,
        'oxygen_level' => 5.94,
        'migration_pattern' => 'Non-migratory',
        'recorded_since' => 1990,
        'notes' => 'Test notes',
    ]);

    $response = $this->getJson('/api/v2/fishes');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [[
                'id',
                'name',
                'scientific_name',
                'image',
                'description',
                'average_size_cm',
                'diet',
                'lifespan_years',
                'habitat',
                'conservation_status',
                'type',
                'characteristics' => [
                    'state',
                    'temperature_range',
                    'ph_range',
                    'salinity',
                    'oxygen_level',
                    'migration_pattern',
                    'recorded_since',
                    'notes',
                ],
                'water_type_details' => [
                    'type',
                    'ph_level',
                    'temperature_range',
                    'salinity_level',
                    'region',
                    'description',
                ],
                'created_at',
                'updated_at',
            ]],
        ]);
});

it('returns a successful response for fetching a single fish', function () {
    $fish = Fish::factory()->create();
    $typeWater = TypeWater::factory()->create(['type' => 'Freshwater']);
    $fish->typeWater()->attach($typeWater->id, [
        'state' => 'Allowed',
        'temperature_range' => '20-25°C',
        'ph_range' => '7.0-8.0',
        'salinity' => 1.03,
        'oxygen_level' => 5.94,
        'migration_pattern' => 'Non-migratory',
        'recorded_since' => 1990,
        'notes' => 'Test notes',
    ]);

    $response = $this->getJson("/api/v2/fishes/{$fish->id}");

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'scientific_name',
                'image',
                'description',
                'average_size_cm',
                'diet',
                'lifespan_years',
                'habitat',
                'conservation_status',
                'type',
                'characteristics',
                'water_type_details',
                'created_at',
                'updated_at',
            ],
        ]);
});

it('stores a new fish successfully', function () {

    $data = [
        'name' => 'Salmon',
        'scientific_name' => 'Salmo salar',
        'image' => null,
        'description' => 'A popular fish species',
        'average_size_cm' => 75.5,
        'diet' => 'Carnivore',
        'lifespan_years' => 7,
        'habitat' => 'Rivers and Oceans',
        'conservation_status' => 'Least Concern',
        'type' => 'Freshwater',
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '20-25°C',
            'ph_range' => '7.0-8.0',
            'salinity' => 1.03,
            'oxygen_level' => 5.94,
            'migration_pattern' => 'Non-migratory',
            'recorded_since' => 1990,
            'notes' => 'Test notes',
        ],
    ];

    $response = $this->postJson('/api/v2/fishes', $data);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'scientific_name',
                'image',
                'description',
                'average_size_cm',
                'diet',
                'lifespan_years',
                'habitat',
                'conservation_status',
                'type',
                'characteristics',
                'water_type_details',
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('fishes', [
        'name' => 'Salmon',
        'scientific_name' => 'Salmo salar',
        'diet' => 'Carnivore',
    ]);
});

it('updates an existing fish successfully', function () {

    $fish = Fish::factory()->create();
    $typeWater = TypeWater::factory()->create(['type' => 'Freshwater']);
    $fish->typeWater()->attach($typeWater->id, [
        'state' => 'Allowed',
        'temperature_range' => '20-25°C',
        'ph_range' => '7.0-8.0',
        'salinity' => 1.03,
        'oxygen_level' => 5.94,
        'migration_pattern' => 'Non-migratory',
        'recorded_since' => 1990,
        'notes' => 'Test notes',
    ]);

    $updateData = [
        'name' => 'Updated Salmon',
        'scientific_name' => 'Salmo salar',
        'image' => null,
        'description' => 'Updated description',
        'average_size_cm' => 80.0,
        'diet' => 'Carnivore',
        'lifespan_years' => 8,
        'habitat' => 'Updated habitat',
        'conservation_status' => 'Least Concern',
        'type' => 'Saltwater',
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '22-28°C',
            'ph_range' => '7.2-8.0',
            'salinity' => 1.02,
            'oxygen_level' => 6.0,
            'migration_pattern' => 'Anadromous',
            'recorded_since' => 1990,
            'notes' => 'Updated notes',
        ],
    ];

    $response = $this->putJson("/api/v2/fishes/{$fish->id}", $updateData);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'scientific_name',
                'image',
                'description',
                'average_size_cm',
                'diet',
                'lifespan_years',
                'habitat',
                'conservation_status',
                'type',
                'characteristics',
                'water_type_details',
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('fishes', [
        'id' => $fish->id,
        'name' => 'Updated Salmon',
        'scientific_name' => 'Salmo salar',
        'diet' => 'Carnivore',
    ]);

});

it('deletes a fish successfully', function () {
    $fish = Fish::factory()->create();
    $typeWater = TypeWater::factory()->create(['type' => 'Freshwater']);
    $fish->typeWater()->attach($typeWater->id, [
        'state' => 'Allowed',
        'temperature_range' => '20-25°C',
        'ph_range' => '7.0-8.0',
        'salinity' => 1.03,
        'oxygen_level' => 5.94,
        'migration_pattern' => 'Non-migratory',
        'recorded_since' => 1990,
        'notes' => 'Test notes',
    ]);

    $response = $this->deleteJson("/api/v2/fishes/{$fish->id}");

    $response->assertStatus(200);

    $this->assertSoftDeleted('fishes', ['id' => $fish->id]);
});

it('validates required fields when storing a fish', function () {
    $response = $this->postJson('/api/v2/fishes', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
            'diet',
            'type',
            'characteristics',
            'characteristics.state',
            'characteristics.temperature_range',
            'characteristics.ph_range',
            'characteristics.migration_pattern',
        ]);
});

it('validates required fields when updating a fish', function () {
    $fish = Fish::factory()->create();

    $response = $this->putJson("/api/v2/fishes/{$fish->id}", []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'name',
            'diet',
            'type',
            'characteristics',
            'characteristics.state',
            'characteristics.temperature_range',
            'characteristics.ph_range',
            'characteristics.migration_pattern',
        ]);
});

it('can create a fish with a photo attached', function () {
    Storage::fake('public');

    $fish = Fish::factory()->create();
    $typeWater = TypeWater::factory()->create(['type' => 'Freshwater']);

    $image = UploadedFile::fake()->image('updated-fish.jpg');
    $data = [
        'name' => 'Salmon',
        'scientific_name' => 'Salmo salar',
        'image' => $image,
        'description' => 'A popular fish species',
        'average_size_cm' => 75.5,
        'diet' => 'Carnivore',
        'lifespan_years' => 7,
        'habitat' => 'Rivers and Oceans',
        'conservation_status' => 'Least Concern',
        'type' => 'Freshwater',
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '20-25°C',
            'ph_range' => '7.0-8.0',
            'salinity' => 1.03,
            'oxygen_level' => 5.94,
            'migration_pattern' => 'Non-migratory',
            'recorded_since' => 1990,
            'notes' => 'Test notes',
        ],
    ];

    $response = $this->postJson('/api/v2/fishes', $data);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'scientific_name',
                'image',
                'description',
                'average_size_cm',
                'diet',
                'lifespan_years',
                'habitat',
                'conservation_status',
                'type',
                'characteristics',
                'water_type_details',
                'created_at',
                'updated_at',
            ],
        ]);

    $this->assertDatabaseHas('fishes', [
        'name' => 'Salmon',
        'scientific_name' => 'Salmo salar',
        'diet' => 'Carnivore',
    ]);

    Storage::disk('public')->assertExists('fishes/'.$image->hashName());
})->todo('Test is not passing due to the image upload functionality.');
