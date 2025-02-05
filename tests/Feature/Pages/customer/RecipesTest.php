<?php

it('returns a successful response for recipes page', function () {
    $response = $this->get('recipes');

    $response->assertStatus(200);
});
