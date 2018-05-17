<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ShopRequest;
use App\Http\Requests\CouponRequest;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\TypeRequest;
use App\Http\Requests\TypeNewsRequest;
use App\Coupon;
use App\Category;
use App\Shop;
use App\Type;
use App\TypeNews;
use App\News;
use App\NewsShop;
use App\Visit;
use App\Online;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $online = new Online;
        $on = $online -> getOnline();

        $coupon = new Coupon;
        $coupon -> updateDispEnd();

        $visit = new Visit;
        $visitAll = $visit ->getVisit();
        $visitYear = $visit ->getVisitYear(null);
        return view('home.home',compact('on','visitAll','visitYear'));
    }
/*shop*/
    public function showShop()
    {
        $action = "addNewShop";
         $shop = Shop :: select('*')->paginate(10);
         return view('home.shop',compact('shop','action'));
    }
    public function addNewShop(Request $request,ShopRequest $shopRequest)
    {   
        $shop = new Shop;
        $shop->id_shop = $request->txtIdShop;
        $shop->name = $request->txtNameShop;
        $shop->id_user_create =  $request->user()->id;
        $shop->top = $request->txtTop;
        if($shop->top != null)
            $shop->top = true;
        else $shop->top = false;
        $shop->logo = $request->txtLogo;
        $shop->save();
        return redirect(route('show-shop'))
        ->with('status', 'Thêm mới thành công shop: '.$request->txtNameShop);
    }
    public function getEditShop($id)
    {

        $action = "editShop";
        $disabled = "disabled";
        $dataEdit = Shop :: select('*')->where('id_shop', '=', $id)->first();
        $shop = Shop :: select('*')->paginate(10);
        return view('home.shop',compact('dataEdit','shop','action','disabled'));

    }
    public function postEditShop(Request $request, ShopRequest $shopRequest)
    {
        $id_shop = $request->txtIdShop;
        $name = $request->txtNameShop;
        $top = $request->txtTop;
        $logo = $request->txtLogo;
        if($top != null)
            $top = true;
        else $top = false;
        Shop :: where('id_shop', $id_shop)
        ->update(['name' => $name, 'updated_at'=> now(),'top'=>$top,'logo'=>$logo] );
        return redirect(route('show-shop'))->with('status', 'Cập nhật thành công shop: '.$request->txtNameShop);
    }
    public function getDeleteShop(Request $request,$id,$name)
    {
       DB::table('shop')->where('id_shop', '=', $id)->delete();
       return redirect(route('show-shop'))->with('status', 'Xoá thành công shop: '.$name);
   }
