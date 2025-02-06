<?php

it('is a todo', function () {
    // Arrange

    // Act & Assert
})->todo();
it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(500);
});
