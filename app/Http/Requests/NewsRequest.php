<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'txtShop' => 'required', 
            'txtCategory' => 'required',
            'txtTitle' => 'required|max:191',
            'txtContent' => 'required',
            'txtDescription' => 'required|max:500',
            'txtLinkImg' => 'required|max:191',
            'txtTypeNew' => 'required',
            ];
        
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'max:191'=>':attribute không được quá 191 kí tự',
            'max:500'=>':attribute không được quá 500 kí tự',
        ];
    }
    public function attributes(){
        return [
            'txtShop' => 'Shop', 
            'txtCategory' => 'Danh mục',
            'txtTitle' => 'Tiêu đề',
            'txtContent' => 'Nội dung',
            'txtDescription' => 'Mô tả',
            'txtLinkImg' => 'Link ảnh',
            'txtTypeNew' => 'Loại tin'
        ];
    }
}
