<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFishRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'scientific_name' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'average_size_cm' => ['nullable', 'numeric', 'between:0,1000'],
            'diet' => ['sometimes', 'required', 'string', 'in:Carnivore,Herbivore,Omnivore'],
            'lifespan_years' => ['nullable', 'integer', 'min:0'],
            'habitat' => ['nullable', 'string', 'max:255'],
            'conservation_status' => ['nullable', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'string', 'in:Saltwater,Freshwater'],
            'characteristics' => ['sometimes', 'required', 'array'],
            'characteristics.state' => ['required_with:characteristics', 'string', 'in:Allowed,Forbidden,Biological rest'],
            'characteristics.temperature_range' => ['required_with:characteristics', 'string', 'max:255'],
            'characteristics.ph_range' => ['required_with:characteristics', 'string', 'max:255'],
            'characteristics.salinity' => ['nullable', 'numeric', 'between:0,100'],
            'characteristics.oxygen_level' => ['nullable', 'numeric', 'between:0,100'],
            'characteristics.migration_pattern' => ['required_with:characteristics', 'string', 'in:Non-migratory,Anadromous,Catadromous'],
            'characteristics.recorded_since' => ['nullable', 'integer', 'min:1900', 'max:'.date('Y')],
            'characteristics.notes' => ['nullable', 'string'],
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
            'name.required' => __('The fish name is required.'),
            'name.max' => __('The fish name cannot exceed 255 characters.'),
            'scientific_name.max' => __('The scientific name cannot exceed 255 characters.'),
            'image.image' => __('The file must be an image.'),
            'image.max' => __('The image size cannot exceed 2MB.'),
            'average_size_cm.between' => __('The average size must be between 0 and 1000 cm.'),
            'diet.in' => __('The diet must be one of: Carnivore, Herbivore, or Omnivore.'),
            'lifespan_years.min' => __('The lifespan cannot be negative.'),
            'type.in' => __('The water type must be either Saltwater or Freshwater.'),
            'characteristics.state.in' => __('The state must be one of: Allowed, Forbidden, or Biological rest.'),
            'characteristics.migration_pattern.in' => __('The migration pattern must be one of: Non-migratory, Anadromous, or Catadromous.'),
            'characteristics.recorded_since.min' => __('The recorded since year must be 1900 or later.'),
            'characteristics.recorded_since.max' => __('The recorded since year cannot be in the future.'),
        ];
    }

    //    /**
    //     * Get the validated data from the request.
    //     *
    //     * @param  null  $key
    //     * @param  null  $default
    //     */
    //    public function validated($key = null, $default = null): array
    //    {
    //        $validated = parent::validated();
    //
    //        // Only set default values if the corresponding fields are being updated
    //        if (!isset($validated['diet'])) {
    //            $validated['diet'] = 'Omnivore';
    //        }
    //
    //        if (isset($validated['characteristics']) && !isset($validated['characteristics']['state'])) {
    //            $validated['characteristics']['state'] = 'Allowed';
    //        }
    //
    //        if (isset($validated['characteristics']) && !isset($validated['characteristics']['migration_pattern'])) {
    //            $validated['characteristics']['migration_pattern'] = 'Non-migratory';
    //        }
    //
    //        return $validated;
    //    }
}
