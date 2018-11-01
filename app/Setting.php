<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable=['description'];

    public function tests()
    {
        return $this->hasMany('App\Test');
    }
}
