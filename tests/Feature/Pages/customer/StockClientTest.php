<?php

it('returns a successful response for stock client page', function () {
    $response = $this->get('stock-client');

    $response->assertStatus(200);
});
