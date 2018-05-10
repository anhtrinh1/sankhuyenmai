<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ShopRequest extends FormRequest
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
            'txtIdShop' => 'required|unique:shop,id_shop', 
            'txtNameShop' => 'required',
            'txtLogo' => 'required',
            'txtDescription' => 'required|max:150',
            ];
        }else{
            return [
            //shop
            'txtIdShop' => 'required', 
            'txtNameShop' => 'required',
            'txtLogo' => 'required',
            'txtDescription' => 'required|max:150',
            ];
        }
        
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'unique'=>':attribute đã tồn tại',
            'url'=>':attribute là đường dẫn của hình ảnh',
            'max:150'=>':attribute không quá 150 ký tự',
        ];
    }
    public function attributes(){
        return [
            'txtIdShop'=>'Mã shop',
            'txtNameShop'=>'Tên shop',
            'txtLogo'=>'Logo shop',
            'txtDescription' => 'Mô tả',
        ];
    }
}
