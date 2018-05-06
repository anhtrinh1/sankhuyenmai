<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeNewsRequest extends FormRequest
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
            'txtNameType' => 'required',
            'txtIdType' => 'required|unique:type,id',
            'txtIcon' => 'max:50'
            ];
        }else{
            return [
            //shop
            'txtIdType' => 'required', 
            'txtNameType' => 'required',
            'txtIcon' => 'max:50'
            ];
        }
        
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'unique'=>':attribute đã tồn tại',
            'max'=> ':attribute tối đa 50 ký tự'
        ];
    }
    public function attributes(){
        return [
            'txtIdType'=>'Mã loại',
            'txtNameType'=>'Tên loại',
            'txtIcon' => 'icon'
        ];
    }
}
