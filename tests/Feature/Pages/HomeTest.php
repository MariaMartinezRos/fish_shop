<?php

it('returns a successful response for home page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
