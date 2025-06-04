<?php

use App\Models\TypeWater;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('has fishes relationship as belongsToMany', function () {
    $typeWater = new TypeWater;

    expect($typeWater->fishes())->toBeInstanceOf(BelongsToMany::class);
});

it('allows mass assignment of fillable attributes', function () {
    $typeWater = TypeWater::create(['type' => 'Salada']);

    expect($typeWater->type)->toBe('Salada');
});
