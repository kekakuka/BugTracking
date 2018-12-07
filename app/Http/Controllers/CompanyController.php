<?php

namespace App\Http\Controllers;

use App\Company;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            'companyName' => 'required|max:100|unique:companies',
            'description' => 'max:500',
            'userName' => 'required|max:100|alpha_num|unique:staff',
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

        AuthController::IsManager();
        if ($_POST['password'] === '654321') {
            $project = Project::find($id);
            foreach ($project->subsystems as $subsystem) {
                foreach ($subsystem->usecases as $usecase) {
                    foreach ($usecase->testcases as $testcase) {
                        foreach ($testcase->tests as $test) {
                            foreach ($test->bugs as $bug) {
                                foreach ($bug->bugassigns as $bugassign) {
                                    Bugassign::destroy($bugassign->id);
                                }
                                foreach ($bug->bugcomments as $bugcomment) {
                                    Bugcomment::destroy($bugcomment->id);
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
            foreach ($project->testsuites as $testsuite) {
                Testsuite::destroy($testsuite->id);
            }
            Project::destroy($id);
        }
        $Companies = Company::all();
        return view('Companies.index', compact('Companies'));
    }

    public function Details($id)
    {
        AuthController::IsAdmin();
        $Company = Company::find($id);
        return view('Companies.Details', compact('Company'));
    }

}
