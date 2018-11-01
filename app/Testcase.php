<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testcase extends Model
{
    protected $fillable=['name','description','usecase_id'];

    public function usecase()
    {
        return $this->belongsTo('App\Usecase', 'usecase_id','id');
    }
    public function tests()
    {
        return $this->hasMany('App\Test');
    }
}
