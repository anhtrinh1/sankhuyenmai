<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    protected $table = 'comment';

    protected $fillable = ['sub_cmt_id', 'message','approve','user_id','cmt_id'];
}
