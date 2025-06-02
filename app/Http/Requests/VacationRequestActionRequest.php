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
            'requestId.required' => 'El ID de la solicitud es requerido.',
            'requestId.exists' => 'La solicitud de vacaciones no existe.',
            'type.required' => 'El tipo de acción es requerido.',
            'type.in' => 'El tipo de acción no es válido.',
        ];
    }
} 