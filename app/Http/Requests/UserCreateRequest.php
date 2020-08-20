<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

        public function messages()
    {
        return [
            'name.required' => 'Ell :attribute es obligatorio.',

        ];

    }

    public function attributes()
    {
        return [
            'name' => 'nombre del usuario',
        ];
    }
}
