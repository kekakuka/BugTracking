<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class CompanyController extends Controller
{
    public function index()
    {
        AuthController::IsAdmin();

        $Companies= Company::all();
        return view('Companies.index', compact('Companies'));
    }

    public function Create()
    {
        AuthController::IsAdmin();
        return view('Companies.Create');
    }

    public function CreatePost(Request $request)
    {
        AuthController::IsAdmin();
        $validator = Validator::make($request->all(), [
            'companyName' => 'required|max:12|unique:companies|alpha_num',
            'description' => 'max:500',
            'userName' => 'required|max:12|alpha_num|unique:staff',
            'fullName' => 'required|max:100',
            'password' => 'required|string|min:4|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect('Companies/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Company = new Company([
            'companyName' => $_POST['companyName']
            , 'description' => $_POST['description']
        ]);
        $Company->save();
        $Staff = new Staff([
            'userName' => $_POST['userName']
            ,  'fullName' => $_POST['fullName']
            ,  'title' => 'manager'
            ,  'password' => $_POST['password'],
            'company_id' => $Company->id
        ]);
        $Staff->save();

        return redirect('Companies');
    }



    public function DeletePost($id, Request $request)
    {

        AuthController::IsAdmin();
        if ($_POST['password'] === Session::get('user')->password) {

            Company::destroy($id);
            $Companies = Company::all();
            return view('Companies.index', compact('Companies'));
        }
        $vali='Wrong password';
        return redirect('Companies/Details/'.$id)
            ->withErrors($vali)
            ->withInput();

    }

    public function ClearPost($id, Request $request)
    {

        AuthController::IsAdmin();
        if ($_POST['clearPassword'] === Session::get('user')->password) {
$Company=Company::find($id);
$count=0;
foreach ($Company->projects as $project){
    Project::destroy($project->id);
}
            foreach ($Company->staffs as $staff){
               $count++;
               if ($count===1){
                   continue;
               }
               else{
                   Staff::destroy($staff->id);
               }
            }
            return redirect('Companies/Details/'.$id);
        }
        $vali='Wrong password';
        return redirect('Companies/Details/'.$id)
            ->withErrors($vali)
            ->withInput();

    }

    public function Details($id)
    {
        AuthController::IsAdmin();
        $Company = Company::find($id);
        return view('Companies.Details', compact('Company'));
    }

}
