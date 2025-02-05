<?php

it('returns a successful response for shops page', function () {
    $response = $this->get('shops');

    $response->assertStatus(200);
});
