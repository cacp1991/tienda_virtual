<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => ['required', 'file'],
            'name' => ['required', 'string'],
        ];
    }
    public function messages()
	{
		return [


			'image.required' => 'imagen es requerida',
			'name.required' => 'El nombre de la categoria  es requerido.',


		];
	}
}
