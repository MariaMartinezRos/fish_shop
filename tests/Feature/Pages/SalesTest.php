<?php

use App\Models\User;

it('returns a successful response for sales page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $response = $this->actingAs($user)->get('sales');
    $response->assertStatus(200);
});
