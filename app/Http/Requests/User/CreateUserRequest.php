<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            // 'rol_id' => ['required', 'string'],
            'number_id' => ['required', 'unique:users,number_id'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ];
    }

    public function messages()
    {
        return [
            'rol_id.required' => 'El rol es requerido',
            'number_id.required' => 'El documento es requerido',
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
            'password.confirmed' => 'La contraseña no coincide',
        ];
    }
}
