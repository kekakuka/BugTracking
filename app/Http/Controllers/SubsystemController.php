<?php

namespace App\Http\Controllers;

use App\Project;
use App\Subsystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class SubsystemController extends Controller
{
    public function index()
    {
        AuthController::IsUser();
        $AllSubsystems = Subsystem::all()->sortByDesc('id');
        $Subsystems=  Session::get('user')->BelongMyCompany($AllSubsystems)->paginate(15);
        return view('Subsystems.index', compact('Subsystems'));
    }

    public function Create()
    {
        AuthController::IsManager();
        $projects=Project::all();
        $projects=  Session::get('user')->BelongMyCompany($projects);
        return view('Subsystems.Create',compact('projects'));
    }



    public function CreatePost(Request $request)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Subsystems/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Subsystem = new Subsystem([
            'name' => $_POST['name']
            ,  'description' => $_POST['description']
            ,  'project_id' => $_POST['project_id']
        ]);
        $Subsystem->save();
        return redirect('Subsystems');
    }
    public function Edit($id)
    {
        AuthController::IsManager();
        $Subsystem =Subsystem::find($id);
        $projects=Project::all();
        $projects=  Session::get('user')->BelongMyCompany($projects);
        return view('Subsystems.Edit',compact('Subsystem','projects'));
    }

    public function EditPost(Request $request,$id)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Subsystems/Edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::table('Subsystems')
            ->where('id', $id)
            ->update(['name' =>$_POST['name'],'description' =>$_POST['description'],'project_id' =>$_POST['project_id']]);

        return redirect('Subsystems');
    }
    public function Details($id)
    {
        AuthController::IsUser();
        $Subsystem =Subsystem::find($id);

        return view('Subsystems.Details', compact('Subsystem'));
    }
}
