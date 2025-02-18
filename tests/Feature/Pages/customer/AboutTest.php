<?php

it('returns a successful response for about page', function () {
    $response = $this->get('about');

    $response->assertStatus(200);
});

it('redirects to the mailing', function () {
    $response = $this->get('about');

    $response->assertSee('mailto:'.env('APP_MAIL'));
    $response->assertStatus(200);
});

it('shows established text', function () {
    $response = $this->get('about');

    $response->assertSee('Quiénes Somos');
    $response->assertStatus(200);
});
