<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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


    public function companyDetails(){
        $companyDetail=new Collection();
        $projectNumber=0;
        $staffNumber=0;
        $testcaseNumber=0;
        $bugNumber=0;
        $testsuiteNumber=0;
        $bugAssignNumber=0;
        foreach ($this->projects as $project){
            $projectNumber++;
            foreach ($project->testsuites as $testsuite) {
                $testsuiteNumber++;
            }
            foreach ($project->subsystems as $subsystem){
                foreach ($subsystem->usecases as $usecase){
                    foreach ($usecase->testcases as $testcase){
                        $testcaseNumber++;
                        foreach ($testcase->tests as $test){
                            foreach ($test->bugs as $bug){
                                $bugNumber++;
                                foreach ($bug->bugassigns as $bugassign){
                                    $bugAssignNumber++;
                                }
                            }
                        }
                    }
                }
            }
        }
        foreach ($this->staffs as $staff){
            $staffNumber++;
        }
        $companyDetail->put('projectNumber',$projectNumber);
        $companyDetail->put('staffNumber',$staffNumber);
        $companyDetail->put('testcaseNumber',$testcaseNumber);
         $companyDetail->put('bugNumber',$bugNumber);
        $companyDetail->put('bugAssignNumber',$bugAssignNumber);
        $companyDetail->put('testsuiteNumber',$testsuiteNumber);
        return $companyDetail;
    }
}