/*coupon*/
   public function showCoupon()
   {
    $action_coupon = "addNewCoupon";
    $action_cate = "addNewCategory";
    $coupon = DB::table('coupon')
    ->join('category', 'coupon.id_category', '=', 'category.id_category')
    ->join('users', 'coupon.id_user_create', '=', 'users.id')
    ->join('shop','shop.id_shop', '=','coupon.id_shop')
    ->leftJoin('users as us', 'us.id', '=', 'coupon.id_user_update')
    ->select('users.id','users.name as name_user','us.name as name_user_update', 'coupon.id','coupon.link', 'coupon.title','coupon.start_day','coupon.end_day','coupon.notes','coupon.coupon_code','coupon.number_click','category.name as name_category','shop.name as name_shop')->paginate(10);
    $category =  Category :: all() -> toArray() ;
    $shop = Shop :: all()->toArray();
    $type = Type :: all()->toArray();
    return view('home.coupon',compact('coupon','action_coupon','action_cate','category','shop','type'));
    }
    public function addNewCoupon(Request $request,CouponRequest $couponRequest)
    {

        $coupon = new Coupon;
        $coupon->title = $request->txtTitle;
        $coupon->start_day = $request->startDay;
        $coupon->end_day = $request->endDay;
        $coupon->coupon_code = $request->txtCouponCode;
        $coupon->notes = $request->txtNote;
        $coupon->id_category = $request->selectIdCategory;
        $coupon->id_shop = $request->selectIdShop;
        $coupon->link = $request->txtLink;
        $coupon->percent =$request->txtPercent;
        $coupon->link_img = $request->txtLinkImg;
        $coupon->id_type = $request->selectIdType;
        $coupon->id_user_create = $request->user()->id;
        $display = $request->txtDisplay;
        $display == null ? $display = false : $display = true;
        $coupon->display = $display;
        $coupon->save();
        return redirect(route('show-coupon'))->with('status', 'Thêm mới thành công coupon: '.$request->txtTitle);
    }
    public function getEditCoupon($id)
    {
        $action_coupon = "addNewCoupon";
        $action_cate = "addNewCategory";
        $action_coupon_edit = "editCoupon";
        $disabled = "disabled";
        $coupon = DB::table('coupon')
        ->join('category', 'coupon.id_category', '=', 'category.id_category')
        ->join('users', 'coupon.id_user_create', '=', 'users.id')
        ->join('shop','shop.id_shop', '=','coupon.id_shop')
        ->leftJoin('users as us', 'us.id', '=', 'coupon.id_user_update')
        ->select('users.id','users.name as name_user','us.name as name_user_update' ,'coupon.id','coupon.link', 'coupon.title','coupon.start_day','coupon.end_day','coupon.notes','coupon.coupon_code','coupon.number_click','category.name as name_category','shop.name as name_shop')->paginate(10);
        $shop = Shop :: select('id_shop','name')->get()->toArray() ;
        $category =  Category :: all() -> toArray() ;
        $type = Type :: all()->toArray();
        $dataEditCoupon = DB::table('coupon')
        ->join('category', 'coupon.id_category', '=', 'category.id_category')
        ->join('users', 'coupon.id_user_create', '=', 'users.id')
        ->join('shop','shop.id_shop', '=','coupon.id_shop')
        ->join('type','type.id', '=','coupon.id_type')
        ->where('coupon.id','=',$id)
        ->select('users.id','users.name as name_user', 'coupon.id as id_coupon','coupon.link', 'coupon.title','coupon.start_day','coupon.end_day','coupon.notes','coupon.coupon_code','coupon.number_click','coupon.link_img','coupon.display','percent','category.id_category','category.name as name_category','shop.id_shop','shop.name as name_shop',
            'type.id as id_type','type.name as name_type')->get()->first();
        return view('home.coupon',compact('dataEditCoupon','coupon','shop','category','action_coupon','action_cate','action_coupon_edit','disabled','type'));

    }
    public function postEditCoupon(Request $request, CouponRequest $couponRequest)
    {
        $couponRequest = new CouponRequest;
        $id = $request->txtIdCoupon;
        $title = $request->txtTitle;
        $start_day = $request->startDay;
        $end_day = $request->endDay;
        $coupon_code = $request->txtCouponCode;
        $link_img = $request->txtLinkImg;
        $link = $request->txtLink;
        $percent =$request->txtPercent;
        $notes = $request->txtNote;
        $id_category = $request->selectIdCategory;
        $id_shop = $request->selectIdShop;
        $id_type = $request->selectIdType;
        $id_user = $request->user()->id;
        $display = $request->txtDisplay;
        $display == null ? $display = false : $display = true;
        DB::table('coupon')
        ->where('id', $id)
        ->update([ 'title' => $title,'start_day'  => $start_day,'end_day' => $end_day,'coupon_code' => $coupon_code, 'link' => $link,'notes'=> $notes ,'id_category' =>$id_category,'id_shop' => $id_shop ,'id_user_update'=>$id_user, 'updated_at'=> now(),'id_type'=>$id_type,'percent'=>$percent,'display'=>$display]);
        return redirect(route('show-coupon'))->with('status', 'Cập nhật thành công coupon: '.$title);
    }
    public function getDeleteCoupon(Request $request,$id,$name)
    {
       Coupon :: where('id', '=', $id)->delete();
       return redirect(route('show-coupon'))->with('status', 'Xoá thành công coupon: '.$name);
    }
/*category*/
    public function showCategory()
    {
        $action_cate = "addNewCategory";
        $category =  Category :: all() -> toArray() ;
        return view('home.category',compact('action_cate','category'));
    }
    public function addNewCategory(CategoryRequest $request)
    {
        $category = new Category;
        $category->id_category = $request->txtIdCategory;
        $category->name = $request->txtNameCategory;
        $category->id_user_create = $request->user()->id;
        $category->icon_class = $request->txtIcon;
        $category->save();
        return redirect(route('show-category'))->with('status', 'Thêm mới thành công category: '.$request->txtNameCategory);
    }
    public function getEditCategory($id)
    {
        $action_coupon = "addNewCoupon";
        $action_cate = "addNewCategory";
        $action_cate_edit = "editCategory";
        $coupon = DB::table('coupon')
        ->join('category', 'coupon.id_category', '=', 'category.id_category')
        ->join('users', 'coupon.id_user_create', '=', 'users.id')
        ->join('shop','shop.id_shop', '=','coupon.id_shop')
        ->select('users.id','users.name as name_user', 'coupon.id','coupon.link', 'coupon.title','coupon.start_day','coupon.end_day','coupon.notes','coupon.coupon_code','coupon.number_click','category.name as name_category','shop.name as name_shop')->get()->toArray();
        $shop = Shop :: select('id_shop','name')->get()->toArray() ;
        $category =  Category :: all() -> toArray() ;
        $dataEditCategory = DB::table('category')
        ->where('category.id_category','=',$id)
        ->select( '*')->get()->first();
        return view('home.category',compact('dataEditCategory','category','action_cate','action_cate_edit','disabled'));

    }
    public function postEditCategory(CategoryRequest $request)
    {
        $id_category = $request->input('txtIdCategory') ;
        $name = $request->txtNameCategory;
        $icon_class = $request->txtIcon;
        DB::table('category')
        ->where('id_category', $id_category)
        ->update(['name' => $name,'icon_class' =>$icon_class, 'updated_at'=> now()]);

        return redirect(route('show-category'))->with('status', 'Cập nhật thành công category: '.$name);
    }
    public function getDeleteCategory(Request $request,$id,$name)
    {

       DB::table('category')->where('id', '=', $id)->delete();
       return redirect(route('show-category'))->with('status', 'Xoá thành công category: '.$name);
    }
