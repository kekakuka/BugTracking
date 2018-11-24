<?php

namespace App\Http\Controllers;

use App\Subsystem;
use App\Usecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsecaseController extends Controller
{
    public function index()
    {  AuthController::IsUser();
        $Usecases = Usecase::orderbyDesc('id')->paginate(15);;
        return view('Usecases.index', compact('Usecases'));
    }

    public function Create()
    {
        AuthController::IsManager();
        $Subsystems=Subsystem::all();
        return view('Usecases.Create',compact('Subsystems'));
    }



    public function CreatePost(Request $request)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Usecases/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Usecase = new Usecase([
            'name' => $_POST['name']
            ,  'description' => $_POST['description']
            ,  'subsystem_id' => $_POST['subsystem_id']
        ]);
        $Usecase->save();
        return redirect('Usecases');
    }
    public function Edit($id)
    {
        AuthController::IsManager();
        $Usecase =Usecase::find($id);
        $Subsystems=Subsystem::all();

        return view('Usecases.Edit',compact('Usecase','Subsystems'));
    }

    public function EditPost(Request $request,$id)
    {

        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Usecases/Edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::table('usecases')
            ->where('id', $id)
            ->update(['name' =>$_POST['name'],'description' =>$_POST['description'],'subsystem_id' =>$_POST['subsystem_id']]);

        return redirect('Usecases');
    }
    public function Details($id)
    {
        AuthController::IsUser();
        $Usecase =Usecase::find($id);

        return view('Usecases.Details', compact('Usecase'));
    }
}
