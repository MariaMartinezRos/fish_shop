<?php

use App\Models\User;

it('returns a successful response for users page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $response = $this->actingAs($user)->get('users');
    $response->assertStatus(200);
});
