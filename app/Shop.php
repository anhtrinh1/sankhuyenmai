<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
    protected $table = 'shop';

    protected $fillable = ['id_shop', 'name','top','logo','id_user_create','id_user_update',];

    public function getShop()
    {
    	 $shop = Shop :: select('*')->orderBy('name')->get();
    	 return $shop;
    }
    public function getShopAll()
    {
         $shop = Shop :: select('*',DB::raw('SUBSTRING(name,1,1) as filter'))->orderBy('name')->get();
         return $shop;
    }
    public function getNameFilter()
    {
         $shop = Shop :: select(DB::raw('SUBSTRING(name,1,1) as filter'))->orderBy('name')->distinct()->get();
         return $shop;
    }
    public function getTopShop()
    {
    	 $shop = Shop :: select('*')->where('top','=','1')->limit(7)->get();
    	 return $shop;
    }
    
    public function getShopForTag()
    {
         $shop = Shop :: select(DB::raw('shop.id_shop,shop.name,COUNT(shop.id_shop) as num'))->join('coupon','shop.id_shop','=','coupon.id_shop')->groupBy('shop.id_shop','shop.name')->get();
         return $shop;
    }
}
