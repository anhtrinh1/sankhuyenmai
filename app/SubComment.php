<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubComment extends Model
{
    protected $table = 'sub_comments';

    protected $fillable = ['sub_cmt_id', 'message','approve','user_id','cmt_id'];
    public function getSubComment($newId,$couponId)
    {
    	if($newId!=null)
    	   return SubComment::select('sub_comments.sub_cmt_id', 'sub_comments.message','sub_comments.approve','sub_comments.user_id','sub_comments.cmt_id',
DB::raw('DATE_FORMAT(sub_comments.created_at, \'%T %d/%m/%Y\') as daytime'),'name','id')->join('comments','comments.cmt_id','=','sub_comments.cmt_id')->join('users','users.id','=','comments.user_id')->where([['new_id','=',$newId],['sub_comments.approve','=',true]])->get();
        return SubComment::select('sub_comments.sub_cmt_id', 'sub_comments.message','sub_comments.approve','sub_comments.user_id','sub_comments.cmt_id',DB::raw(
'DATE_FORMAT(sub_comments.created_at, \'%T %d/%m/%Y\') as daytime'),'name','id')->join('comments','comments.cmt_id','=','sub_comments.cmt_id')->join('users','users.id','=','comments.user_id')->where([['coupon_id','=',$couponId],['sub_comments.approve','=',true]])->get();
    }
}
