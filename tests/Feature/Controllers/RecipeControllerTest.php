<?php

use App\Models\Product;
use App\Models\Role;
use App\Models\User;

it('shows the recipes page', function () {
    $response = $this->get(route('recipes'));
    $response->assertStatus(200);
});

