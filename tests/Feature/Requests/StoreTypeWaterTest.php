<?php

use App\Http\Requests\StoreTypeWaterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

it('validates type is required', function () {
    // Arrange
    $request = new StoreTypeWaterRequest();

    // Act
    $data = [
        'ph_level' => 7,
        'temperature_range' => '20-30',
        'salinity_level' => 35,
        'region' => 'Tropical',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('type'))->toBeTrue();
});

it('validates type must be either Saltwater or Freshwater', function () {
    // Arrange
    $request = new StoreTypeWaterRequest();

    // Act
    $data = [
        'type' => 'Brackish', // Tipo no válido
        'ph_level' => 7,
        'temperature_range' => '20-30',
        'salinity_level' => 35,
        'region' => 'Tropical',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('type'))->toBeTrue();
});

it('validates ph_level is numeric and between 0 and 14', function () {
    // Arrange
    $request = new StoreTypeWaterRequest();

    // Act
    $data = [
        'type' => ['Saltwater'],
        'ph_level' => 15, // ph_level fuera de rango
        'temperature_range' => '20-30',
        'salinity_level' => 35,
        'region' => 'Tropical',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('ph_level'))->toBeTrue();
});

it('validates temperature_range is required', function () {
    // Arrange
    $request = new StoreTypeWaterRequest();

    // Act
    $data = [
        'type' => ['Saltwater'],
        'ph_level' => 7,
        'salinity_level' => 35,
        'region' => 'Tropical',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('temperature_range'))->toBeTrue();
});

it('validates salinity_level is numeric and not negative', function () {
    // Arrange
    $request = new StoreTypeWaterRequest();

    // Act
    $data = [
        'type' => ['Saltwater'],
        'ph_level' => 7,
        'temperature_range' => '20-30',
        'salinity_level' => -5, // Nivel de salinidad negativo
        'region' => 'Tropical',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('salinity_level'))->toBeTrue();
});

it('validates region is required', function () {
    // Arrange
    $request = new StoreTypeWaterRequest();

    // Act
    $data = [
        'type' => ['Saltwater'],
        'ph_level' => 7,
        'temperature_range' => '20-30',
        'salinity_level' => 35,
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('region'))->toBeTrue();
});

it('validates type is unique', function () {
    // Arrange
    $request = new StoreTypeWaterRequest();

    // Simulamos que ya existe un tipo 'Saltwater'
    // (Asegúrate de que el tipo esté presente en la base de datos para hacer esta prueba)
    // Este es un ejemplo simple de cómo hacerlo si usas una fábrica de datos o si ya tienes una entrada existente.
    \DB::table('type_water')->insert([
        'type' => 'Saltwater',
        'ph_level' => 7,
        'temperature_range' => '20-30',
        'salinity_level' => 35,
        'region' => 'Tropical',
    ]);

    // Act
    $data = [
        'type' => ['Saltwater'],
        'ph_level' => 7,
        'temperature_range' => '20-30',
        'salinity_level' => 35,
        'region' => 'Tropical',
    ];

    // Assert
    $validator = Validator::make($data, $request->rules(), $request->messages());
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('type'))->toBeTrue();
})->todo();
