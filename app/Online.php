<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Online extends Model
{
	protected $table = 'online';

    protected $fillable = ['ip', 'session','time_visit',];

    public $timestamps = false;

     
    function check($session,$ip){
		$online =  Online :: select(DB::raw('count(ip) as cnt'))->where([
   	  		['session' ,'=', $session],['ip' ,'=', $ip],

   	  ])->get()->toArray() ;
    	return $online[0]['cnt'];
	}

	public function setOnline($session,$ip)
	{
	  	Online :: where(DB::raw('TIMESTAMPDIFF(MINUTE,time_visit,CURRENT_TIMESTAMP)'), '>',10)->delete();
		$online = $this->check($session,$ip);
		if($online > 0){
			Online :: where([
   	  		['session' ,'=', $session],['ip' ,'=', $ip],

   	  ])->update(['time_visit' => DB::raw('CURRENT_TIME')]);
		}else{
			
		    Online :: Insert([ ['session' => $session,'ip' => $ip,'time_visit' => DB::raw('CURRENT_TIME')]]);
		}
	}  

	public function getOnline()
	{
		$online =  Online :: select(DB::raw('count(ip) as cnt'))->get()->toArray() ;
    	return $online[0]['cnt'];
	}
}
