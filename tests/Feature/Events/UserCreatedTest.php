<?php

use App\Events\UserCreated;
use App\Models\User;
use App\Models\Role;

it('creates user created event with user model', function () {
    $user = User::factory()->create();
    $event = new UserCreated($user);

    expect($event->user)->toBe($user)
        ->and($event->user->id)->toBe($user->id)
        ->and($event->broadcastOn())->toBeArray()
        ->and($event->broadcastOn()[0])->toBeInstanceOf(\Illuminate\Broadcasting\PrivateChannel::class);
});

it('handles user with all attributes', function () {
    $role = Role::factory()->create();
    $user = User::factory()->create([
        'role_id' => $role->id,
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password'
    ]);

    $event = new UserCreated($user);

    expect($event->user->name)->toBe('Test User')
        ->and($event->user->email)->toBe('test@example.com')
        ->and($event->user->role_id)->toBe($role->id);
});
