<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';

    protected $fillable = ['id_category', 'name','icon_class','id_user_create','id_user_update',];

    public function getCategory()
    {
    	 $category = Category :: select('*')->get();
    	 return $category;
    }
}
