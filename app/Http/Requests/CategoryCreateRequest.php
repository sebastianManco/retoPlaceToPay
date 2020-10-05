<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
          'name' => 'required|alpha|min:3|max:40'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.alpha' => 'El :attribute debe ser sólo texto.',
            'name.max' => 'el :attribute es demaciado largo.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre de la categoría'
        ];
    }
}
