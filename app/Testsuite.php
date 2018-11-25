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

    public function costTime()
    {
        $costTime=0;
        foreach ($this->tests as $test){
if($test->costTime!==null)
            $costTime+=$test->costTime;
        }
        return $costTime;
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

    public function waitingTestingNumber()
    {
        $waiting=0;

        foreach ($this->tests as $test){
            if($test->status==='waiting'||$test->status==='testing')
            {$waiting++;}
        }
        return $waiting;
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

    public function PassRunNumber()
    {
        $testsNumber = 0;
        $passNumber = 0;
        $runNumber = 0;

                    foreach ($this->tests as $test) {

                            $testsNumber++;
                            if ($test->status!=='waiting'&&$test->status!=='testing'){
                                $runNumber++;
                            }
                            if ($test->status==='pass'){
                                $passNumber++;
                            }


        }
        if ($runNumber===0){
            return 'No run tests';
        }

        return  (number_format($passNumber/$runNumber,'4')*100).'%';
    }


}
