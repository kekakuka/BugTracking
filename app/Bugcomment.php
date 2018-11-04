<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bugcomment extends Model
{

    protected $fillable=['staff_id','bug_id','comment'];
    public function bug()
    {
        return $this->belongsTo('App\Bug', 'bug_id','id');
    }
    public function staff()
    {
        return $this->belongsTo('App\Staff', 'staff_id','id');
    }

}
