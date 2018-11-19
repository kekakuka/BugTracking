<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Testsuite extends Model
{
    protected $fillable=['summary','project_id','setting_id'];

    public function tests()
    {
        return $this->hasMany('App\Test');
    }
    public function setting()
    {
        return $this->belongsTo('App\Setting', 'setting_id','id');
    }
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id','id');
    }
    public function testsTime()
    {
         $testsTime=0;
        foreach ($this->tests as $test){

            $testsTime+=$test->planTime;
        }
        return $testsTime;
    }
    public function waitingNumber()
    {
        $waiting=0;

        foreach ($this->tests as $test){
           if($test->status==='waiting')
           {$waiting++;}
        }
        return $waiting.'/'.$this->tests->count();
    }
    public function myTesting()
    {
        $myTesting=0;
if(Session::has('user')){
        foreach ($this->tests as $test){
            if($test->status==='testing'&&$test->staff_id===Session::get('user')->id)
            {$myTesting++;}
        }
        return  $myTesting;
    }}
    public function hasWaiting()
    {
        $has=false;
        foreach ($this->tests as $test){
            if($test->status==='testing'||$test->status==='waiting'){

                $has=true;
                break;
            }
        }
        return $has;
      }


}
