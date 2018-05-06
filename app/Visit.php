<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit extends Model
{

   protected $table = 'visit';

   protected $fillable = ['id', 'ip','session','visit_start', 'visit_end',];

   public $timestamps = false;
   function getTime()
   {
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $time =  date("Y-m-d H:i:s") ;
    return $time;
  }

  public function setVisit($session,$ip)
  {
    $time = $this->getTime();
    if($this->visit($ip,$session)>0){
     Visit :: where([
      ['session' ,'=', $session],['ip' ,'=', $ip],

    ])->update(['visit_end' => $time]);

   }else{
     Visit :: Insert([ ['session' => $session,'ip' => $ip,'visit_end' => $time,'visit_start' => $time]]);	
   }
  }

  public function getVisit()
  {
   $visit =  Visit :: select(DB::raw('count(id) as cnt'))->get()->toArray() ;
   return $visit[0]['cnt'];
  }
  function visit($ip,$visit_session)
  {
    $visit = Visit :: select('*')->where([
     ['session' ,'=', $visit_session],['ip' ,'=', $ip]
   ])->get();
    return  count($visit);
  }
  public function getVisitYear($year)
  {
    if($year!=null){
      $visit = DB::table('visit')->select(DB::raw('MONTH(visit_start) t,COUNT(id) visit'))
      ->where(DB::raw('YEAR(visit_start)'),'=',$year)->groupBy(DB::raw('MONTH(visit_start)'))->orderBy(DB::raw('MONTH(visit_start)'))->get();
      return $visit;
    }else{
      $visit = DB::table('visit')->select(DB::raw('MONTH(visit_start) t,COUNT(id) visit,YEAR(CURRENT_DATE) year'))
      ->where(DB::raw('YEAR(visit_start)'),'=',DB::raw('YEAR(CURRENT_DATE)'))->groupBy(DB::raw('MONTH(visit_start)'))->orderBy(DB::raw('MONTH(visit_start)'))->get();
      return $visit;
    }
  }

  public function convert($array)
  {
    $arr = array();
    foreach ($array as $key => $value) {
      array_push($arr, $value->visit);
    }
    return $arr;
  }
}
