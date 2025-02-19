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
            'image' => ['nullable', 'image', 'max:2048'],
            'type' => ['required', 'string', 'in:Saltwater,Freshwater'],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @param  null  $key
     * @param  null  $default
     */
    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated();
        if (! isset($validated['type'])) {
            $validated['type'] = 'Saltwater';
        }
        if (! isset($validated['image'])) {
            $validated['image'] = null;
        }

        return $validated;
    }
}
