<?php

use App\Models\User;

it('returns a successful response for category page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $response = $this->actingAs($user)->get('category');
    $response->assertStatus(200);
});

