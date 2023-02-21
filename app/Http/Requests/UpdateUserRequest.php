<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'number_id' => ['required', 'numeric', "unique:users,number_id,{$this->user->id}"],
            'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'email' => ['required', 'email', "unique:users,email,{$this->user->id}"],
			'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'confirm_passowrd' => ['required', 'string'],
			'role' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'number_id.require' => 'El documento es requerido',
            'number_id.string' => 'El documento no es un número',
            'number_id.unique' => 'El documento ya fue tomado',

            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre no es válido',

            'last_name.required' => 'El apellido es requerido',
            'last_name.string' => 'El apellido no es válido',

            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo debe ser valido',
            'email.unique' => 'El correo ya existe',

            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseñadebe ser valida',
            'password.min' => 'La contraseña no cumple el rango solicitado',
            'password.confirmed' => 'La contraseñacoincide',
        ];
    }
}
