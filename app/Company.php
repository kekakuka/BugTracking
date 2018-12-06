<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['companyName','description'];



    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Project');
    }
    public function staffs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Staff');
    }
}
