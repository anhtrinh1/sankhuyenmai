<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if($this->request->get('flagUpdate')==null){
            return [
            //shop
            'txtIdCategory' => 'required|unique:category,id_category', 
            'txtNameCategory' => 'required',
            'txtIcon' => 'required|max:50',
            ];
        }else{
            return [
            //shop
            'txtIdCategory' => 'required', 
            'txtNameCategory' => 'required',
            'txtIcon' => 'required|max:50',
            ];
        }
        
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'unique'=>':attribute đã tồn tại',
            'max'=>':attribute tối đa 50 kí tự'
        ];
    }
    public function attributes(){
        return [
            'txtIdCategory'=>'Mã danh mục',
            'txtNameCategory'=>'Tên danh mục',
            'txtIcon'=>'Icon'
        ];
    }
}
