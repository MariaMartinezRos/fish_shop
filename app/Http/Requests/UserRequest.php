<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

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

        //        return [
        //            'name' => 'required|string|max:255',
        //            'email' => 'required|email|unique:users,email,'.$userId,
        //            'password' => $this->isMethod('post') ? 'required|min:8' : 'nullable|min:8',
        //            'role_id' => 'required|in:1,3,4',
        //        ];
    }

    /**
     * Mensajes personalizados de validación.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está en uso.',
            'password.required' => 'La contraseña es obligatoria para nuevos usuarios.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password2.required' => 'Debe confirmar la contraseña.',
            'password2.same' => 'Las contraseñas no coinciden.',
            'role_id.required' => 'Debes seleccionar un rol válido.',
            'role_id.in' => 'El rol seleccionado no es válido.',
        ];
    }
}
