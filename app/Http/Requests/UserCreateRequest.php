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
            'name' => 'required|string|min:3|max:40|alpha_spaces',
            'last_name' => 'required|string|min:3|max:40|alpha_spaces',
            'email' => 'required|string|email|max:100|unique:users,email',
            'phone' => 'required|string|min:5|max:20',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre ',
            'last_name' => 'apellido ',
        ];
    }
}
