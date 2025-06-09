<?php

use App\Jobs\SendContactConfirmationEmail;
use App\Models\User;
use Illuminate\Support\Facades\Queue;

use function Pest\Laravel\post;

beforeEach(function () {
    Queue::fake();
});

it('validates required fields', function () {
    post(route('contact.submit'), [])
        ->assertOk();
})->todo();

it('validates email format', function () {
    post(route('contact.submit'), [
        'name' => 'John Doe',
        'email' => 'email@gmail.com',
        'message' => 'Test message',
    ])->assertOk();
})->todo();

it('validates string length constraints', function () {
    post(route('contact.submit'), [
        'name' => str_repeat('a', 256),
        'email' => 'test@example.com',
        'message' => 'Test message',
    ])->assertOk();
})->todo();

it('dispatches confirmation email job for existing user', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);

    post(route('contact.submit'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'message' => 'Test message',
    ])->assertSessionHas('success');

    Queue::assertPushed(SendContactConfirmationEmail::class, function ($job) use ($user) {
        return $job->getUser()->id === $user->id;
    });
});

it('dispatches confirmation email job for non-existing user', function () {
    post(route('contact.submit'), [
        'name' => 'John Doe',
        'email' => 'new@example.com',
        'message' => 'Test message',
    ])->assertSessionHas('success');

    Queue::assertPushed(SendContactConfirmationEmail::class, function ($job) {
        return $job->getUser() === null;
    });
});

it('returns success message after submission', function () {
    $response = post(route('contact.submit'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'message' => 'Test message',
    ]);

    $response->assertSessionHas('success', '¡Tu mensaje ha sido enviado con éxito!');
});
