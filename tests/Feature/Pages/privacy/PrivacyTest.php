<?php

it('returns a successful response for privacy page', function () {
    $response = $this->get('privacy');

    $response->assertStatus(200);
});
