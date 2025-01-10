<?php

use App\Models\User;

it('returns a successful response for stock page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $response = $this->actingAs($user)->get('stock');
    $response->assertStatus(200);
});

