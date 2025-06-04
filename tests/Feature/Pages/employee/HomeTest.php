<?php

use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for home page', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 2]);
    $employee = User::factory()->create(['role_id' => $role->id]);

    // Act
    $this->actingAs($employee)
        ->get('employee/home')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('employee/home')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $costumer = User::factory()->create(['role_id' => $role->id]);

    // Act
    $this->actingAs($costumer)
        ->get('employee/home')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by admin', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 1]);

    // Act
    $this->actingAs($admin)
        ->get('employee/home')
        ->assertRedirect(route('login'));
});
