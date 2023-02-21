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
            'name' => ['required', 'string'],
            'image' => ['required', 'file'],
        ];
    }
    public function messages()
	{
		return [


			'name.required' => 'El nombre de la categoria  es requerido.',
			'image.required' => 'imagen es requerida',


		];
	}
}
