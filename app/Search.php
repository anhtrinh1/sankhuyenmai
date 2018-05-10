<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'search';

    protected $fillable = ['id', 'ip','key','created_at','updated_at'];

    public function insertSearch($ip,$key)
    {
    	if($key!=null)
    	 Search :: Insert([ ['ip' => $ip,'key' => $key,'created_at'=> now(),'updated_at'=> now()]]);
    }
}
