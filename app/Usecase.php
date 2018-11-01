<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usecase extends Model
{
    protected $fillable=['name','description','subsystem_id'];

    public function subsystem()
    {
        return $this->belongsTo('App\Subsystem', 'subsystem_id','id');
    }
    public function testcases()
    {
        return $this->hasMany('App\Testcase');
    }
}
