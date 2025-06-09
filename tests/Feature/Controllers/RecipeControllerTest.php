<?php

use App\Models\User;

it('shows the recipes page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('recipes'));
    $response->assertStatus(200);
});
