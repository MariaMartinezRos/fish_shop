<?php

use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for sales page', function () {
    // Arrange
    loginAsAdmin();

    // Act
    $this->get('sales')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('sales')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 4]);
    $costumer = User::factory()->create(['role_id' => 4]);

    // Act
    $this->actingAs($costumer)
        ->get('sales')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $employee = User::factory()->create(['role_id' => 3]);

    // Act
    $this->actingAs($employee)
        ->get('sales')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    loginAsAdmin();

    // Act
    $this->get('sales')
        ->assertOk()
        ->assertSeeText('Cliente');
});
