<?php

use App\Events\FishAdded;
use App\Events\PageAccessed;
use App\Events\ProductAdded;
use App\Events\UserCreated;
use App\Models\Fish;
use App\Models\Product;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;

it('creates and broadcasts FishAdded event', function () {
    $fish = Fish::factory()->create();
    $event = new FishAdded($fish);

    expect($event->fish)->toBe($fish);
    expect($event->broadcastOn())->toBeArray();
    expect($event->broadcastOn()[0])->toBeInstanceOf(PrivateChannel::class);
    expect($event->broadcastOn()[0]->name)->toBe('channel-name');
});

it('creates and broadcasts ProductAdded event', function () {
    $product = Product::factory()->create();
    $event = new ProductAdded($product);

    expect($event->product)->toBe($product);
    expect($event->broadcastOn())->toBeArray();
    expect($event->broadcastOn()[0])->toBeInstanceOf(PrivateChannel::class);
    expect($event->broadcastOn()[0]->name)->toBe('channel-name');
});

it('creates and broadcasts UserCreated event', function () {
    $user = User::factory()->create();
    $event = new UserCreated($user);

    expect($event->user)->toBe($user);
    expect($event->broadcastOn())->toBeArray();
    expect($event->broadcastOn()[0])->toBeInstanceOf(PrivateChannel::class);
    expect($event->broadcastOn()[0]->name)->toBe('channel-name');
});

it('creates and broadcasts PageAccessed event', function () {
    $message = 'Test page accessed';
    $event = new PageAccessed($message);

    expect($event->message)->toBe($message);
    expect($event->broadcastOn())->toBeArray();
    expect($event->broadcastOn()[0])->toBeInstanceOf(PrivateChannel::class);
    expect($event->broadcastOn()[0]->name)->toBe('private-channel-name');
}); 