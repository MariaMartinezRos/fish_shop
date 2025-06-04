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
            'start_date.required' => __('Please select a start date.'),
            'start_date.date' => __('The start date must be a valid date.'),
            'start_date.after' => __('The start date must be after today.'),
            'end_date.required' => __('Please select an end date.'),
            'end_date.date' => __('The end date must be a valid date.'),
            'end_date.after_or_equal' => __('The end date must be after or equal to the start date.'),
            'comments.required' => __('Please provide a reason for your vacation request.'),
            'comments.min' => __('Please provide more details about your vacation request.'),
            'policy_acknowledged.required' => __('You must accept the vacation policy.'),
            'policy_acknowledged.accepted' => __('You must accept the vacation policy.'),
        ];
    }
}
