<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeNews extends Model
{
	protected $table = 'type_news';

    protected $fillable = ['id', 'name','icon_class','id_user_create','id_user_update',];

    public $incrementing = false;

    public function getTypeNews()
    {
    	 $type = TypeNews :: select('*')->get();
    	 return $type;
    }
}
