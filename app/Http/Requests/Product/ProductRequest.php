<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            // 'image' => ['required', 'file'],
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],

        ];
    }
     public function messages()
     {
        return [
            'category_id.required' => 'Categoria es necesaria',
            'category.integer' => 'la categoria no es  válido',

            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre no es válido',

            'description.required' => 'La descripcion  es requerida',
            'description.string' => 'la descripcion no es válida',

            'price.required' => 'el precio es requerido',
            'price.string' => 'El precio no es válido',

            'stock.required' => 'La cantidad es requerida',
            'stock.string' => 'El stock no es válido',
        ];
     }

}
