<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            , 'description' => $_POST['description']
            , 'company_id' => Session::get('user')->company_id
        ]);
        $Project->save();
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
        $Company = DB::table('companies')->where('id', $id)->first();
        return view('Companies.Details', compact('Company'));
    }

}
