<?php


use App\Models\User;

it('returns a successful response for dashboard page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $response = $this->actingAs($user)->get('dashboard');
    $response->assertStatus(200);
});

it('shows user if logged in', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $response = $this->actingAs($user)->get('/dashboard');

    // Assert
    $response->assertSee($user->name);
});
