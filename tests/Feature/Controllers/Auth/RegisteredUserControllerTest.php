<?php

namespace Tests\Feature\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


    it('renders registration screen', function () {
        $response = $this->get('/register');

        $response->assertStatus(200);
    });

    it('registers new users', function () {
        Event::fake();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        expect(auth()->check())->toBeTrue();
        $response->assertRedirect(route('dashboard'));

        expect(User::where('email', 'test@example.com')->exists())->toBeTrue();
        Event::assertDispatched(Registered::class);
    });


    it('hashes password', function () {
        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = User::where('email', 'test@example.com')->first();
        expect(Hash::check('password', $user->password))->toBeTrue();
    });
