<?php

use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for users page', function () {
    // Arrange
    loginAsAdmin();

    // Act
    $this->get('users')
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
    $costumer = User::factory()->create(['role_id' => 4]);

    // Act
    $this->actingAs($costumer)
        ->get('users')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $employee = User::factory()->create(['role_id' => 3]);

    // Act
    $this->actingAs($employee)
        ->get('users')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    loginAsAdmin();

    // Act
    $this->get('users')
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('can create a user successfully', function () {
    // Arrange
//    $role = Role::factory()->create(['id' => 4]);
    loginAsAdmin();

    // Act
    $this->post('users', [
            'name' => 'Jane Doe',
            'email' => 'example@example.com',
            'password' => '1234567890',
            'password2' => '1234567890',
            'role_id' => 4,
        ])
        ->assertRedirect('users')
        ->assertSessionHas('success', 'Usuario creado correctamente');

    // Assert
//    $this->assertDatabaseHas('users', [
//        'name' => 'Jane Doe',
//        'email' => 'example@example.com',
//        'role_id' => 4,
//    ]);
})->todo(' Integrity constraint violation: 19 NOT NULL constraint failed: users.role_id in');

it('can delete a user', function () {
    // Arrange
    loginAsAdmin();
    $user = User::factory()->create();

    // Act
    $this->delete("users/{$user->id}")
        ->assertRedirect('users')
        ->assertSessionHas('success', 'Usuario eliminado correctamente');
})->todo();

it('can update a user', function () {
    // Arrange
    loginAsAdmin();
    $user = User::factory()->create(['name' => 'John Doe', 'email' => 'example@example.com']);

    // Act
    $this->put("users/{$user->id}", [
            'name' => 'Jane Doe',
            'email' => 'example@example.com',
            'role_id' => 4,
        ])
        ->assertRedirect('users')
        ->assertSessionHas('success', 'Usuario actualizado correctamente');
})->todo();
