<?php

use App\Livewire\Carousel;
use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for home page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('shows user if logged in', function () {
    // Arrange
    $user = User::factory()->create();

    loginAsUser($user);

    get(route('dashboard'))
        ->assertOk()
        ->assertSee($user->name)
        ->assertSee(route('logout'));
});

it('includes login if not logged in', function () {
    // Act & Assert
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Iniciar sesión')
        ->assertSee(route('login'));

});

it('includes register if not logged in', function () {
    // Act & Assert
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Registrarse')
        ->assertSee(route('register'));

});

it('includes logout if logged in', function () {
    // Act & Assert
    loginAsUser();
    get(route('dashboard'))
        ->assertOk()
        ->assertSeeText('Finalizar sesión')
        ->assertSee(route('dashboard'));

});

it('can switch images using the navigation buttons', function () {
    // Arrange
    $images = ['image1.jpg', 'image2.jpg', 'image3.jpg'];
    $carousel = new Carousel;
    $carousel->images = $images;

    // Act && Assert
    $carousel->next();
    $this->assertEquals(1, $carousel->currentIndex);

    $carousel->previous();
    $this->assertEquals(0, $carousel->currentIndex);
});
