<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Coupon;
use App\Category;
use App\Shop;
use App\Type;
use App\News;
use App\NewsShop;
use App\Visit;
use App\Online;
use App\TypeNews;
use App\Search;

class AppController extends Controller
{
	public function visit($request)
	{
		$session_visit =$request->session()->get('session_visit');
		$ip = $request->ip();
		if($session_visit==null){
			session_start();
			$session_visit = session_id();
			$request->session()->put('session_visit',$session_visit);
			$visit = new Visit;
			$visit->setVisit($session_visit,$ip);
			$online = new Online;
			$online->setOnline($session_visit,$ip);
		}else{
			$visit = new Visit;
			$visit->setVisit($session_visit,$ip);
			$online = new Online;
			$online->setOnline($session_visit,$ip);
		}
	}
    public function welcome(Request $request)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

    	$title = "Mã giảm giá, tin khuyến mãi, thông tin về sản phẩm hot - Săn Khuyến Mãi";
    	$titleH1 = ["Săn Khuyến Mãi","Mã giảm giá, tin khuyến mãi, thông tin về sản phẩm hot"];
    	$this->visit($request);
    	$Shop = new Shop;
    	$shopTop = $Shop->getTopShop();
    	$shopTag = $Shop->getShopForTag();

    	$Category = new Category;
    	$category = $Category->getCategory();

    	$News = new News;
    	$tinTuc = $News->getTopTinTuc();
    	$kn = $News->getTopKN();
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

    	$Coupon = new Coupon;
    	$coupon = $Coupon->getCoupon();
    	return view('welcome',compact('title','titleH1','tinTuc','shopTop','kn','replace','typeNew','topNews','shopTag','category','coupon'));
    }
    public function getACoupon(Request $request,$id)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

        $this->visit($request);
        $Shop = new Shop;
        $shopTop = $Shop->getTopShop();
        $shopTag = $Shop->getShopForTag();

        $Category = new Category;
        $category = $Category->getCategory();

        $News = new News;
        $tinTuc = $News->getTopTinTuc();
        $kn = $News->getTopKN();
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

        $Coupon = new Coupon;
        $coupon = $Coupon->getACoupon($id);
        if(count($coupon)>0){
            $title = $coupon[0]->title." - Săn Khuyến Mãi";
            $titleH1 = ["Săn Khuyến Mãi",$coupon[0]->title];
        }else{
            $title = "Mã giảm giá, tin khuyến mãi, thông tin về sản phẩm hot - Săn Khuyến Mãi";
            $titleH1 = ["Săn Khuyến Mãi","Mã giảm giá, tin khuyến mãi, thông tin về sản phẩm hot"];
            $status = "Mã giảm giá, tin khuyến mãi đã hết hạn - vui lòng chọn tìm thông tin khác!";
            $coupon = $Coupon->getCoupon();
        }   

        return view('welcome',compact('shopTop','shopTag','category','coupon','title','titleH1','tinTuc','kn','replace','typeNew','topNews','status'));
    }

    public function welcomeShop(Request $request,$idShop,$nameShop)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

    	$this->visit($request);
    	$Shop = new Shop;
    	$shopTop = $Shop->getTopShop();
    	$shopTag = $Shop->getShopForTag();

    	$Category = new Category;
    	$category = $Category->getCategory();

    	$News = new News;
    	$tinTuc = $News->getTopTinTuc();
    	$kn = $News->getTopKN();
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

    	$Coupon = new Coupon;
    	$coupon = $Coupon->getCouponOfShop($idShop);
    	$toMonth = date("m-Y");

    	if($coupon!=null){
    		$title = "Mã giảm giá, tin khuyến mãi của ".$nameShop." tháng ".$toMonth." - Săn Khuyến Mãi";
    		$titleH1 = ["Săn Khuyến Mãi","Mã giảm giá, tin khuyến mãi của ".$nameShop." tháng ".$toMonth];
    	}else{
    		$title = "Mã giảm giá, tin khuyến mãi của ".$nameShop." tháng ".$toMonth." - Săn Khuyến Mãi";
    		$titleH1 = ["Săn Khuyến Mãi","Chúng tôi sẽ cập nhật sớm nhất mã giảm giá ".$nameShop];
    		$status = "Mã giảm giá, thông tin khuyến mãi của shop ".$nameShop." đã hết hạn hoặc chưa có thông tin mới, Chúng tôi sẽ cập nhật sớm nhất!";
    		$coupon = $Coupon->getCoupon();
    	}  	
    	return view('welcome',compact('shopTop','shopTag','category','coupon','title','titleH1','tinTuc','kn','status','replace','typeNew','topNews'));
    }
    public function welcomeShopAll(Request $request)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

    	$this->visit($request);
    	$Shop = new Shop;
    	$shopAll = $Shop->getShopAll();
    	$shopTop = $Shop->getTopShop();
    	$shopTag = $Shop->getShopForTag();
    	$shopFilter = $Shop->getNameFilter();

    	$Category = new Category;
    	$category = $Category->getCategory();

    	$News = new News;
    	$tinTuc = $News->getTopTinTuc();
    	$kn = $News->getTopKN();
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

    	$title = "Danh sách tất cả các shop - Săn Khuyến Mãi";
    	$titleH1 = ["Săn Khuyến Mãi","Danh sách tất cả các shop"];
    	
    	return view('welcome',compact('shopFilter','shopAll','shopTop','shopTag','category','title','titleH1','tinTuc','kn','replace','typeNew','topNews'));
    }
    public function welcomeShopAllFilter(Request $request,$filter)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

    	$this->visit($request);
    	$Shop = new Shop;
    	$shopAll = $Shop->getShopAll();
    	$shopTop = $Shop->getTopShop();
    	$shopTag = $Shop->getShopForTag();
    	$shopFilter = $Shop->getNameFilter();

    	$collection = collect($shopAll);
    	$filtered = $collection->where('filter', $filter);
		$shopAll= $filtered->all();

    	$Category = new Category;
    	$category = $Category->getCategory();

    	$News = new News;
    	$tinTuc = $News->getTopTinTuc();
    	$kn = $News->getTopKN();   
        $topNews = $News->getNewsFeed(); 

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

    	$title = "Danh sách tất cả các shop - Săn Khuyến Mãi";
    	$titleH1 = ["Săn Khuyến Mãi","Danh sách tất cả các shop"];
    	
    	return view('welcome',compact('shopFilter','shopAll','shopTop','shopTag','category','title','titleH1','tinTuc','kn','replace','typeNew','topNews'));
    }
