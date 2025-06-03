<?php

use App\Jobs\SendContactConfirmationEmail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;

it('submits contact form successfully', function () {
    Queue::fake();

    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $employee = User::factory()->create(['role_id' => $employeeRole->id]);

    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'email' => $employee->email,
        'message' => 'Test message'
    ]);

    $response->assertRedirect()
        ->assertSessionHas('success', 'Your message has been sent successfully!');

    Queue::assertPushed(SendContactConfirmationEmail::class, function ($job) use ($employee) {
        return $job->getUser()->id === $employee->id;
    });
});

it('validates required fields', function () {
    $response = $this->post(route('contact.submit'), []);

    $response->assertSessionHasErrors(['name', 'email', 'message']);
});

it('validates email format', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'email' => 'invalid-email',
        'message' => 'Test message'
    ]);

    $response->assertSessionHasErrors(['email']);
});

it('handles non-existent user email', function () {
    Queue::fake();

    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'email' => 'nonexistent@example.com',
        'message' => 'Test message'
    ]);

    $response->assertRedirect()
        ->assertSessionHas('success', 'Your message has been sent successfully!');

    Queue::assertPushed(SendContactConfirmationEmail::class);
});

it('validates message length', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'message' => '' // Empty message
    ]);

    $response->assertSessionHasErrors(['message']);
});

it('validates name length', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => str_repeat('a', 256), // Exceeds max length
        'email' => 'test@example.com',
        'message' => 'Test message'
    ]);

    $response->assertSessionHasErrors(['name']);
});
