<?php

use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

beforeEach(function () {
    $this->request = new UpdateProductRequest();
});

it('passes with valid partial update data', function () {
    $category = Category::factory()->create();

    $data = [
        'name' => 'Updated Product',
        'category_id' => $category->id,
        'price_per_kg' => 10.5,
        'stock_kg' => 20,
        'description' => 'Updated description',
    ];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());
    expect($validator->passes())->toBeTrue();
});

it('fails if name is provided but empty', function () {
    $data = ['name' => ''];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('name'))->toBeTrue();
});

it('fails if price_per_kg is negative', function () {
    $data = ['price_per_kg' => -5];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('price_per_kg'))->toBeTrue();
});

it('fails if stock_kg is not numeric', function () {
    $data = ['stock_kg' => 'not-a-number'];

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('stock_kg'))->toBeTrue();
});

it('fails if category_id does not exist', function () {
    $data = ['category_id' => 99999]; // assuming this ID doesn't exist

    $validator = Validator::make($data, $this->request->rules(), $this->request->messages());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('category_id'))->toBeTrue();
});