/*type*/
    public function showType()
    {
        $action = "addNewType";
        $type = Type :: select('*')->get()->toArray() ;
        return view('home.type',compact('type','action'));
    }
    public function addNewType(TypeRequest $request)
    {
        $type = new Type;
        $type->name = $request->txtNameType;
        $type->id = $request->txtIdType;
        $type->id_user_create =  $request->user()->id;
        $type->save();
        return redirect(route('show-type'))->with('status', 'Thêm mới thành công type: '.$request->txtNameType);
    }

    public function getEditType($id)
    {

        $action = "editType";
        $disabled = "disabled";
        $dataEdit = Type :: select('*')->where('id', '=', $id)->first();
        $type = Type :: select('*')->get()->toArray() ;
        return view('type',compact('dataEdit','type','action','disabled'));

    }
    public function postEditType(TypeRequest $request)
    {
        $id = $request->txtIdType;
        $name = $request->txtNameType;
        DB::table('type')
        ->where('id', $id)
        ->update(['name' => $name, 'updated_at'=> now(), 'id_user_update' =>$request->user()->id]);
        return redirect(route('show-type'))->with('status', 'Cập nhật thành công type: '.$request->txtNameType);
    }
    public function getDeleteType(Request $request,$id,$name)
    {

       DB::table('type')->where('id', '=', $id)->delete();
       return redirect(route('show-type'))->with('status', 'Xoá thành công type: '.$name);
    }
/*type new*/
    public function showTypeNew()
    {
        $action = "addNewType";
        $type = TypeNews :: select('*')->get()->toArray() ;
        return view('home.type_news',compact('type','action'));
    }
    public function addNewTypeNew(TypeRequest $request)
    {
        $type = new TypeNews;
        $type->name = $request->txtNameType;
        $type->id = $request->txtIdType;
        $type->icon_class = $request->txtIconClass;
        $type->id_user_create =  $request->user()->id;
        $type->save();
        return redirect(route('show-type-new'))->with('status', 'Thêm mới thành công type: '.$request->txtNameType);
    }

    public function getEditTypeNew($id)
    {

        $action = "editType";
        $disabled = "disabled";
        $dataEdit = TypeNews :: select('*')->where('id', '=', $id)->first();
        $type = TypeNews :: select('*')->get()->toArray() ;
        return view('home.type_news',compact('dataEdit','type','action','disabled'));

    }
    public function postEditTypeNew(TypeRequest $request)
    {
        $id = $request->txtIdType;
        $name = $request->txtNameType;
        $icon_class = $request->txtIconClass;
        DB::table('type_news')
        ->where('id', $id)
        ->update(['name' => $name, 'updated_at'=> now(), 'id_user_update' =>$request->user()->id,'icon_class'=>$icon_class]);
        return redirect(route('show-type-new'))->with('status', 'Cập nhật thành công type: '.$request->txtNameType);
    }
    public function getDeleteTypeNew(Request $request,$id,$name)
    {

       DB::table('type_news')->where('id', '=', $id)->delete();
       return redirect(route('show-type-new'))->with('status', 'Xoá thành công type: '.$name);
    }
