AboutTest.php<?php

it('returns a successful response for contact page', function () {
    $response = $this->get('contact');

    $response->assertStatus(200);
});
