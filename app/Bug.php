<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable=['state','description','severity','priority','estimatedFixDate','actualFixDate','taxonomy','test_id'];

    public function bugassigns()
    {
        return $this->hasMany('App\Bugassign');
    }
    public function bugcomments()
    {
        return $this->hasMany('App\BugComment');
    }

    public function test()
    {
        return $this->belongsTo('App\Test', 'test_id','id');
    }

    public function bugRPNtd()
    {
       switch ((integer)($this->bugRPN/5)){
           case 0: return '<span style="color:red;font-weight: bolder;font-size: 130%"> '.$this->bugRPN.'</span>';
           case 1: return '<span style="color: darkorange;font-weight: bolder;font-size: 130%"> '.$this->bugRPN.'</span>';
           case 2: return '<span style="color: gold;font-weight: bolder;font-size: 130%"> '.$this->bugRPN.'</span>';
           case 3: return '<span style="color: blue;font-weight: bolder;font-size: 130%"> '.$this->bugRPN.'</span>';
           case 4: return '<span style="color: darkgreen;font-weight: bolder;font-size: 130%"> '.$this->bugRPN.'</span>';
           case 5: return '<span style="color: darkgreen;font-weight: bolder;font-size: 130%"> '.$this->bugRPN.'</span>';
       }
    }

}