/*category*/
    public function welcomeCategory(Request $request,$idCategory,$categoryName)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

    	$this->visit($request);
    	$Shop = new Shop;
    	$shopTop = $Shop->getTopShop();
    	$shopTag = $Shop->getShopForTag();

    	$Category = new Category;
    	$category = $Category->getCategory();

    	$News = new News;
    	$tinTuc = $News->getTopTinTuc();
    	$kn = $News->getTopKN();
        $topNews = $News->getNewsFeed();

    	$Coupon = new Coupon;
    	$coupon = $Coupon->getCouponOfCategory($idCategory);
    	$toMonth = date("m-Y");

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

    	if($coupon!=null){
    		$title = "Mã giảm giá, tin khuyến mãi danh mục ".$categoryName." tháng ".$toMonth." - Săn Khuyến Mãi";
    		$titleH1 = ["Săn Khuyến Mãi","Mã giảm giá, tin khuyến mãi danh mục ".$categoryName." tháng ".$toMonth];
    	}else{
    		$title = "Mã giảm giá, tin khuyến mãi danh mục ".$categoryName." tháng ".$toMonth." - Săn Khuyến Mãi";
    		$titleH1 = ["Săn Khuyến Mãi","Chúng tôi sẽ cập nhật sớm nhất mã giảm giá danh mục ".$categoryName];
    		$status = "Mã giảm giá, thông tin khuyến mãi danh mục ".$categoryName." đã hết hạn hoặc chưa có thông tin mới, Chúng tôi sẽ cập nhật sớm nhất!";
    		$coupon = $Coupon->getCoupon();
    	}
    	
    	return view('welcome',compact('shopTop','shopTag','category','coupon','title','titleH1','tinTuc','kn','status','replace','typeNew','topNews'));
    }
    public function welcomeCategoryAll(Request $request)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

    	$this->visit($request);
    	$Shop = new Shop;
    	$shopTop = $Shop->getTopShop();
    	$shopTag = $Shop->getShopForTag();

    	$Category = new Category;
    	$category = $Category->getCategory();
    	$categoryAll = $Category->getCategory();

    	$News = new News;
    	$tinTuc = $News->getTopTinTuc();
    	$kn = $News->getTopKN();
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

    	$title = "Danh sách tất cả các danh mục - Săn Khuyến Mãi";
    	$titleH1 = ["Săn Khuyến Mãi","Danh sách tất cả các danh mục"];
    	
    	return view('welcome',compact('shopTop','shopTag','category','categoryAll','title','titleH1','tinTuc','kn','replace','typeNew','topNews'));
    }
