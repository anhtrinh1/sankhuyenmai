<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['cmt_id', 'message','approve','user_id','coupon_id','new_id'];

    public function getComment($newId,$couponId)
    {
    	if($newId!=null)
    	   return Comment::select('cmt_id', 'message','approve','user_id','coupon_id','new_id','name','id',DB::raw('DATE_FORMAT(comments.created_at, \'%T %d/%m/%Y\') as daytime'))->join('users','users.id','=','comments.user_id')->where([['new_id','=',$newId],['approve','=',true]])->get();
    	return Comment::select('cmt_id', 'message','approve','user_id','coupon_id','new_id','name','id',DB::raw('DATE_FORMAT(comments.created_at, \'%T %d/%m/%Y\') as daytime'))->join('users','users.id','=','comments.user_id')->where([['coupon_id','=',$couponId],['approve','=',true]])->get();
    }
    public function getCountCmt($newId,$couponId)
    {
    	if($newId!=null){
    		$countCmt = DB::table('comments')->select('cmt_id')->where([['comments.new_id','=',$newId],['comments.approve','=',true]])->count();
    		$countSubcmt = DB::table('comments')->select('comments.cmt_id')->Join('sub_comments', 'comments.cmt_id','=','sub_comments.cmt_id')->where([['comments.new_id','=',$newId],['sub_comments.approve','=',true]])->count();
    		return ($countCmt+$countSubcmt)==0?'':($countCmt+$countSubcmt);
    	}else{
    		$countCmt = DB::table('comments')->select('cmt_id')->where([['comments.coupon_id','=',$couponId],['comments.approve','=',true]])->count();
    		$countSubcmt = DB::table('comments')->select('comments.cmt_id')->Join('sub_comments', 'comments.cmt_id','=','sub_comments.cmt_id')->where([['comments.coupon_id','=',$couponId],['sub_comments.approve','=',true]])->count();
    		return ($countCmt+$countSubcmt)== 0?'':($countCmt+$countSubcmt);
    	}
    		  
    }
}
