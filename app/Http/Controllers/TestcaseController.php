<?php

namespace App\Http\Controllers;

use App\Testcase;
use App\Usecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestcaseController extends Controller
{
    public function index()
    {
        $Testcases = Testcase::all()->sortByDesc('id');
        return view('Testcases.index', compact('Testcases'));
    }

    public function Create()
    {
        AuthController::IsManager();
        $Usecases=Usecase::all();
        return view('Testcases.Create',compact('Usecases'));
    }



    public function CreatePost(Request $request)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Testcases/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Testcase = new Testcase([
            'name' => $_POST['name']
            ,  'description' => $_POST['description']
            ,  'usecase_id' => $_POST['usecase_id']
        ]);
        $Testcase->save();
        return redirect('Testcases');
    }
    public function Edit($id)
    {
        AuthController::IsManager();
        $Testcase =Testcase::find($id);
        $Usecases=Usecase::all();

        return view('Testcases.Edit',compact('Testcase','Usecases'));
    }

    public function EditPost(Request $request,$id)
    {

        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Testcases/Edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::table('Testcases')
            ->where('id', $id)
            ->update(['name' =>$_POST['name'],'description' =>$_POST['description'],'usecase_id' =>$_POST['usecase_id']]);

        return redirect('Testcases');
    }
    public function Details($id)
    {
        $Testcase =Testcase::find($id);

        return view('Testcases.Details', compact('Testcase'));
    }
}
