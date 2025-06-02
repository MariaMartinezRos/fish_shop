<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VacationRequestFormRequest extends FormRequest
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
            'start_date' => [
                'required',
                'date',
                'after:today',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
            'comments' => [
                'required',
                'string',
                'min:10',
            ],
            'policy_acknowledged' => [
                'required',
                'accepted',
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
            'start_date.required' => 'Por favor, selecciona una fecha de inicio.',
            'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'start_date.after' => 'La fecha de inicio debe ser posterior a hoy.',
            'end_date.required' => 'Por favor, selecciona una fecha de fin.',
            'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
            'end_date.after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
            'comments.required' => 'Por favor, proporciona un motivo para tu solicitud de vacaciones.',
            'comments.min' => 'Por favor, proporciona más detalles sobre tu solicitud de vacaciones.',
            'policy_acknowledged.required' => 'Debes aceptar la política de vacaciones.',
            'policy_acknowledged.accepted' => 'Debes aceptar la política de vacaciones.',
        ];
    }
} 