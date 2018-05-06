<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
            ];
        }else{
            return [
            //shop
            'txtIdType' => 'required', 
            'txtNameType' => 'required',
            ];
        }
        
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'unique'=>':attribute đã tồn tại',
        ];
    }
    public function attributes(){
        return [
            'txtIdType'=>'Mã loại',
            'txtNameType'=>'Tên loại',
        ];
    }
}
