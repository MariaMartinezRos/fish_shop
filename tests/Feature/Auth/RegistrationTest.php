<?php


test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('registration validation fails with invalid data', function () {
    $response = $this->post('/register', [
        'name' => '',
        'email' => 'invalid-email',
        'password' => 'short',
        'password_confirmation' => 'different',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
});

test('registration fails with duplicate email', function () {
    $user = \App\Models\User::factory()->create([
        'email' => 'test@example.com'
    ]);

    $response = $this->post('/register', [
        'name' => 'Another User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors(['email']);
});

