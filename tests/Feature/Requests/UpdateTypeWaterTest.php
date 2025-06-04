<?php

use App\Http\Requests\UpdateTypeWaterRequest;
use App\Models\TypeWater;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    $this->typeWater = TypeWater::factory()->create([
        'type' => 'Saltwater',
        'ph_level' => 7.0,
        'temperature_range' => '10-20°C',
        'salinity_level' => 35,
        'region' => 'Pacific',
        'description' => 'Original description',
    ]);
});

it('passes with valid data', function () {
    $data = [
        'type' => ['Freshwater'],
        'ph_level' => 7.2,
        'temperature_range' => '10-20°C',
        'salinity_level' => 35,
        'region' => 'Pacific',
        'description' => 'Tropical waters',
    ];

    $request = new UpdateTypeWaterRequest;
    $request->setContainer(app())->validateResolved();
    $request->typeWater = $this->typeWater;

    $validator = Validator::make($data, $request->rules());

    expect($validator->passes())->toBeTrue();
})->todo();

it('fails if type is not an array', function () {
    $data = ['type' => 'Saltwater'];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->first('type'))->toEqual('El campo type debe ser un conjunto.');
});

it('fails if type contains an invalid value', function () {
    $data = ['type' => ['Brackish']];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->first('type.0'))->toEqual('El campo type.0 no está en la lista de valores permitidos.');
});

it('fails if ph_level is out of range', function () {
    $data = ['ph_level' => 15];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->first('ph_level'))->toEqual('El campo ph level tiene que estar entre 0 - 14.');
});

it('passes with partial update data', function () {
    $data = [
        'ph_level' => 6.5,
        'temperature_range' => '15-25°C',
    ];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->passes())->toBeTrue();
});

it('fails if type already exists', function () {
    TypeWater::factory()->create(['type' => 'Freshwater']);

    $data = ['type' => ['Freshwater']];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->first('type.0'))->toEqual('El campo type.0 ya ha sido registrado.');
});
