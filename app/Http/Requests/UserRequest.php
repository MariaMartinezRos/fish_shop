<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Obtiene las reglas de validación para la solicitud.
     */
    public function rules(): array
    {
        // Verificamos si es una actualización o una creación de usuario
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$userId,
            'password' => $this->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
            'password2' => $this->isMethod('post') ? 'required|same:password' : 'nullable|same:password',
            'role_id' => 'required|in:1,3,4',
        ];

    }

    /**
     * Mensajes personalizados de validación.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('The name is required.'),
            'email.required' => __('The email is required.'),
            'email.email' => __('You must enter a valid email address.'),
            'email.unique' => __('This email is already in use.'),
            'password.required' => __('The password is required for new users.'),
            'password.min' => __('The password must be at least 8 characters.'),
            'password2.required' => __('You must confirm the password.'),
            'password2.same' => __('The passwords do not match.'),
            'role_id.required' => __('You must select a valid role.'),
//            'role_id.in' => 'El rol seleccionado no es válido.',
        ];
    }
}
