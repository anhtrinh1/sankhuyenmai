<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('test', 'CategoryController@getData')->name('category'); 



Route::prefix('/')->group(function () {
    Route::get('/', 'AppController@welcome')->name('welcome');
    Route::get('shop/{idShop}.html',  'AppController@welcomeShop')->name('welcomeShop');
    Route::get('shop.html',  'AppController@welcomeShopAll')->name('welcomeShopAll');
    Route::get('shop/{filter}.html',  'AppController@welcomeShopAllFilter')->name('welcomeShopAllFilter');

    Route::get('danh-muc/{idCategory}.html',  'AppController@welcomeCategory')->name('welcomeCategory');
    Route::get('danh-muc.html',  'AppController@welcomeCategoryAll')->name('welcomeCategoryAll');

    Route::get('tin-tuc-kinh-nghiem.html',  'AppController@welcomeNews')->name('welcomeNews');
    Route::get('tin-{idNews}/{nameReplaceUtf8}.html',  'AppController@welcomeNew')->name('welcomeNew');
    Route::get('news/{idNewType}.html',  'AppController@welcomeTypeNews')->name('welcomeTypeNews');

    Route::get('tim-kiem.html',  'AppController@search')->name('search');

    Route::get('san-khuyen-mai-{id}/{titlReplaceUtf8}.html',  'AppController@getACoupon')->name('getACoupon');
    Route::get('link-click/{id}',  'AppController@ajaxUpdateClick')->name('ajaxUpdateClick');
    //comment
    Route::post('comment',  'CommentController@comment')->name('comment');

    Route::get('getCommentCoupon/{couponId}',  'CommentController@getCommentCoupon')->name('getCommentCoupon');

    Route::get('getCountCmtCoupon/{couponId}',  'CommentController@getCountCmtCoupon')->name('getCountCmtCoupon');

    Route::get('getSubCommentCoupon/{comntId}',  'CommentController@getSubCmtCoupon')->name('getSubCommentCoupon');
    

    Route::post('loginAjax',  '\App\Http\Controllers\Auth\LoginController@postLogin')->name('ajaxCheckLogin');
    
});

/*HomeController*/
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
//home
Route::group(['prefix' => 'home',  'middleware' => 'role'],function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::prefix('/')->group(function () {
        Route::get('visit-year/{year}', ['as' => 'visit-year','uses'=>'HomeController@vistYear']);
        Route::get('visit-month/{month}', ['as' => 'visit-month','uses'=>'HomeController@vistMont']);
        Route::get('visit-hour/{day}', ['as' => 'visit-day','uses'=>'HomeController@vistDay']);
    });
    //shop
    Route::prefix('shop')->group(function () {

        Route::get('/',['as' => 'show-shop','uses'=>'HomeController@showShop']);
        Route::post('add-new-shop',['as' => 'addNewShop','uses'=>'HomeController@addNewShop']);

        Route::get('edit-shop/{id}','HomeController@getEditShop');
        Route::post('edit-shop',['as' => 'editShop','uses'=>'HomeController@postEditShop']);

        Route::get('delete-shop/{id}/{name}','HomeController@getDeleteShop');
    });
    //Coupon
    Route::prefix('coupon')->group(function () {

        Route::get('/',['as' => 'show-coupon','uses'=>'HomeController@showCoupon']);
        Route::post('add-new-coupon',['as' => 'addNewCoupon','uses'=>'HomeController@addNewCoupon']);

        Route::get('edit-coupon/{id}','HomeController@getEditCoupon');
        Route::post('edit-coupon',['as' => 'editCoupon','uses'=>'HomeController@postEditCoupon']);

        Route::get('delete-coupon/{id}/{name}','HomeController@getDeleteCoupon');
    });

     //Category
    Route::prefix('category')->group(function () {

        Route::get('/',['as' => 'show-category','uses'=>'HomeController@showCategory']);
        Route::post('add-new-category',['as' => 'addNewCategory','uses'=>'HomeController@addNewCategory']);

        Route::get('edit-category/{id}','HomeController@getEditCategory');
        Route::post('edit-category',['as' => 'editCategory','uses'=>'HomeController@postEditCategory']);

        Route::get('delete-category/{id}/{name}','HomeController@getDeleteCategory');

    });
    //type
    Route::prefix('type')->group(function () {

        Route::get('/',['as' => 'show-type','uses'=>'HomeController@showType']);
        Route::post('add-new-type',['as' => 'addNewType','uses'=>'HomeController@addNewType']);

        Route::get('edit-type/{id}','HomeController@getEditType');
        Route::post('edit-type',['as' => 'editType','uses'=>'HomeController@postEditType']);

        Route::get('delete-type/{id}/{name}','HomeController@getDeleteType');

    });
    //type new
    Route::prefix('type-new')->group(function () {

        Route::get('/',['as' => 'show-type-new','uses'=>'HomeController@showTypeNew']);
        Route::post('add-new-type-new',['as' => 'addNewType','uses'=>'HomeController@addNewTypeNew']);

        Route::get('edit-type-new/{id}','HomeController@getEditTypeNew');
        Route::post('edit-type-new',['as' => 'editType','uses'=>'HomeController@postEditTypeNew']);

        Route::get('delete-type-new/{id}/{name}','HomeController@getDeleteTypeNew');

    });
    //news
    Route::prefix('news')->group(function () {
        Route::get('/',['as' => 'show-news','uses'=>'HomeController@showNews']);
        Route::get('ckfinder',['as' => 'show-ckfinder','uses'=>'HomeController@showCkfinder']);

        Route::post('add-new-news',['as' => 'addNewNews','uses'=>'HomeController@addNewNews']);
       
        Route::get('edit-news/{id}','HomeController@getEditNews');
        Route::post('edit-news',['as' => 'editNews','uses'=>'HomeController@postEditNews']);
        Route::get('delete-news/{id}/{name}','HomeController@getDeleteNews');

    });

});
