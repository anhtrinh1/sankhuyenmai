<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:sankhuyenmai,users',
            'password' => 'required'
        ];
    }

    public function massage()
    {
        return[ 'email.required' => "Vui lòng nhập email",
                'email.unique' => "Email đã tồn tại",
                'name.required' => "Vui lòng nhập name",
                'password.required' => "Vui lòng nhập password",
          ];
    }
}
