<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'scientific_name' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'average_size_cm' => ['nullable', 'numeric', 'between:0,1000'],
            'diet' => ['required', 'string', 'in:Carnivore,Herbivore,Omnivore'],
            'lifespan_years' => ['nullable', 'integer', 'min:0'],
            'habitat' => ['nullable', 'string', 'max:255'],
            'conservation_status' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:Saltwater,Freshwater'],
            'characteristics' => ['required', 'array'],
            'characteristics.state' => ['required', 'string', 'in:Allowed,Forbidden,Biological rest'],
            'characteristics.temperature_range' => ['required', 'string', 'max:255'],
            'characteristics.ph_range' => ['required', 'string', 'max:255'],
            'characteristics.salinity' => ['nullable', 'numeric', 'between:0,100'],
            'characteristics.oxygen_level' => ['nullable', 'numeric', 'between:0,100'],
            'characteristics.migration_pattern' => ['required', 'string', 'in:Non-migratory,Anadromous,Catadromous'],
            'characteristics.recorded_since' => ['nullable', 'integer', 'min:1900', 'max:'.date('Y')],
            'characteristics.notes' => ['nullable', 'string'],
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
    //        // Ensure default values for required fields
    //        if (!isset($validated['diet'])) {
    //            $validated['diet'] = 'Omnivore';
    //        }
    //
    //        if (!isset($validated['characteristics']['state'])) {
    //            $validated['characteristics']['state'] = 'Allowed';
    //        }
    //
    //        if (!isset($validated['characteristics']['migration_pattern'])) {
    //            $validated['characteristics']['migration_pattern'] = 'Non-migratory';
    //        }
    //
    //        return $validated;
    //    }
}
