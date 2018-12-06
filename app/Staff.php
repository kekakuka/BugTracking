<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Staff extends Model
{
    protected $fillable=['userName','fullName','title','password','company_id'];

    public function bugassigns()
    {
        return $this->hasMany('App\Bugassign');
    }


    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id','id');
    }


    public  function BelongMyCompany($itemList){
        if($this->title==='admin'){
            return $itemList;
        }

       $newList=new Collection();
        if ($itemList->count()===0) {
            return $newList;
        }
        if($itemList[0]->company_id) {
            foreach ($itemList as $item){
                if($item->company_id===$this->company_id)
                {  $newList->push($item);}
            }
             return $newList;
         }
        if($itemList[0]->project_id) {
            foreach ($itemList as $item){
                if($item->project->company_id===$this->company_id){
                $newList->push($item);}
            }
            return $newList;
        }
        if($itemList[0]->subsystem_id) {
            foreach ($itemList as $item){
                if($item->subsystem->project->company_id===$this->company_id){
                    $newList->push($item);}
            }
            return $newList;
        }
        if($itemList[0]->usecase_id) {
            foreach ($itemList as $item){
                if($item->usecase->subsystem->project->company_id===$this->company_id){
                    $newList->push($item);}
            }
            return $newList;
        }
        if($itemList[0]->testcase_id) {
            foreach ($itemList as $item){
                if($item->testcase->usecase->subsystem->project->company_id===$this->company_id){
                    $newList->push($item);}
            }
            return $newList;
        }
        if($itemList[0]->test_id) {
            foreach ($itemList as $item){
                if($item->test->testcase->usecase->subsystem->project->company_id===$this->company_id){
                    $newList->push($item);}
            }
            return $newList;
        }
        if($itemList[0]->bug_id) {
            foreach ($itemList as $item){
                if($item->bug->test->testcase->usecase->subsystem->project->company_id===$this->company_id){
                    $newList->push($item);}
            }
            return $newList;
        }
        return $newList;
    }

    public function workLoad($bugassigns): int
    {
        $workLoad=0;
       foreach ($bugassigns as $bugassign){
           if ($bugassign->status==='assigned'){
           $workLoad++;}
       }
       return $workLoad;
    }
    public function finishedWork($bugassigns,$moreThanDate,$lessThanDate): int
    {
        $workLoad=0;
        foreach ($bugassigns as $bugassign){
            if ($bugassign->status!=='assigned'&&($bugassign->created_at>=$moreThanDate)&&(date(date_format($bugassign->created_at,'Y-m-d')) <=$lessThanDate)){
                $workLoad++;}
        }
        return $workLoad;
    }

    public function tests()
    {
        return $this->hasMany('App\Test');
    }
    public function bugsAssigns($moreThanDate,$lessThanDate)
    {
        $bugsassigns=new Collection();
        foreach ($this->bugassigns as $bugassign){
            if ($bugassign->status==='assigned'){
                $bugsassigns->push($bugassign);
            }
        }
        foreach ($this->bugassigns as $bugassign){
            if ($bugassign->status!=='assigned'&&($bugassign->created_at>=$moreThanDate)&&(date(date_format($bugassign->created_at,'Y-m-d'))<=$lessThanDate)){
                $bugsassigns->push($bugassign);
            }
        }
        return $bugsassigns;
    }
    public function testsNumber($id)
    {
        $result=0;
        if ($id===0){
            foreach ($this->tests as $test){
                if ($test->testsuite_id===null&&$test->status==='testing'){
                    $result++;
                }
            }
        }
        else{
            foreach ($this->tests as $test){
                if ($test->testsuite_id===$id&&$test->status==='testing'){
                    $result++;
                }
            }
        }
       return $result;
    }
    public function developerTime($moreThanDate,$lessThanDate)
    {
        $time=0;

        foreach ($this->bugassigns as $bugassign){
            if ($bugassign->status!=='assigned'&&($bugassign->created_at>=$moreThanDate)&&(date(date_format($bugassign->created_at,'Y-m-d'))<=$lessThanDate)){
                $time+=$bugassign->costTime;
            }
        }
        return $time;
    }

    public function bugcomments()
    {
        return $this->hasMany('App\BugComment');
    }

    public function workTime($moreThanDate,$lessThanDate,$project_id){
        $result=0;

        if ($project_id==0){
            foreach ($this->bugassigns as $bugassign){
                if (($bugassign->status==='pass'||$bugassign->status==='failed')&&($bugassign->created_at>=$moreThanDate)&&(date(date_format($bugassign->created_at,'Y-m-d'))<=$lessThanDate)){
                    $result+=$bugassign->costTime;
                }
            }
            foreach ($this->tests as $test){
                if (($test->updated_at>=$moreThanDate)&&(date(date_format($test->updated_at,'Y-m-d'))<=$lessThanDate)){
                    $result+=$test->costTime;
                }
            }
        }
        else{
            foreach ($this->bugassigns as $bugassign){
                if (($bugassign->status==='pass'||$bugassign->status==='failed')&&($bugassign->created_at>=$moreThanDate)&&(date(date_format($bugassign->created_at,'Y-m-d'))<=$lessThanDate&&($bugassign->bug->test->testsuite->project->id==$project_id))){
                    $result+=$bugassign->costTime;
                }
            }
            foreach ($this->tests as $test){
                if (($test->updated_at>=$moreThanDate)&&(date(date_format($test->updated_at,'Y-m-d'))<=$lessThanDate)&&($test->testcase->usecase->subsystem->project->id==$project_id)){
                    $result+=$test->costTime;
                }
            }
        }



        return $result;

    }


    public function tBugsAssigns($moreThanDate,$lessThanDate,$project_id)
    {
        $bugsassigns=new Collection();
        if ($project_id==0){
        foreach ($this->bugassigns as $bugassign){
            if (($bugassign->status==='pass'||$bugassign->status==='failed')&&($bugassign->created_at>=$moreThanDate)&&(date(date_format($bugassign->created_at,'Y-m-d'))<=$lessThanDate)){
                $bugsassigns->push($bugassign);
            }
        }

        }
        else{
            foreach ($this->bugassigns as $bugassign){
                if (($bugassign->status==='pass'||$bugassign->status==='failed')&&($bugassign->created_at>=$moreThanDate)&&(date(date_format($bugassign->created_at,'Y-m-d'))<=$lessThanDate&&($bugassign->bug->test->testsuite->project->id==$project_id))){
                    $bugsassigns->push($bugassign);
                }
            }

        }
        return $bugsassigns;
    }

    public function myTests($moreThanDate,$lessThanDate,$project_id)
    {
        $myTests=new Collection();
        if ($project_id==0){
        foreach ($this->tests as $test){
            if (($test->updated_at>=$moreThanDate)&&(date(date_format($test->updated_at,'Y-m-d'))<=$lessThanDate)){
                $myTests->push($test);
            }
        }
        }
        else{
            foreach ($this->tests as $test){
                if (($test->updated_at>=$moreThanDate)&&(date(date_format($test->updated_at,'Y-m-d'))<=$lessThanDate)&&($test->testcase->usecase->subsystem->project->id==$project_id)){
                    $myTests->push($test);
                }
            }
        }
        return $myTests;
    }

    public function UnifinishedTestNumber()
    {
        $result=0;
       foreach ($this->tests as $test){
           if($test->status==='testing'){
               $result++;
           }
       }
       return $result;
    }

}
