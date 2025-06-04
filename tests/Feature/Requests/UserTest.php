<?php

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

it('validates correctly for a new user creation', function () {
    // Arrange
    $request = new UserRequest;
    $role = Role::factory()->create(['id' => 1]);

    // Act
    $data = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => 'password123',
        'password2' => 'password123',
        'role_id' => $role->id,
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());

    expect($validator->passes())->toBeTrue();
});

it('validates correctly for user update', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);

    $user = User::create([
        'name' => 'Existing User',
        'email' => 'existinguser@example.com',
        'password' => bcrypt('password123'),
        'role_id' => $role->id,
    ]);

    $request = new UserRequest;

    $data = [
        'name' => 'Updated User',
        'email' => 'updateduser@example.com',
        'password' => 'newpassword123',  // No obligatorio, solo se actualiza si se proporciona
        'password2' => 'newpassword123',
        'role_id' => 1,
    ];

    // Act
    $request->merge(['user' => $user]);

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());

    expect($validator->passes())->toBeTrue();
});

it('fails when required fields are missing', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);

    $data = [
        'email' => 'testuser@example.com',
        'password' => 'password123',
        'password2' => 'password123',
        'role_id' => $role->id,
    ];

    $request = new UserRequest;

    // Act
    $validator = Validator::make($data, $request->rules(), $request->messages());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('El nombre es obligatorio.');
});

it('fails when passwords do not match', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);

    $data = [
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => 'password123',
        'password2' => 'differentpassword',
        'role_id' => $role->id,
    ];

    $request = new UserRequest;

    // Act
    $validator = Validator::make($data, $request->rules(), $request->messages());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('password2'))->toBe('Las contraseñas no coinciden.');
});

it('fails when email is already taken', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);

    User::create([
        'name' => 'Existing User',
        'email' => 'existinguser@example.com',
        'password' => bcrypt('password123'),
        'role_id' => $role->id,
    ]);

    // Act
    $data = [
        'name' => 'New User',
        'email' => 'existinguser@example.com',  // Correo ya existente
        'password' => 'password123',
        'password2' => 'password123',
        'role_id' => 1,
    ];

    $request = new UserRequest;

    // Validación
    $validator = Validator::make($data, $request->rules(), $request->messages());

    // Act & Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('email'))->toBe('Este correo ya está en uso.');
});
