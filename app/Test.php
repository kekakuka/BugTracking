<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable=['staff_id','setting_id','testcase_id','status','planTime','costTime','description','classification','testsuite_id'];

    public function testsuite()
    {
        return $this->belongsTo('App\TestSuite', 'testsuite_id','id');
    }

    public function testcase()
    {
        return $this->belongsTo('App\Testcase', 'testcase_id','id');
    }
    public function staff()
    {
        return $this->belongsTo('App\Staff', 'staff_id','id');
    }
    public function setting()
    {
        return $this->belongsTo('App\Setting', 'setting_id','id');
    }
    public function bugs()
    {
        return $this->hasMany('App\Bug');
    }

    public function testStatusTd()
    {
        switch ($this->status){
            case 'failed': return '<span style="color:red;font-weight: bolder;font-size: 110%"> '.$this->status.'</span>';
            case 'waiting': return '<span style="color: darkorange;font-weight: bolder;font-size: 110%"> '.$this->status.'</span>';
            case 'closed': return '<span style="color: blue;font-weight: bolder;font-size: 110%"> '.$this->status.'</span>';
            case 'pass': return '<span style="color: darkgreen;font-weight: bolder;font-size: 110%"> '.$this->status.'</span>';
            case 'testing': return '<span style="color: darkred;font-weight: bolder;font-size: 110%"> '.$this->status.'</span>';
        }
    }
}
