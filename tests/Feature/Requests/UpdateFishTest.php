<?php

use App\Http\Requests\UpdateFishRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

beforeEach(function () {
    $this->request = new UpdateFishRequest();
});

it('passes with valid minimal data', function () {
    $data = [
        'name' => 'Clownfish',
        'diet' => 'Omnivore',
        'type' => 'Saltwater',
        'characteristics' => [
            'state' => 'Allowed',
            'temperature_range' => '24-27°C',
            'ph_range' => '7.8-8.4',
            'migration_pattern' => 'Non-migratory',
        ],
    ];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());
    expect($validator->passes())->toBeTrue();
});

it('fails if name is missing when provided via sometimes|required', function () {
    $data = [
        'name' => '',
    ];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('name'))->toBeTrue();
});

it('fails if diet is not one of allowed values', function () {
    $data = [
        'diet' => 'Insectivore',
    ];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('diet'))->toBeTrue();
});

it('fails if characteristics.state is not an allowed value', function () {
    $data = [
        'characteristics' => [
            'state' => 'Unknown',
            'temperature_range' => '20-25',
            'ph_range' => '6.5-7.5',
            'migration_pattern' => 'Anadromous',
        ],
    ];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('characteristics.state'))->toBeTrue();
});


