<?php

use App\Models\Role;
use App\Models\User;

beforeEach(function () {
    $role = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create(['role_id' => $role->id]);
    loginAsUser($admin);
});

it('renders app layout with title', function () {
    $view = $this->blade('<x-app-layout title="Pescaderias Benito">
        <div>Pescaderias Benito</div>
    </x-app-layout>');

    $view->assertSee('Pescaderias Benito');
});

it('renders app layout with navigation for guest user', function () {
    $view = $this->blade('<x-app-layout>
        <div>Test Content</div>
    </x-app-layout>');

    $view->assertSee('Iniciar sesión');
    $view->assertSee('Registrarse');
})->todo('He iniciado sesion en todo el test como user, entonces no va a salir iniciar sesion ni registrarse');

it('renders app layout with navigation for authenticated user', function () {
    // Arrange && Act && Assert
    $view = $this->blade('<x-app-layout>
        <div>Test Content</div>
    </x-app-layout>');

    $view->assertSee('Cerrar Sesión');
    $view->assertDontSee('Iniciar sesión');
});

it('renders app layout with admin navigation for admin user', function () {
    // Arrange && Act && Assert
    $view = $this->blade('<x-app-layout>
        <div>Test Content</div>
    </x-app-layout>');

    $view->assertSee('Ventas');
    $view->assertSee('Cerrar Sesión');
});