/*news*/
    public function welcomeNew(Request $request,$idNews)
    { 
        /*khai bao su dung replace title*/
        $replace = new Str;

        $this->visit($request);
        $Shop = new Shop;
        $shopTop = $Shop->getTopShop();
        $shopTag = $Shop->getShopForTag();

        $Category = new Category;
        $category = $Category->getCategory();

        $News = new News;
        $tinTuc = $News->getTopTinTuc();
        $kn = $News->getTopKN();
        $new = $News->getNew($idNews);
        $topNews = $News->getNewsFeed();


        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

        $toMonth = date("m-Y");
        if(count($new)>0){
            $title = $new[0]->title;
            $titleH1 = ["Săn Khuyến Mãi",$title = $new[0]->title];
        }else{
            $title = "Thông tin không tìm thấy - Săn Khuyến Mãi";
            $titleH1 = ["Săn Khuyến Mãi","Thông tin không tồn tại"];
            $status = "Tin đã được xoá hoặc không được phép hiện thị!";
        }
        
        return view('welcome',compact('shopTop','shopTag','category','new','title','titleH1','tinTuc','kn','status','replace','typeNew','topNews'));
    }
    public function welcomeNews(Request $request)
    { 
        /*khai bao su dung replace title*/
        $replace = new Str;

        $this->visit($request);
        $Shop = new Shop;
        $shopTop = $Shop->getTopShop();
        $shopTag = $Shop->getShopForTag();

        $Category = new Category;
        $category = $Category->getCategory();

        $News = new News;
        $tinTuc = $News->getTopTinTuc();
        $kn = $News->getTopKN();
        $newAll = $News->getNews();
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

        $toMonth = date("m-Y");
        if(count($newAll)>0){
            $title = "Tin tức sản phẩm - kinh nghiệm mua hàng - Săn Khuyến Mãi";
            $titleH1 = ["Săn Khuyến Mãi","Tin Tức Kinh Nghiệm"];
        }else{
            $title = "Thông tin không tìm thấy - Săn Khuyến Mãi";
            $titleH1 = ["Săn Khuyến Mãi","Thông tin không tồn tại"];
            $status = "Trang đã được xoá hoặc không được phép hiện thị!";
        }
        
        return view('welcome',compact('shopTop','shopTag','category','newAll','title','titleH1','tinTuc','kn','status','replace','typeNew','topNews'));
    }
        public function welcomeTypeNews(Request $request,$idNewType)
    { 
        /*khai bao su dung replace title*/
        $replace = new Str;

        $this->visit($request);
        $Shop = new Shop;
        $shopTop = $Shop->getTopShop();
        $shopTag = $Shop->getShopForTag();

        $Category = new Category;
        $category = $Category->getCategory();

        $News = new News;
        $tinTuc = $News->getTopTinTuc();
        $kn = $News->getTopKN();
        $newAll = $News->getNewsType($idNewType);
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

        $toMonth = date("m-Y");
        if(count($newAll)>0){
            $title = "Tin tức sản phẩm - kinh nghiệm mua hàng - Săn Khuyến Mãi";
            $titleH1 = ["Săn Khuyến Mãi","Tin Tức Kinh Nghiệm"];
        }else{
            $title = "Thông tin không tìm thấy - Săn Khuyến Mãi";
            $titleH1 = ["Săn Khuyến Mãi","Thông tin không tồn tại"];
            $status = "Trang đã được xoá hoặc không được phép hiện thị!";
        }
        
        return view('welcome',compact('shopTop','shopTag','category','newAll','title','titleH1','tinTuc','kn','status','replace','typeNew','topNews'));
    }
/*tim kiem*/        
    public function search(Request $request)
    {
        /*khai bao su dung replace title*/
        $replace = new Str;

        $title = "Mã giảm giá, tin khuyến mãi, thông tin về sản phẩm hot - Săn Khuyến Mãi";
        $titleH1 = ["Săn Khuyến Mãi","Mã giảm giá, tin khuyến mãi, thông tin về sản phẩm hot"];
        $this->visit($request);
        $Shop = new Shop;
        $shopTop = $Shop->getTopShop();
        $shopTag = $Shop->getShopForTag();

        $Category = new Category;
        $category = $Category->getCategory();

        $News = new News;
        $tinTuc = $News->getTopTinTuc();
        $kn = $News->getTopKN();
        $topNews = $News->getNewsFeed();

        $TypeNews = new TypeNews;
        $typeNew = $TypeNews->getTypeNews();

        $search = $request->search;

        $Coupon = new Coupon;
        $coupon = $Coupon->getCouponSearch($search);
        //$newAll = $News->getNewsSearch($search);

        $Search = new Search;
        $ip = $request->ip();
        $Search->insertSearch($ip,$search);

        return view('welcome',compact('shopTop','shopTag','category','coupon','title','titleH1','tinTuc','kn','replace','typeNew','topNews'));
    }
    public function ajaxUpdateClick(Request $request,$id)
    {
        $Coupon = new Coupon;
        $coupon = $Coupon->updateNumClick($id);
    }
}
