<?php


use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

use function Pest\Laravel\post;


it('returns a successful response for fish page', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get('fish')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('fish')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 4]);
    $costumer = User::factory()->create(['role_id' => 'costumer']);

    // Act
    $this->actingAs($costumer)
        ->get('fish')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $employee = User::factory()->create(['role_id' => 'employee']);

    // Act
    $this->actingAs($employee)
        ->get('fish')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get('fish')
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('can create a fish', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'name' => 'Salmon',
        'type' => 'Freshwater',
        'price' => 10.5,
    ];

    $response = post(route('fish.store'), $data);
    $response->assertRedirect(route('fish.index'));
    $this->assertDatabaseHas('fish', $data);
});

