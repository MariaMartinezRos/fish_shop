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
            'type' => ['sometimes', 'required', 'array'],
            'type.*' => [
                'string',
                Rule::in(['Saltwater', 'Freshwater']),
                Rule::unique('type_water', 'type')->ignore($this->typeWater),
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
            'type.required' => __('At least one water type is required.'),
            'type.array' => __('The water type must be an array.'),
            'type.*.in' => __('Each water type must be either Saltwater or Freshwater.'),
            'type.*.unique' => __('One or more water types already exist.'),
            'ph_level.required' => __('The pH level is required.'),
            'ph_level.numeric' => __('The pH level must be a number.'),
            'ph_level.between' => __('The pH level must be between 0 and 14.'),
            'temperature_range.required' => __('The temperature range is required.'),
            'salinity_level.required' => __('The salinity level is required.'),
            'salinity_level.numeric' => __('The salinity level must be a number.'),
            'salinity_level.min' => __('The salinity level cannot be negative.'),
            'region.required' => __('The region is required.'),
        ];
    }
}
