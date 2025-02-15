<?php

use App\Models\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_User_C;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
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
