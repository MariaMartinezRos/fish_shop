<?php

use App\Events\FishAdded;
use App\Events\UserCreated;
use App\Listeners\SendNotificationOnFishAdded;
use App\Models\Fish;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\Facades\Event;

//  verifica si el evento UserCreated es disparado cuando se crea un nuevo usuario
it('dispatches the UserCreated event', function () {
    // Arrange
    Event::fake();
    $user = User::factory()->create();
    event(new UserCreated($user));

    // Act && Assert
    Event::assertDispatched(UserCreated::class, function ($event) use ($user) {
        return $event->user->id === $user->id;
    });
});

// asegura que el evento UserCreated contiene el usuario correcto (es decir, el usuario recién creado)
it('contains the correct user', function () {
    // Arrange
    $user = User::factory()->create();
    $event = new UserCreated($user);

    // Act && Assert
    expect($event->user->id)->toBe($user->id);
});

// se asegura de que este en un 'canal privado' para que solo el usuario
// que se registra pueda escuchar el evento
it('broadcasts on the correct channel', function () {
    // Arrange
    $user = User::factory()->create();
    $event = new UserCreated($user);

    // Act && Assert
    expect($event->broadcastOn())->toContainOnlyInstancesOf(PrivateChannel::class);
})->todo('no es necesario');


it('creates a FishAdded event with a fish instance', function () {
    $fish = new Fish(['name' => 'Salmón']);
    $event = new FishAdded($fish);

    expect($event->fish)->toBeInstanceOf(Fish::class)
        ->and($event->fish->name)->toBe('Salmón');
});

it('flashes a success message to the session when a fish is added', function () {
    Session::start();

    $fish = new Fish(['name' => 'Trucha']);
    $event = new FishAdded($fish);
    $listener = new SendNotificationOnFishAdded();

    $listener->handle($event);

    expect(Session::get('toast'))->toBe([
        'type' => 'success',
        'message' => '¡Pez agregado exitosamente: Trucha!'
    ]);
});
