<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable=['staff_id','setting_id','testcase_id'];

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
}
