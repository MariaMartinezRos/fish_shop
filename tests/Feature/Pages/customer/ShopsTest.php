<?php

it('returns a successful response for shops page', function () {
    $response = $this->get('shops');

    $response->assertStatus(200);
});

it('shows the image and name of the shops', function () {
    $response = $this->get('shops');

    $response->assertSee('Pescaderías Benito TIENDA 1');
    $response->assertSee('Pescaderías Benito TIENDA 2');
    $response->assertSee('image05.jpg');
    $response->assertSee('image07.jpg');
});

it('shows the direction of the shops', function () {
    $response = $this->get('shops');

    $response->assertSee('123 Seaside Ave, Miami, FL');
    $response->assertSee('456 Harbor St, San Diego, CA');
});
