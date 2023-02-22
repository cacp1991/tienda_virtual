<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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


			'name.required' => 'Defina una categoria',

		];
	}
}