/*new*/
    public function conectionCkfinder($value='')
    {
        require_once public_path('/ckfinder/core/connector/php/connector.php');
    }   
    public function showNews()
    {        
        $action = "addNewNews";
        $category =  Category :: all() -> toArray() ;
        $shop = Shop :: select('id_shop','name')->get()->toArray() ;
        $news = News :: paginate(10);
        $typeNew = TypeNews :: select('id','name')->get()->toArray() ;
        return view('home.news',compact('action','news','typeNew','category','shop'));
    }

    public function showCkfinder()
    {
        return view('ckfinder');
    }

    public function addNewNews(NewsRequest $request)
    {
        $title = $request->txtTitle;
        $content = htmlentities($request->txtContent);
        $id_user_create =  $request->user()->id;
        $id_category = $request->txtCategory;
        $link_img = $request->txtLinkImg;
        $new_feed = $request->txtNewFeed;
        $id_type_new = $request->txtTypeNew;
        $new_feed == null ? $new_feed = false : $new_feed = true;
        $display = $request->txtDisplay;
        $display == null ? $display = false : $display = true;
        $description = $request->txtDescription;

        $id = News::insertGetId(['title'=>$title,'content' =>$content, 'id_user_create' =>$id_user_create, 'id_category' => $id_category,'created_at' => now(),'updated_at' => now(),'news_feed'=>$new_feed,'display'=>$display,'link_img'=>$link_img,'id_type_new'=>$id_type_new,'description'=>$description]);
        $shop = $request->input('txtShop');
        foreach ($shop as $value) {
         $news_shop = new NewsShop;
         $news_shop->id_news = $id;
         $news_shop->id_shop = $value;
         $news_shop->save();
     }

     return redirect(route('show-news'))->with('status', 'Thêm mới thành công news: '.$title);
    }

    public function getEditNews($id)
    {
        $action = "editNews";
        $disabled = "disabled";
        $dataEdit = DB :: table('news')->join('category','news.id_category', '=', 'category.id_category')->join('type_news','type_news.id','=','news.id_type_new')->select('news.id', 'news.title','news.content','news.link_img','news.views','news.news_feed','news.display','news.id_category','news.id_type_new','news.id_user_create','news.id_user_update','news.description','category.id_category','category.name','type_news.name as name_type_new')->where('news.id', '=', $id)->first();
        $news = News :: select('*')->paginate(10) ;
        $shop = Shop :: select('id_shop','name')->get()->toArray() ;
        $category =  Category :: all() -> toArray() ;
        $news_shop =  Shop :: join('new_shop','new_shop.id_shop','=','shop.id_shop')->select('shop.id_shop', 'name')->where('id_news', '=', $id)->get()->toArray();
        $shop = $this->arrRemoveThesame($shop,$news_shop);
        $typeNew = TypeNews :: select('id','name')->get()->toArray() ;
        return view('home.news',compact('dataEdit','typeNew','news','action','disabled','shop','category','news_shop'));
    }

    public function postEditNews(NewsRequest $request)
    {
        $action ='addNewNews';
        $id = $request->txtId;
        $title = $request->txtTitle;
        $content = htmlentities($request->txtContent);
        $id_user_update =  $request->user()->id;
        $id_category = $request->txtCategory;
        $display = $request->txtDisplay;
        $new_feed = $request->txtNewFeed;
        $id_type_new = $request->txtTypeNew;
        $new_feed == null ? $new_feed = false : $new_feed = true;
        $link_img = $request->txtLinkImg;
        $description = $request->txtDescription;
        if($display != null)
            $display = true;
        else $display = false;
        DB::table('news')
        ->where('id', $id)
        ->update(['title' => $title,'content' => $content, 'updated_at'=> now(), 'id_user_update'=> $id_user_update,'display'=>$display,'news_feed'=>$new_feed,'link_img'=>$link_img,'id_type_new'=>$id_type_new,'description'=>$description]);

        NewsShop :: where('id_news',$id)->delete();
        $shop = $request->input('txtShop');
        foreach ($shop as $value) {
         $news_shop = new NewsShop;
         $news_shop->id_news = $id;
         $news_shop->id_shop = $value;
         $news_shop->save();
     }

     return redirect(route('show-news'))->with('status', 'Cập nhật thành công news: '.$title);
    }

    public function getDeleteNew(Request $request,$id,$name)
    {
       news :: where('id', '=', $id)->delete();
       NewsShop :: where('id_news',$id)->delete();
       return redirect(route('show-news'))->with('status', 'Xoá thành công news: '.$name);
    }
    public function checkTheSame($a , $b){
        $ckeck = false;
        foreach ($a as $value) {
           if($value['id_shop']==$b){
            return true;
        }
    }
    return $ckeck;
    }
    public function arrRemoveThesame($a, $b){
       $arr = array();
       foreach($a as $value){
        if(!$this->checkTheSame($b,$value['id_shop'])){
            array_push($arr, $value);
        } 
      }
    return  $arr;
    }
}
