<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coupon extends Model
{
    protected $table = 'coupon';

    protected $fillable = ['id', 'title','start_day','end_day','coupon_code','link','number_click','notes','display','link_img','percent','id_category','id_shop','id_type','id_user_create','id_user_update',];

    public function getCoupon()
    {
    	 $coupon = Coupon :: select('coupon.id as id_coupon', 'title','start_day','end_day','coupon_code','link','number_click','notes','display','id_category','percent','shop.id_shop','type.id as id_type','shop.name as name_shop','type.name as name_type',DB::raw('DATEDIFF(end_day,CURRENT_DATE) as numday'))->join('shop','shop.id_shop','=','coupon.id_shop')->join('type', 'type.id', '=', 'coupon.id_type')->where('display','=',1)->orderBy('coupon.created_at','DESC')->paginate(10);
    	 return $coupon;
    }    
    public function getACoupon($id)
    {
         $coupon = Coupon :: select('coupon.id as id_coupon', 'title','start_day','end_day','coupon_code','link','number_click','notes','display','id_category','percent','shop.id_shop','type.id as id_type','shop.name as name_shop','type.name as name_type',DB::raw('DATEDIFF(end_day,CURRENT_DATE) as numday'))->join('shop','shop.id_shop','=','coupon.id_shop')->join('type', 'type.id', '=', 'coupon.id_type')->where([['display','=',1],['coupon.id','=',$id]])->paginate(1);
         return $coupon;
    }   
    public function getCouponOfShop($idShop)
    {
         $coupon = Coupon :: select('coupon.id as id_coupon', 'title','start_day','end_day','coupon_code','link','number_click','notes','display','id_category','percent','shop.id_shop','type.id as id_type','shop.name as name_shop','type.name as name_type',DB::raw('DATEDIFF(end_day,CURRENT_DATE) as numday'))->join('shop','shop.id_shop','=','coupon.id_shop')
         ->join('type', 'type.id', '=', 'coupon.id_type')
         ->where('display','=',1)
         ->where([
                ['display','=',1],
                ['shop.id_shop', '=', $idShop],
            ])->orderBy('coupon.created_at','DESC')
         ->paginate(10);
         return $coupon;
    }  
     public function getCouponOfCategory($idCategory)
    {
         $coupon = Coupon :: select('coupon.id as id_coupon', 'title','start_day','end_day','coupon_code','link','number_click','notes','display','coupon.id_category','percent','shop.id_shop','type.id as id_type','shop.name as name_shop','type.name as name_type',DB::raw('DATEDIFF(end_day,CURRENT_DATE) as numday'),'category.name as name_category')->join('shop','shop.id_shop','=','coupon.id_shop')
         ->join('category','category.id_category','=','coupon.id_category')
         ->join('type', 'type.id', '=', 'coupon.id_type')
         ->where('display','=',1)
         ->where([
                ['display','=',1],
                ['coupon.id_category', '=', $idCategory],
            ])->orderBy('coupon.created_at','DESC')
         ->paginate(10);
         return $coupon;
    }    
    public function getCouponSearch($key)
    {
        if($key!=null)
         $coupon = Coupon :: select('coupon.id as id_coupon', 'title','start_day','end_day','coupon_code','link','number_click','notes','display','id_category','percent','shop.id_shop','type.id as id_type','shop.name as name_shop','type.name as name_type',DB::raw('DATEDIFF(end_day,CURRENT_DATE) as numday'))->join('shop','shop.id_shop','=','coupon.id_shop')->join('type', 'type.id', '=', 'coupon.id_type')->where([['display','=',1],['title','like','%'.$key.'%']])->orderBy('coupon.created_at','DESC')->paginate(10);
        else
            $coupon = Coupon :: select('coupon.id as id_coupon', 'title','start_day','end_day','coupon_code','link','number_click','notes','display','id_category','percent','shop.id_shop','type.id as id_type','shop.name as name_shop','type.name as name_type',DB::raw('DATEDIFF(end_day,CURRENT_DATE) as numday'))->join('shop','shop.id_shop','=','coupon.id_shop')->join('type', 'type.id', '=', 'coupon.id_type')->where('display','=',1)->orderBy('coupon.created_at','DESC')->paginate(10);

         return $coupon;
    } 
    public function updateDispEnd()
	 {
	 	$now =  now()->toDateString();
		Coupon :: where('end_day','<',$now)->update(['display' => 0]);
	 } 
     public function updateNumClick($id)
     {
        Coupon :: where('id','<',$id)->update(['number_click' =>DB::raw('number_click + 1') ]);
     }     
}
