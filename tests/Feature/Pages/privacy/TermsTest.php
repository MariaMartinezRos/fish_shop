<?php

it('returns a successful response for terms page', function () {
    $response = $this->get('terms');

    $response->assertStatus(200);
});

it('returns the terms of service', function () {
    $response = $this->get('terms');

    $response->assertSee('Términos de Servicio');
});

it('shows the Go Back button', function () {
    $response = $this->get('privacy');

    $response->assertSee('Volver');
});
