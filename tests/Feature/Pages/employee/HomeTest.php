<?php

use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for home page', function () {
    // Arrange
    $employee = User::factory()->create(['role_id' => 2]);

    // Act
    $this->actingAs($employee)
        ->get('/employee/home')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('employee/home')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by customer', function () {
    // Arrange
    $customer = User::factory()->create(['role_id' => 4]);

    // Act
    $this->actingAs($customer)
        ->get('/employee/home')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act
    $this->actingAs($admin)
        ->get('/employee/home')
        ->assertOk();
});
