<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => ['sometimes', 'required', 'exists:categories,id'],
            'price_per_kg' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stock_kg' => ['sometimes', 'required', 'numeric', 'min:0'],
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
            'name.required' => 'The product name is required.',
            'name.max' => 'The product name cannot exceed 255 characters.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category does not exist.',
            'price_per_kg.required' => 'The price per kilogram is required.',
            'price_per_kg.numeric' => 'The price must be a number.',
            'price_per_kg.min' => 'The price cannot be negative.',
            'stock_kg.required' => 'The stock amount is required.',
            'stock_kg.numeric' => 'The stock amount must be a number.',
            'stock_kg.min' => 'The stock amount cannot be negative.',
        ];
    }
} 