<?php

namespace App\Http\Controllers;

use App\Bug;
use App\Project;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    public function index()
    {
       // AuthController::IsUser();
$Projects=Project::all();
        return view('Reports.index',compact('Projects'));
    }
    public function StaffReport(Request $request)
    {
     //   AuthController::IsUser();
        if (isset($_GET['moreThanDate'])&&($_GET['moreThanDate']!='')){
            $moreThanDate= $_GET['moreThanDate'];

        }
        else{
            $moreThanDate=date('2000-1-1');
        }
        if (isset($_GET['lessThanDate'])&&($_GET['lessThanDate']!='')){
            $lessThanDate= $_GET['lessThanDate'];
        }
        else{
            $lessThanDate=date('2099-12-31');
        }



        $staffs=Staff::all();
        return view('Reports.StaffReport',compact('staffs','moreThanDate','lessThanDate'));

    }

    public function TesterReport(Request $request)
    {
     //   AuthController::IsUser();
        if (isset($_GET['moreThanDate'])&&($_GET['moreThanDate']!='')){
            $moreThanDate= $_GET['moreThanDate'];

        }
        else{
            $moreThanDate=date('2000-1-1');
        }
        if (isset($_GET['lessThanDate'])&&($_GET['lessThanDate']!='')){
            $lessThanDate= $_GET['lessThanDate'];
        }
        else{
            $lessThanDate=date('2099-12-31');
        }
        if (isset($_GET['project_id'])&&($_GET['project_id']!=0)){


            $selectProject= $_GET['project_id'];
$projectName=Project::find($selectProject)->name;
        }
        else{
            $selectProject=0;
        }

        $staffs=new Collection();
        $projects=Project::all();
        $staff=Staff::all();
        foreach ($staff as $astaff){
            if ($astaff->title!=='developer')
            {
                $staffs->push($astaff);
            }
        }

        return view('Reports.TesterReport',compact('staffs','projects','moreThanDate','lessThanDate','selectProject','projectName'));

    }
    public function TestingProjectReport(Request $request,$id)
    {

      //  AuthController::IsUser();
        if (isset($_GET['moreThanDate'])&&($_GET['moreThanDate']!='')){
            $moreThanDate= $_GET['moreThanDate'];

        }
        else{
            $moreThanDate=date('2000-1-1');
        }
        if (isset($_GET['lessThanDate'])&&($_GET['lessThanDate']!='')){
            $lessThanDate= $_GET['lessThanDate'];
        }
        else{
            $lessThanDate=date('2099-12-31');
        }
        $open=0;
        $rejected=0;
        $assigned=0;
        $test=0;
        $reOpened=0;
        $closed=0;
        $deferred=0;
        $project=Project::find($id);
        $allBugs=Bug::all();
        $bugs=new Collection();
        foreach ($allBugs as $bug){

            if ($bug->test->testcase->usecase->subsystem->project->id==$id){
                // dd();
                if ($bug->created_at >= $moreThanDate&&date(date_format($bug->created_at, 'Y-m-d') )<= $lessThanDate) {
                    $bugs->push($bug);
                    switch ($bug->state) {
                        case 'open':$open++;break;
                        case 'rejected':$rejected++;break;
                        case 'assigned':$assigned++;break;
                        case 'test':$test++;break;
                        case 'reOpened':$reOpened++;break;
                        case 'closed':$closed++;break;
                        case 'deferred':$deferred++;break;
                    }
                }
            }
        }
        $count=1000;
        $BugStates=[
            'open'=>$open,
            'rejected'=>$rejected,
            'assigned'=>$assigned,
            'test'=>$test,
            'reOpened'=>$reOpened,
            'closed'=>$closed,
            'deferred'=>$deferred,];

        return view('Reports.TestingProjectReport',compact('project','bugs','count','BugStates','moreThanDate','lessThanDate'));
    }

    public function ProjectReport(Request $request,$id)
    {

      //  AuthController::IsUser();
        if (isset($_GET['moreThanDate'])&&($_GET['moreThanDate']!='')){
          $moreThanDate= $_GET['moreThanDate'];
        }
        else{
            $moreThanDate=date('2000-1-1');
        }
        if (isset($_GET['lessThanDate'])&&($_GET['lessThanDate']!='')){
            $lessThanDate= $_GET['lessThanDate'];
        }
        else{
            $lessThanDate=date('2099-12-31');
        }
        $functional=0;
        $system=0;
        $process=0;
        $data=0;
        $code=0;
        $duplicate=0;
        $other=0;
        $NAP=0;
        $badUnit=0;
        $standards=0;
        $RCN=0;
        $unknown=0;
        $documentation=0;
        $noTaxonomy=0;




        $project=Project::find($id);
        $allBugs=Bug::all();
        $bugs=new Collection();
        foreach ($allBugs as $bug){
            if ($bug->test->testcase->usecase->subsystem->project->id==$id){
              // dd();
                if ($bug->created_at >= $moreThanDate&&date(date_format($bug->created_at, 'Y-m-d') )<= $lessThanDate) {
                $bugs->push($bug);
                    switch ($bug->taxonomy) {
                        case 'functional':$functional++;break;
                        case 'system':$system++;break;
                        case 'process':$process++;break;
                        case 'data':$data++;break;
                        case 'code':$code++;break;
                        case 'duplicate':$duplicate++;break;
                        case 'other':$other++;break;
                        case 'NAP':$NAP++;break;
                        case 'badUnit':$badUnit++;break;
                        case 'standards':$standards++;break;
                        case 'documentation':$documentation++;break;
                        case 'RCN':$RCN++;break;
                        case 'unknown':$unknown++;break;
                        default: $noTaxonomy++;break;
                    }
}
            }
        }

        $count=1000;
$BugTaxonomy=[
     'functional'=>$functional,
                     'system'=>$system,
                     'process'=>$process,
                     'data'=>$data,
                     'code'=>$code,
                     'duplicate'=>$duplicate,
                     'other'=>$other,
                     'NAP'=>$NAP,
                     'badUnit'=>$badUnit,
                     'standards'=>$standards,
                     'RCN'=>$RCN,
                     'unknown'=>$unknown,
    'documentation'=>$documentation ,
                   'noTaxonomy'=> $noTaxonomy
    
    ];

        return view('Reports.ProjectReport',compact('project','bugs','count','BugTaxonomy','moreThanDate','lessThanDate'));
    }
}
