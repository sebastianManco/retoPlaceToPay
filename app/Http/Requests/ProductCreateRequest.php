<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
           'name' => 'required|min:1|max:50',
            'description' => 'required|min:1|max:100',
            'category_id' => 'required',
            'price' => 'required||numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'stock' => 'required|numeric|min:1'
       ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ell :attribute es obligatorio.',
            'name.max' => 'el :attribute es demaciado largo.',

            'description.required' => 'La :attribute es obligatoria.',
            'description.max' => 'La :attribute es demaciado larga',

            'category_id.required' => 'seleccione una :attribute.',

            'price.required' => 'El :attribute es obligatorio.',
            'price.numeric' => 'El :attribute de ser sólo numeros.',

            'image.required' => 'La :attribute es obligatoria.',
            'image.mimes' => 'Formatos permitidos jpeg,png,jpg ',

            'stock.required' => 'El :attribute es obligatorio.',
            'stock.numeric' => 'La :attribute de ser sólo numeros.'


        ];
    }

    public function attributes()
    {
        return [
             'name' => 'nombre del producto',
             'description' => 'descripción del producto',
             'category_id' => 'categoría para el producto',
             'price' =>  'precio del producto',
             'image' => 'imagen del producto',
             'stock' =>  'cantidad del producto',
        ];
    }
}
