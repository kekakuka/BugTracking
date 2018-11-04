<?php

namespace App\Http\Controllers;

use App\Project;
use App\Setting;
use App\Test;
use App\Testcase;
use App\Testsuite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestsuiteController extends Controller
{
    public function index()
    {
        $Testsuites = Testsuite::all()->sortByDesc('id');
        return view('Testsuites.index', compact('Testsuites'));
    }

    public function Create()
    {
        AuthController::IsManager();
        $projects=Project::all();
        return view('Testsuites.Create',compact('projects'));
    }



    public function CreatePost(Request $request)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [

            'summary' => 'max:500|required',
        ]);

        if ($validator->fails()) {
            return redirect('Testsuites/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Testsuite = new Testsuite([
            'summary' => $_POST['summary']
            ,  'project_id' => $_POST['project_id']
        ]);
        $Testsuite->save();
        return redirect('Testsuites');
    }
    public function Edit($id)
    {
        AuthController::IsManager();
        $Testsuite =Testsuite::find($id);
        $projects=Project::all();
        return view('Testsuites.Edit',compact('Testsuite','projects'));
    }

    public function EditPost(Request $request,$id)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [

            'summary' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Testsuites/Edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::table('Testsuites')
            ->where('id', $id)
            ->update(['summary' =>$_POST['summary']]);

        return redirect('Testsuites');
    }
    public function Details($id)
    {
        $Testsuite =Testsuite::find($id);

        return view('Testsuites.Details', compact('Testsuite'));
    }

    public function Set($id)
    {
        $Testsuite =Testsuite::find($id);
        $settings = Setting::all();
        $testcases = Testcase::all();

        return view('Testsuites.SetTestSuite', compact('Testsuite','settings','testcases'));
    }
    public function SetPost($id,Request $request)
    {
        $Testsuite =Testsuite::find($id);
        $settings = Setting::all();
        $testcases = Testcase::all();

        $validator = Validator::make($request->all(), [


        ]);

        if ($validator->fails()) {
            return redirect('Testsuites/Set')
                ->withErrors($validator)
                ->withInput();
        }

        $Test = new Test([
        'testcase_id' => $_POST['testcase_id']
        , 'setting_id' => $_POST['setting_id']
            , 'testsuite_id' => $id
            , 'planTime' => $_POST['planTime']?:0

            , 'classification' => $_POST['classification']
    ]);
        $Test->save();
        $tsuccess = 'Successfully enter the new Test!';

        return view('Testsuites.SetTestSuite', compact('Testsuite','settings','testcases','tsuccess'));
    }
}
