<?php

it('returns a successful response for terms page', function () {
    $response = $this->get('terms');

    $response->assertStatus(200);
});
