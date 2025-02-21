<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users to make this request, you can change it if needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'name' => 'required|string|max:255|unique:products,name,' . $productId,
            'category_id' => 'required|integer|exists:categories,id',
            'price_per_kg' => 'required|numeric',
            'stock_kg' => 'required|numeric',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get the custom error messages for validation failures.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Este nombre de producto ya está en uso.',
            'category_id.required' => 'La categoría es obligatoria.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'price_per_kg.required' => 'El precio por kg es obligatorio.',
            'price_per_kg.numeric' => 'El precio debe ser un número.',
            'stock_kg.required' => 'El stock es obligatorio.',
            'stock_kg.numeric' => 'El stock debe ser un número.',
            'description.string' => 'La descripción debe ser un texto.',
        ];
    }
}

//
//namespace App\Http\Requests;
//
//use Illuminate\Foundation\Http\FormRequest;
//
//class ProductRequest extends FormRequest
//{
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * (its value is true by default because i already check the permissions with the policy)
//     */
//    public function authorize(): bool
//    {
//        return true;
//    }
//
//    /**
//     * Get the validation rules that apply to the request.
//     *
//     * @return array<string, string[]>
//     */
//    public function rules(): array
//    {
//        return [
//            'name' => ['required', 'string', 'max:255', 'unique:products,name,' . $this->route('product')],
//            'category_id' => ['required', 'integer', 'exists:categories,id'],
//            'price_per_kg' => ['required', 'numeric', 'min:0'],
//            'stock_kg' => ['required', 'numeric', 'min:0'],
//            'description' => ['nullable', 'string'],
//        ];
//    }
//
//    /**
//     * Custom error messages (optional).
//     */
//    public function messages(): array
//    {
//        return [
//            'name.required' => 'The product name is required.',
//            'name.unique' => 'This product name already exists.',
//            'category_id.exists' => 'The selected category does not exist.',
//            'price_per_kg.min' => 'The price must be at least 0.',
//            'stock_kg.min' => 'Stock must be at least 0.',
//        ];
//    }
//}
