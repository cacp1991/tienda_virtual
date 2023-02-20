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
            'number_id' => ['required', 'string', 'unique:users,number_id'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'number_id.require' => 'El documento es requerido',
            'number_id.string' => 'El documento no es un número',
            'number_id.unique' => 'El documento ya fue tomado',

            'name.require' => 'El nombre es requerido',
            'name.string' => 'El nombre no es válido',

            'last_name.require' => 'El apellido es requerido',
            'last_name.string' => 'El apellido no es válido',

            'email.require' => 'El correo es requerido',
            'email.string' => 'El correo debe ser'
        ];
    }
}
