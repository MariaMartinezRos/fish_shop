<?php

use App\Http\Requests\UpdateTypeWaterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\TypeWater;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

it('passes with valid data', function () {
    $data = [
        'type' => ['Saltwater'],
        'ph_level' => 7.2,
        'temperature_range' => '10-20°C',
        'salinity_level' => 35,
        'region' => 'Pacific',
        'description' => 'Tropical waters',
    ];

    $request = new UpdateTypeWaterRequest();
    $request->setContainer(app())->validateResolved();

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->passes())->toBeTrue();
})->todo();

it('fails if type is not an array', function () {
    $data = ['type' => 'Saltwater'];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('type'))->toEqual('El campo type debe ser un conjunto.');
});

it('fails if type contains an invalid value', function () {
    $data = ['type' => ['Brackish']];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('type.0'))->toEqual('El campo type.0 no está en la lista de valores permitidos.');
});

it('fails if ph_level is out of range', function () {
    $data = ['ph_level' => 15];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('ph_level'))->toEqual('El campo ph level tiene que estar entre 0 - 14.');
});

it('passes with partial update data', function () {
    $data = [
        'ph_level' => 6.5,
        'temperature_range' => '15-25°C',
    ];

    $validator = Validator::make($data, (new UpdateTypeWaterRequest)->rules());

    expect($validator->passes())->toBeTrue();
});
