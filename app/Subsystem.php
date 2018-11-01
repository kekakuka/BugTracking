<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Subsystem extends Model
{
    protected $fillable=['name','description','project_id'];

    public function usecases()
    {
        return $this->hasMany('App\Usecase');
    }
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id','id');
    }

    public function bugs($moreThanDate,$lessThanDate)
    {

        $bugs=new Collection();
        foreach ($this->usecases as $usecase){
            foreach ($usecase->testcases as $testcase){
                foreach ($testcase->tests as $test){
                    foreach ($test->bugs as $bug){
                        if ($bug->created_at >= $moreThanDate&&date(date_format($bug->created_at, 'Y-m-d') )<= $lessThanDate) {
                        $bugs->push($bug);}
                    }
                }
            }
        }

        for ($i = 0; $i <$bugs->count()-1; $i++)
            for ($j = 0; $j <$bugs->count()-$i-1; $j++)
                if ($bugs[$j]-> bugRPN > $bugs[$j + 1]->bugRPN) {
                    $temp = $bugs[$j];
                    $bugs[$j] = $bugs[$j+1];
                    $bugs[$j+1]=$temp;
                }

        return $bugs;
    }

    public function bugsCount($moreThanDate,$lessThanDate)
    {
       return $this->bugs($moreThanDate,$lessThanDate)->count();
    }

    public function noClosedBugsCount()
    {
        $bugs=new Collection();
        foreach ($this->usecases as $usecase){
            foreach ($usecase->testcases as $testcase){
                foreach ($testcase->tests as $test){
                    foreach ($test->bugs as $bug){
                        if ($bug->state!=='closed'&&$bug->state!=='deferred') {
                            $bugs->push($bug);}
                    }
                }
            }
        }

        return $bugs->count();
    }

}
