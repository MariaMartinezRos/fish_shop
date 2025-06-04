<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VacationRequestActionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role->name === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'requestId' => [
                'required',
                'exists:vacation_requests,id',
            ],
            'type' => [
                'required',
                'in:pending,approved',
            ],
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
            'requestId.required' => __('The request ID is required.'),
            'requestId.exists' => __('The vacation request does not exist.'),
            'type.required' => __('The type of action is required.'),
            'type.in' => __('The type of action is not valid.'),
        ];
    }
}
