<?php

namespace App\Http\Controllers;

use App\Bug;
use App\Bugassign;
use App\Subsystem;
use App\Test;
use App\Testcase;
use App\Usecase;
use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        $Projects = Project::all()->sortByDesc('id');
        return view('Projects.index', compact('Projects'));
    }

    public function Create()
    {
        AuthController::IsManager();
        return view('Projects.Create');
    }

    public function DeletePost($id,Request $request)
    {

        AuthController::IsManager();
        if($_POST['password']==='654321'){
        $project=Project::find($id);
        foreach ($project->subsystems as $subsystem) {
            foreach ($subsystem->usecases as $usecase) {
                foreach ($usecase->testcases as $testcase) {
                    foreach ($testcase->tests as $test) {
                        foreach ($test->bugs as $bug) {
                            foreach ($bug->bugassigns as $bugassign) {
                                Bugassign::destroy($bugassign->id);
                            }
                            Bug::destroy($bug->id);
                        }
                        Test::destroy($test->id);
                    }
                    TestCase::destroy($testcase->id);
                }
                Usecase::destroy($usecase->id);
            }
            Subsystem::destroy($subsystem->id);
        }
        Project::destroy($id);
        }
        $Projects = Project::all()->sortByDesc('id');
        return view('Projects.index', compact('Projects'));
    }

    public function CreatePost(Request $request)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Projects/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Project = new Project([
            'name' => $_POST['name']
            ,  'description' => $_POST['description']

        ]);
        $Project->save();
        return redirect('Projects');
    }
    public function Edit($id)
    {
        AuthController::IsManager();
        $Project = DB::table('projects')->where('id', $id)->first();
        return view('Projects.Edit',compact('Project'));
    }

    public function EditPost(Request $request,$id)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Projects/Edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::table('projects')
            ->where('id', $id)
            ->update(['name' =>$_POST['name'],'description' =>$_POST['description'],'status' =>$_POST['status']]);

        return redirect('Projects');
    }
    public function Details($id)
    {
        $Project = DB::table('projects')->where('id', $id)->first();
        return view('Projects.Details', compact('Project'));
    }
}
