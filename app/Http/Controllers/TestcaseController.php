<?php

namespace App\Http\Controllers;

use App\Testcase;
use App\Usecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class TestcaseController extends Controller
{
    public function index()
    {
        AuthController::IsUser();

        $AllTestcases = Testcase::all()->sortByDesc('id');
        $Testcases=  Session::get('user')->BelongMyCompany($AllTestcases)->paginate(15);
        return view('Testcases.index', compact('Testcases'));
    }

    public function Create()
    {
        AuthController::IsManager();
        $Usecases=  Session::get('user')->BelongMyCompany(Usecase::all());
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
        AuthController::SameCompany( $Testcase);
        $Usecases=  Session::get('user')->BelongMyCompany(Usecase::all());
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
        AuthController::IsUser();
        $Testcase =Testcase::find($id);
        AuthController::SameCompany( $Testcase);
        return view('Testcases.Details', compact('Testcase'));
    }
}
