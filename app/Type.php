<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	protected $table = 'type';

    protected $fillable = ['id', 'name','id_user_create','id_user_update',];

    public $incrementing = false;
}
