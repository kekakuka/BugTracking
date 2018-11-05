<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testsuite extends Model
{
    protected $fillable=['summary','project_id'];

    public function tests()
    {
        return $this->hasMany('App\Test');
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

}
