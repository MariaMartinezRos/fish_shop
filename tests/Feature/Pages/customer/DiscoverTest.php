<?php

use App\Models\Fish;
use App\Models\Role;
use App\Models\User;

it('returns a successful response for discover page', function () {
    $response = $this->get('discover');

    $response->assertStatus(200);
});

it('can be created a fish and a user can see it on discover page', function () {
    // Arrange
    $roleAdmin = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => $roleAdmin->id]);
    $this->actingAs($admin);
    $data = [
        'name' => 'Salmon',
        'image' => null,
        'type' => 'Saltwater',
        'description' => 'descripcion',
    ];

    // Act
    $response = $this->post('http://fish_shop.test/api/v2/fishes', $data);
    $response->assertStatus(201);

    // Act && assert
    $roleClient = Role::factory()->create(['id' => 4]);
    $client = User::factory()->create(['role_id' => $roleClient->id]);
    $this->actingAs($client)
        ->get('discover')
        ->assertStatus(200)
        ->assertSee('Salmon');
})->todo();

it('can be deleted a fish and a user cannot see it on discover page', function () {
    // Arrange
    $roleAdmin = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => $roleAdmin->id]);
    $this->actingAs($admin);

    $fish = Fish::factory()->create(['name' => 'Salmon']);

    // Act (Admin deletes fish)
    $response = $this->delete('/api/v2/fishes/' . $fish->id);
    $response->assertStatus(204);

    // Log out admin and log in as user
    auth()->logout();
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act (User views discover page)
    $response2 = $this->get('/discover');

    // Assert
    $response2->assertStatus(200);
    $response2->assertDontSee('Salmon');
})->todo();

it('can be updated a fish and a user sees the update on discover page', function () {
    // Arrange
    $roleAdmin = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => $roleAdmin->id]);
    $this->actingAs($admin);

    $fish = Fish::factory()->create(['name' => 'Salmon']);

    $updatedData = ['name' => 'Updated Salmon', 'description' => 'updated description'];

    // Act (Admin updates fish)
    $response = $this->put('/api/v2/fishes/' . $fish->id, $updatedData);
    $response->assertStatus(200);

    // Log out admin and log in as user
    auth()->logout();
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act (User views discover page)
    $response2 = $this->get('/discover');

    // Assert
    $response2->assertStatus(200);
    $response2->assertSee('Updated Salmon');
})->todo();
