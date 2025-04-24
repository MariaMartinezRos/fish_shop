<?php

use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for sales page', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    // Act
    $this->actingAs($admin)
        ->get('sales')
        ->assertOk();
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('sales')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $customerRole = Role::factory()->create(['name' => 'customer']);
    $customer = User::factory()->create(['role_id' => $customerRole->id]);

    // Act
    $this->actingAs($customer)
        ->get('sales')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $employee = User::factory()->create(['role_id' => $employeeRole->id]);

    // Act
    $this->actingAs($employee)
        ->get('sales')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $adminRole->id]);

    // Act
    $this->actingAs($admin)
        ->get('sales')
        ->assertOk()
        ->assertSeeText('Cliente');
});
