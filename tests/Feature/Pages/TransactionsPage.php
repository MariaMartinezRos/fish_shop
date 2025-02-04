<?php

use App\Models\User;

it('returns a successful response for transactions page', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    $response = $this->actingAs($user)->get('transactions');
    $response->assertStatus(200);
});
