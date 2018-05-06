<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = ['id', 'title','content','description','link_img','views','news_feed','display','id_category','id_type_new','id_user_create','id_user_update',];

    public function getTopTinTuc()
    {
        $news = News :: select('*')->where([['id_type_new','=','tin-tuc'],['display','=',1]])->orderBy('views','desc')->limit(5)->get();
        return $news;
    }
    public function getTopKN()
    {
        $news = News :: select('*')->where([['id_type_new','=','kinh-nghiem'],['display','=',1]])->orderBy('views','desc')->limit(5)->get();
        return $news;
    }
    public function getNewsFeed()
    {
        $news = News :: select('*')->join('new_shop','new_shop.id_news','=','news.id')
        ->join('shop','new_shop.id_shop','=','shop.id_shop')->where([['news_feed','=',1],['display','=',1]])->get();
    	return $news;
    }
    public function getNews()
    {
        $news = News :: select('*')->where('display','=',1)->paginate(10);
        return $news;
    }
    public function getNewsType($idTypeNew)
    {
        $news = News :: select('*')->where([['display','=',1],['id_type_new','=',$idTypeNew]])->paginate(10);
        return $news;
    }
    public function getNewsSearch($key)
    {
        $news = News :: select('*')->where([['display','=',1],['title','like','%'.$key.'%']])->paginate(10);
        return $news;
    }
    public function getNew($id)
    {
        $news = News :: select('*')->where([['display','=',1],['id','=',$id]])->get();
        return $news;
    }
     
}
