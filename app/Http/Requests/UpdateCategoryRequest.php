<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //$categoryId = $this->route('category');

        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string'
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
            'name.required' => __('The name is required.'),
            'name.max' => __('The name cannot exceed 255 characters.'),
            'name.unique' => __('This name is already taken.'),
            'display_name.max' => __('The display name cannot exceed 255 characters.'),
            'description.string' => __('The description must be a string.'),
        ];
    }
}
