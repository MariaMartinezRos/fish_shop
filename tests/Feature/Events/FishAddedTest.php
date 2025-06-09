<?php

use App\Events\FishAdded;
use App\Models\Fish;
use App\Models\TypeWater;
use Illuminate\Support\Facades\Log;

it('creates fish added event with fish model', function () {
    $typeWater = TypeWater::factory()->create();
    $fish = Fish::factory()->create();
    //    $fish->typeWater()->attach([$typeWater->id, 'temperature_range' => '24-30°C']);
    $fish->typeWater()->attach([
        $typeWater->id => [
            'temperature_range' => '24-30°C',
            'ph_range' => '6.5-7.5',
        ],
    ]);

    $event = new FishAdded($fish);

    expect($event->fish)->toBe($fish)
        ->and($event->fish->id)->toBe($fish->id)
        ->and($event->fish->typeWater->pluck('id'))->toContain($typeWater->id)
        ->and($event->broadcastOn())->toBeArray()
        ->and($event->broadcastOn()[0])->toBeInstanceOf(\Illuminate\Broadcasting\PrivateChannel::class);
});

it('logs message when fish is added', function () {
    $fish = Fish::factory()->create(['name' => 'Test Fish']);
    $event = new FishAdded($fish);

    // Trigger the event listener
    app()->make(\App\Listeners\SendNotificationOnFishAdded::class)->handle($event);

    // Check the log file for the message
    $logContent = file_get_contents(storage_path('logs/laravel.log'));
    expect($logContent)->toContain('Fish added successfully: '.$fish->name);
});
