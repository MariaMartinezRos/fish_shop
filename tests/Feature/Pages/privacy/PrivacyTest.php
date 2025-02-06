<?php

it('returns a successful response for privacy page', function () {
    $response = $this->get('privacy');

    $response->assertStatus(200);
});

it('returns the privacy policy', function () {
    $response = $this->get('privacy');

    $response->assertSee('Política de Privacidad');
});

it('shows the Go Back button', function () {
    $response = $this->get('privacy');

    $response->assertSee('Volver');
});
