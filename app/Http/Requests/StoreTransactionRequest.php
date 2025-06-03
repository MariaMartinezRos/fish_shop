<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'tpv' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'terminal_number' => 'required|string|max:255',
            'operation' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'card_number' => 'required|string|min:4',
            'date_time' => 'required|date',
            'transaction_number' => 'required|string|max:255',
            'sale_id' => 'required|numeric'
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
            'tpv.required' => 'The TPV is required.',
            'tpv.max' => 'The TPV cannot exceed 255 characters.',
            'serial_number.required' => 'The serial number is required.',
            'serial_number.max' => 'The serial number cannot exceed 255 characters.',
            'terminal_number.required' => 'The terminal number is required.',
            'terminal_number.max' => 'The terminal number cannot exceed 255 characters.',
            'operation.required' => 'The operation is required.',
            'operation.max' => 'The operation cannot exceed 255 characters.',
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount cannot be negative.',
            'card_number.required' => 'The card number is required.',
            'date_time.required' => 'The date and time is required.',
            'date_time.date' => 'The date and time must be a valid date.',
            'transaction_number.required' => 'The transaction number is required.',
            'transaction_number.max' => 'The transaction number cannot exceed 255 characters.',
            'sale_id.required' => 'The sale ID is required.',
            'sale_id.numeric' => 'The sale ID must be a number.'
        ];
    }
}
