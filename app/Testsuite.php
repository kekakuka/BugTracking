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
}
