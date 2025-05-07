<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tpv' => ['required', 'string', 'max:255'],
            'serial_number' => ['required', 'string'],
            'terminal_number' => ['required', 'string'],
            'operation' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0'],
            'card_number' => ['required', 'string', 'size:16'],
            'date_time' => ['required', 'date'],
            'transaction_number' => ['required', 'string'],
            'sale_id' => ['required', 'exists:sales,id'],
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
            'tpv.required' => 'The TPV identifier is required.',
            'tpv.max' => 'The TPV identifier cannot exceed 255 characters.',
            'serial_number.required' => 'The serial number is required.',
            'terminal_number.required' => 'The terminal number is required.',
            'operation.required' => 'The operation type is required.',
            'amount.required' => 'The transaction amount is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount cannot be negative.',
            'card_number.required' => 'The card number is required.',
            'card_number.size' => 'The card number must be exactly 16 digits.',
            'date_time.required' => 'The transaction date and time is required.',
            'date_time.date' => 'The date and time must be a valid date.',
            'transaction_number.required' => 'The transaction number is required.',
            'sale_id.required' => 'The sale reference is required.',
            'sale_id.exists' => 'The referenced sale does not exist.',
        ];
    }
} 