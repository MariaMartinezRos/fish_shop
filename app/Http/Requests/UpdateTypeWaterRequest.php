<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTypeWaterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => [
                'sometimes',
                'required',
                'string',
                'in:Saltwater,Freshwater',
                Rule::unique('type_waters', 'type')->ignore($this->typeWater),
            ],
            'ph_level' => ['sometimes', 'required', 'numeric', 'between:0,14'],
            'temperature_range' => ['sometimes', 'required', 'string'],
            'salinity_level' => ['sometimes', 'required', 'numeric', 'min:0'],
            'region' => ['sometimes', 'required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.required' => 'The water type is required.',
            'type.in' => 'The water type must be either Saltwater or Freshwater.',
            'type.unique' => 'This water type already exists.',
            'ph_level.required' => 'The pH level is required.',
            'ph_level.numeric' => 'The pH level must be a number.',
            'ph_level.between' => 'The pH level must be between 0 and 14.',
            'temperature_range.required' => 'The temperature range is required.',
            'salinity_level.required' => 'The salinity level is required.',
            'salinity_level.numeric' => 'The salinity level must be a number.',
            'salinity_level.min' => 'The salinity level cannot be negative.',
            'region.required' => 'The region is required.',
        ];
    }
} 