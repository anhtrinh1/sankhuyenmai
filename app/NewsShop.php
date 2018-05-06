<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsShop extends Model
{
    protected $table = 'new_shop';

    protected $fillable = ['id_news','id_shop','record',];

     
}
