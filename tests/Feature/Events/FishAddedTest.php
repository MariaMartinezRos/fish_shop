<?php

use App\Events\FishAdded;
use App\Models\Fish;
use App\Models\TypeWater;

it('creates fish added event with fish model', function () {
    $typeWater = TypeWater::factory()->create();
    $fish = Fish::factory()->create();
    $fish->typeWater()->attach([$typeWater->id, 'temperature_range' => '24-30°C']);

    $event = new FishAdded($fish);

    expect($event->fish)->toBe($fish)
        ->and($event->fish->id)->toBe($fish->id)
        ->and($event->fish->type_water_id)->toBe($typeWater->id);
})->todo();

