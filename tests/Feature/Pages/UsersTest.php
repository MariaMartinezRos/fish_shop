<?php

use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for users page', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get('users')
        ->assertOk();
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('users')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $customerRole = Role::factory()->create(['name' => 'customer']);
    $customer = User::factory()->create();
    $customer->role_id = $customerRole->id;
    $customer->save();

    // Act
    $this->actingAs($customer)
        ->get('users')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $employee = User::factory()->create();
    $employee->role_id = $employeeRole->id;
    $employee->save();

    // Act
    $this->actingAs($employee)
        ->get('users')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get('users')
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('can create a user successfully', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    $customerRole = Role::factory()->create(['name' => 'customer']);

    // Act
    $this->actingAs($admin)
        ->post('users', [
            'name' => 'Jane Doe',
            'email' => 'example@example.com',
            'password' => '1234567890',
            'password2' => '1234567890',
            'role_id' => $customerRole->id,
        ])
        ->assertRedirect('users')
        ->assertSessionHas('success', 'Usuario creado correctamente');

    // Assert
    $this->assertDatabaseHas('users', [
        'name' => 'Jane Doe',
        'email' => 'example@example.com',
        'role_id' => $customerRole->id,
    ]);
});

it('can delete a user', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    $customerRole = Role::factory()->create(['name' => 'customer']);
    $user = User::factory()->create();
    $user->role_id = $customerRole->id;
    $user->save();

    // Act
    $this->actingAs($admin)
        ->delete("users/{$user->id}")
        ->assertRedirect('users')
        ->assertSessionHas('success', 'Usuario eliminado correctamente');
});

it('can update a user', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    $customerRole = Role::factory()->create(['name' => 'customer']);
    $user = User::factory()->create(['name' => 'John Doe', 'email' => 'example@example.com']);
    $user->role_id = $customerRole->id;
    $user->save();

    // Act
    $this->actingAs($admin)
        ->put("users/{$user->id}", [
            'name' => 'Jane Doe',
            'email' => 'example@example.com',
            'role_id' => $customerRole->id,
        ])
        ->assertRedirect('users')
        ->assertSessionHas('success', 'Usuario actualizado correctamente');
});
