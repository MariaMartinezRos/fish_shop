<?php

//
// use App\Http\Requests\UpdateTypeWaterRequest;
// use App\Models\TypeWater;
// use Illuminate\Support\Facades\Validator;
//
// it('validates required fields', function () {
//    $request = new UpdateTypeWaterRequest;
//    $rules = $request->rules();
//
//    expect($rules)->toHaveKey('name')
//        ->and($rules['name'])->toContain('required')
//        ->and($rules)->toHaveKey('display_name')
//        ->and($rules['display_name'])->toContain('required');
// });
//
// it('validates field types', function () {
//    $request = new UpdateTypeWaterRequest;
//    $rules = $request->rules();
//
//    expect($rules['name'])->toContain('string')
//        ->and($rules['display_name'])->toContain('string');
// });
//
// it('validates field lengths', function () {
//    $request = new UpdateTypeWaterRequest;
//    $rules = $request->rules();
//
//    expect($rules['name'])->toContain('max:255')
//        ->and($rules['display_name'])->toContain('max:255');
// });
//
// it('validates unique name constraint', function () {
//    $typeWater = TypeWater::factory()->create(['name' => 'existing-type']);
//    $request = new UpdateTypeWaterRequest;
//    $rules = $request->rules();
//
//    expect($rules['name'])->toContain('unique:type_waters,name,' . $typeWater->id);
// });
//
// it('passes validation with correct data', function () {
//    $typeWater = TypeWater::factory()->create();
//    $request = new UpdateTypeWaterRequest;
//
//    $data = [
//        'name' => 'updated-type',
//        'display_name' => 'Updated Type',
//    ];
//
//    $validator = Validator::make($data, $request->rules(), $request->messages());
//    expect($validator->passes())->toBeTrue();
// });
//
// it('fails validation with missing required fields', function () {
//    $request = new UpdateTypeWaterRequest;
//
//    $data = [
//        'name' => '',
//        'display_name' => '',
//    ];
//
//    $validator = Validator::make($data, $request->rules(), $request->messages());
//    expect($validator->fails())->toBeTrue();
//    expect($validator->errors()->has('name'))->toBeTrue();
//    expect($validator->errors()->has('display_name'))->toBeTrue();
// });
//
// it('fails validation with duplicate name', function () {
//    $existingType = TypeWater::factory()->create(['name' => 'existing-type']);
//    $typeWater = TypeWater::factory()->create();
//    $request = new UpdateTypeWaterRequest;
//
//    $data = [
//        'name' => 'existing-type',
//        'display_name' => 'Updated Type',
//    ];
//
//    $validator = Validator::make($data, $request->rules(), $request->messages());
//    expect($validator->fails())->toBeTrue();
//    expect($validator->errors()->has('name'))->toBeTrue();
// });
//
// it('has custom error messages', function () {
//    $request = new UpdateTypeWaterRequest;
//    $messages = $request->messages();
//
//    expect($messages)->toHaveKey('name.required')
//        ->and($messages)->toHaveKey('name.unique')
//        ->and($messages)->toHaveKey('display_name.required');
// });
