<?php

use App\Events\PageAccessed;

it('creates page accessed event with message', function () {
    $message = 'Test page accessed';
    $event = new PageAccessed($message);

    expect($event->message)->toBe($message)
        ->and($event->broadcastOn())->toBeArray()
        ->and($event->broadcastOn()[0])->toBeInstanceOf(\Illuminate\Broadcasting\PrivateChannel::class);
});

it('handles empty message', function () {
    $event = new PageAccessed('');

    expect($event->message)->toBe('');
});

it('handles long message', function () {
    $longMessage = str_repeat('a', 1000);
    $event = new PageAccessed($longMessage);

    expect($event->message)->toBe($longMessage);
});
