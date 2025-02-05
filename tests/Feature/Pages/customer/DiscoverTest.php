<?php

it('returns a successful response for discover page', function () {
    $response = $this->get('discover');

    $response->assertStatus(200);
});
