<?php

it('returns a successful response for about page', function () {
    $response = $this->get('about');

    $response->assertStatus(200);
});
