<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bugassign extends Model
{
    protected $fillable=['staff_id','bug_id','status','updated_at','costTime'];


    public function bug()
    {
        return $this->belongsTo('App\Bug', 'bug_id','id');
    }
    public function staff()
    {
        return $this->belongsTo('App\Staff', 'staff_id','id');
    }

    public function bugResulttd()
    {
        switch ($this->status){
            case 'failed': return '<span style="color:red;font-weight: bolder;font-size: 110%"> '.$this->status.'</span>';

            case 'pass': return '<span style="color: darkgreen;font-weight: bolder;font-size: 110%"> '.$this->status.'</span>';
        }
    }
}
