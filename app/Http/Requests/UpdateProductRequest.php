<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price_per_kg' => 'required|numeric|min:0',
            'stock_kg' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'fishes' => 'nullable|array',
            'fishes.*.fish_id' => 'required|exists:fishes,id',
            'fishes.*.days_on_sale' => 'nullable|integer|min:0',
            'fishes.*.supplier' => 'nullable|string|max:255',
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
            'name.required' => __('The product name is required.'),
            'name.max' => __('The product name cannot exceed 255 characters.'),
            'category_id.required' => __('The category is required.'),
            'category_id.exists' => __('The selected category does not exist.'),
            'price_per_kg.required' => __('The price per kilogram is required.'),
            'price_per_kg.numeric' => __('The price must be a number.'),
            'price_per_kg.min' => __('The price cannot be negative.'),
            'stock_kg.required' => __('The stock amount is required.'),
            'stock_kg.numeric' => __('The stock amount must be a number.'),
            'stock_kg.min' => __('The stock amount cannot be negative.'),
            'fishes.array' => __('The fishes must be an array.'),
            'fishes.*.fish_id.required' => __('The fish ID is required.'),
            'fishes.*.fish_id.exists' => __('The selected fish does not exist.'),
            'fishes.*.days_on_sale.integer' => __('The days on sale must be an integer.'),
            'fishes.*.days_on_sale.min' => __('The days on sale cannot be negative.'),
            'fishes.*.supplier.string' => __('The supplier must be a string.'),
            'fishes.*.supplier.max' => __('The supplier name cannot exceed 255 characters.'),
        ];
    }
}
