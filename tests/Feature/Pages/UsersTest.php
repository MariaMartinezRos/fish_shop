<?php

use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

use Illuminate\Foundation\Testing\RefreshDatabase;


it('returns a successful response for users page', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get('users')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('users')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 4]);
    $costumer = User::factory()->create(['role_id' => 'costumer']);

    // Act
    $this->actingAs($costumer)
        ->get('users')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $employee = User::factory()->create(['role_id' => 'employee']);

    // Act
    $this->actingAs($employee)
        ->get('users')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get('users')
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('can create a user successfully', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->post("users", [
            'name' => 'Jane Doe',
            'email' => 'example@example.com',
            'password' => '1234567890',
            'role_id' => $role->id,
        ])
        ->assertRedirect('users')
        ->assertSessionHas('success', 'User created successfully');

    // Assert
    $this->assertDatabaseHas('users', [
        'name' => 'Jane Doe',
        'email' => 'example@example.com',
        'role_id' => 'customer',
    ]);
});

it('can delete a user', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $user = User::factory()->create();

    // Act
    $this->actingAs($admin)
        ->delete("users/{$user->id}")
        ->assertRedirect('users')
        ->assertSessionHas('success', 'User deleted successfully');
});

it('can update a user', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);
    $user = User::factory()->create(['name' => 'John Doe', 'email' => 'example@example.com']);

    // Act
    $this->actingAs($admin)
        ->put("users/{$user->id}", [
            'name' => 'Jane Doe',
            'email' => 'example@example.com',
            'password' => '1234567890',
            'role_id' => 4,
        ])
        ->assertRedirect('users')
        ->assertSessionHas('success', 'User updated successfully');
});
