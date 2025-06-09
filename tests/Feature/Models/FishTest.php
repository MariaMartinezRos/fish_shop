<?php

use App\Models\Fish;
use App\Models\Product;
use App\Models\TypeWater;

it('can create a fish with basic attributes', function () {
    $fish = Fish::factory()->create([
        'name' => 'Test Fish',
        'scientific_name' => 'Testus Fishius',
        'description' => 'A test fish',
        'average_size_cm' => '15.50',
        'diet' => 'Omnivore',
        'lifespan_years' => 5,
        'habitat' => 'Freshwater',
        'conservation_status' => 'Least Concern'
    ]);

    expect($fish)
        ->name->toBe('Test Fish')
        ->scientific_name->toBe('Testus Fishius')
        ->description->toBe('A test fish')
        ->average_size_cm->toBe('15.50')
        ->diet->toBe('Omnivore')
        ->lifespan_years->toBe(5)
        ->habitat->toBe('Freshwater')
        ->conservation_status->toBe('Least Concern');
});

it('casts numeric attributes correctly', function () {
    $fish = Fish::factory()->create([
        'average_size_cm' => '20.75',
        'lifespan_years' => 10
    ]);

    expect($fish)
        ->average_size_cm->toBe('20.75')
        ->lifespan_years->toBe(10);
});

it('can be associated with type waters', function () {
    $fish = Fish::factory()->create();

    $typeWater = TypeWater::get()->first() ?? TypeWater::factory()->create();

    $fish->TypeWater()->attach($typeWater->id, [
        'state' => 'Forbidden',
        'temperature_range' => '20-25°C',
        'ph_range' => '6.5-7.5',
        'salinity' => '0.5%',
        'oxygen_level' => '6mg/L',
        'migration_pattern' => 'Non-migratory',
        'recorded_since' => now(),
        'notes' => 'Test notes'
    ]);

    expect($fish->TypeWater)->toHaveCount(1)
        ->and($fish->TypeWater->first())
        ->id->toBe($typeWater->id)
        ->pivot->state->toBe('Active')
        ->pivot->temperature_range->toBe('20-25°C')
        ->pivot->ph_range->toBe('6.5-7.5')
        ->pivot->salinity->toBe('0.5%')
        ->pivot->oxygen_level->toBe('6mg/L')
        ->pivot->migration_pattern->toBe('Non-migratory')
        ->pivot->notes->toBe('Test notes');
})->todo();

it('can be associated with products', function () {
    $fish = Fish::factory()->create();
    $category = \App\Models\Category::factory()->create();
    $product = Product::factory()->create(['category_id' =>$category->id]);

    $fish->products()->attach($product->id, [
        'days_on_sale' => 5,
        'supplier' => 'Test Supplier'
    ]);

    expect($fish->products)
        ->and($fish->products->first())
        ->id->toBe($product->id)
        ->pivot->days_on_sale->toBe(5)
        ->pivot->supplier->toBe('Test Supplier');
})->todo();

it('can be soft deleted', function () {
    $fish = Fish::factory()->create();
    $fishId = $fish->id;

    $fish->delete();

    expect(Fish::find($fishId))->toBeNull()
        ->and(Fish::withTrashed()->find($fishId))->not->toBeNull();
});

it('can be restored after soft delete', function () {
    $fish = Fish::factory()->create();
    $fishId = $fish->id;

    $fish->delete();
    $fish->restore();

    expect(Fish::find($fishId))->not->toBeNull();
});
