<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'selectIdShop' => 'required',
            'selectIdCategory' => 'required',
            'selectIdType' => 'required',
            'txtTitle' => 'required',
            'startDay' => 'required|date|before_or_equal:endDay',
            'endDay' => 'required|date|after_or_equal:startDay',
            'txtLink' => 'required|url',
            'txtLinkImg' => 'required',
            'txtNote'=>'max:255',

        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'unique'=>':attribute đã tồn tại',
            'url'=>':attribute là đường dẫn của hình ảnh',
            'date'=>':attribute là ngày tháng năm',
            'max'=>':attribute không được quá 255 ký tự',
            'before_or_equal'=>':attribute phải trước hoặc bằng ngày kết thúc',
            'after'=>':attribute phải bằng hoặc sau ngày bắt đầu',
        ];
    }
    public function attributes(){
        return [
            'seletcIdShop'=>'Shop',
            'selectIdType'=>'Loại khuyến mãi',
            'selectIdCategory'=>'Danh Mục',
            'txtTitle'=>'Tiêu đề',
            'startDay'=>'Ngày Bắt đầu',
            'endDay'=>'Ngày kết thúc',
            'txtLink'=>'Link sản phẩm',
            'txtNote'=>'Lưu ý',
            'txtLinkImg' => 'Link ảnh',

        ];
    }
     
}
