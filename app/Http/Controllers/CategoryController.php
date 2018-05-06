<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\Shop;
 
class CategoryController extends Controller
{
   
   public function getData(Request $request)
   {
	   	$mytime =  now();
// echo $mytime->toDateTimeString()."<br>";
// echo now()->toDateString();
	   	echo Str::ascii("Giảm 15% khi mua các sản phẩm chăm sóc tóc tại Lazada",'en');

   }
}
