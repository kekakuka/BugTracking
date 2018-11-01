<?php

namespace App\Http\Controllers;

use App\Bug;
use App\Bugassign;
use App\Setting;
use App\Staff;
use App\Test;
use App\Testcase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class BugController extends Controller
{
    public function index()
    {
        $Bugs = Bug::all()->sortByDesc('id');
        return view('Bugs.index', compact('Bugs'));
    }

    public function MyWork()
    {
        $myBugs = new Collection();
        $Bugassigns = Bugassign::all();
        $staffs = Staff::all();
        foreach ($Bugassigns as $bugassign) {
            if (($bugassign->status === 'assigned')
                && $bugassign->staff_id === Session::get('user')->id) {
                $myBugs->push($bugassign);
            }
        }
        Session::put('MyNumber',Staff::find(Session::get('user')->id)->workLoad(Staff::find(Session::get('user')->id)->bugassigns) );
        return view('Bugs.MyWork', compact('myBugs', 'staffs'));
    }

    public function AssignIndex()
    {
        AuthController::IsManager();
        $Bugs = new Collection();
        $AllBugs = Bug::all();
        foreach ($AllBugs as $bug) {
            if ($bug->state === 'open' || $bug->state === 'reOpened') {
                $Bugs->push($bug);
            }
        }
        return view('Bugs.AssignIndex', compact('Bugs'));
    }

    public function Assign($id)
    {
        AuthController::IsManager();
        $date = date_format(Carbon::tomorrow(), 'Y-m-d');
        $bug = Bug::find($id);
        $staffs = DB::table('staff')->where('title', '=', 'developer')->get();
        return view('Bugs.Assign', compact('bug', 'staffs', 'date'));
    }

    public function Reject(Request $request, $id)
    {
        AuthController::IsManager();
        DB::table('Bugs')
            ->where('id', $id)
            ->update(['state' => 'rejected']);
        $bugAssign = new Bugassign([
            'bug_id' => $id
            , 'staff_id' => Bug::find($id)->test->staff_id
        ]);
        $bugAssign->save();
        return redirect()->route('BugAssignIndex');
    }

    public function Create()
    {
        AuthController::IsNotDeveloper();
        $tests = Test::all();
        $settings = Setting::all();
        $testcases = Testcase::all();
        return view('Bugs.Create', compact('tests', 'testcases', 'settings'));
    }

    public function ReAssign(Request $request, $id)
    {
AuthController::IsManager();
        DB::table('bugassigns')
            ->where('id', $id)
            ->update(['staff_id' => $_POST['staff_id']]);
return redirect()->to($request->session()->previousUrl());
    }

    public function StaffAssign(Request $request, $id)
    {

        $bug = Bugassign::find($id);
        $staffs = Staff::all();
        return view('Bugs.MyBugAssign', compact('bug', 'staffs'));
    }

    public function MyWorkPost(Request $request, $id)
    {
        DB::table('Bugassigns')
            ->where('id', $id)
            ->update(['status' => 'finished','updated_at'=>date_format(Carbon::now(), 'Y-m-d H:m:s')]);
        Session::forget('MyNumber');

        Session::put('MyNumber',Staff::find(Session::get('user')->id)->workLoad(Staff::find(Session::get('user')->id)->bugassigns) );

        if (Session::get('user')->title === 'developer') {
            $bugAssign = new Bugassign([
                'bug_id' => Bugassign::find($id)->bug->id
                , 'staff_id' => $_POST['staff_id']
            ]);
            $bugAssign->save();
            if (Staff::find($_POST['staff_id'])->title !== 'developer') {
                DB::table('Bugs')
                    ->where('id', Bugassign::find($id)->bug->id)
                    ->update(['state' => 'test']);
                if (isset($_POST['taxonomy']) && $_POST['taxonomy'] !== '') {
                    DB::table('Bugs')
                        ->where('id', Bugassign::find($id)->bug->id)
                        ->update(['taxonomy' => $_POST['taxonomy']]);
                }
            }
        } else {
            if($_POST['state']==='closed'){
            DB::table('Bugs')
                ->where('id', Bugassign::find($id)->bug->id)
                ->update(['state' => $_POST['state'],'taxonomy' => $_POST['taxonomy'],'actualFixDate' =>date_format(Carbon::now(), 'Y-m-d')]);
            }
            else{
                if (isset($_POST['description'])&&$_POST['description']!==''){
                DB::table('Bugs')
                    ->where('id', Bugassign::find($id)->bug->id)
                    ->update(['state' => $_POST['state'],'taxonomy' => $_POST['taxonomy'],'description' => $_POST['description']]);}
                    else{
                        DB::table('Bugs')
                            ->where('id', Bugassign::find($id)->bug->id)
                            ->update(['state' => $_POST['state'],'taxonomy' => $_POST['taxonomy']]);
                    }
            }
        }
        return redirect(route('MyWork'));
    }

    public function AssignPost(Request $request, $id)
    {

        AuthController::IsManager();
        if (isset($_POST['estimatedFixDate']) && $_POST['estimatedFixDate'] !== '') {
            $validator = Validator::make($request->all(), [
                'description' => 'required|max:1000',
                'estimatedFixDate' => 'after:yesterday',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'description' => 'required|max:1000',

            ]);
        }
        if ($validator->fails()) {
            return redirect('Bugs/Assign/' . $id)
                ->withErrors($validator)
                ->withInput();
        }
        $bugAssign = new Bugassign([
            'bug_id' => $id
            , 'staff_id' => $_POST['staff_id']
        ]);
        $bugAssign->save();
        if (isset($_POST['estimatedFixDate']) && $_POST['estimatedFixDate'] !== '') {
            DB::table('Bugs')
                ->where('id', $id)
                ->update(['estimatedFixDate' => $_POST['estimatedFixDate']]);
        }
        if (isset($_POST['taxonomy']) && $_POST['taxonomy'] !== '') {
            DB::table('Bugs')
                ->where('id', $id)
                ->update(['taxonomy' => $_POST['taxonomy']]);
        }
        DB::table('Bugs')
            ->where('id', $id)
            ->update(['state' => 'assigned', 'priority' => $_POST['priority']
                , 'severity' => $_POST['severity']]);


        return redirect(route('BugAssignIndex'));
    }

    public function CreatePost(Request $request)
    {
        AuthController::IsNotDeveloper();
        if ($_POST['ifNewTest'] === '3') {
            $Test = new Test([
                'testcase_id' => $_POST['testcase_id']
                , 'setting_id' => $_POST['setting_id']
                , 'staff_id' => Session::get('user')->id
            ]);
            $Test->save();
            $csuccess = 'Successfully enter the new Test!';
        } else {
            if (isset($_POST['estimatedFixDate']) && $_POST['estimatedFixDate'] !== '') {
                $validator = Validator::make($request->all(), [
                    'description' => 'required|max:1000',
                    'estimatedFixDate' => 'after:yesterday',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'description' => 'required|max:1000',

                ]);

            }
            if ($validator->fails()) {
                return redirect('Bugs/Create')
                    ->withErrors($validator)
                    ->withInput();
            }


            if ($_POST['ifNewTest'] === '1') {

                $Test = new Test([
                    'testcase_id' => $_POST['testcase_id']
                    , 'setting_id' => $_POST['setting_id']
                    , 'staff_id' => Session::get('user')->id
                ]);
                $Test->save();
                $Bug = new Bug([
                    'priority' => $_POST['priority']
                    , 'severity' => $_POST['severity']
                    , 'test_id' => $Test->id
                    , 'description' => $_POST['description']
                ]);
            } else {
                $Bug = new Bug([
                    'priority' => $_POST['priority']
                    , 'severity' => $_POST['severity']
                    , 'test_id' => $_POST['test_id']
                    , 'description' => $_POST['description']
                ]);
            }
            $Bug->save();
            if (isset($_POST['estimatedFixDate']) && $_POST['estimatedFixDate'] !== '') {
                DB::table('Bugs')
                    ->where('id', $Bug->id)
                    ->update(['estimatedFixDate' => $_POST['estimatedFixDate']]);
            }
            if (isset($_POST['taxonomy']) && $_POST['taxonomy'] !== '') {
                DB::table('Bugs')
                    ->where('id', $Bug->id)
                    ->update(['taxonomy' => $_POST['taxonomy']]);
            }

            $csuccess = 'Successfully enter the new Bug!';
        }
        return redirect(route('BugCreate'))->with('csuccess', $csuccess);
    }

    public function Edit($id)
    {
        AuthController::IsManager();
        $Bug = Bug::find($id);
        return view('Bugs.Edit', compact('Bug'));
    }


    public function EditPost(Request $request, $id)
    {
        foreach (Bug::find($id)->bugassigns as $bugassign){
            if ($bugassign->status==='assigned'){
                DB::table('Bugassigns')
                    ->where('id', $bugassign->id)
                    ->update(['status' => 'finished','updated_at'=>date_format(Carbon::now(), 'Y-m-d H:m:s')]);
            }

        }
        DB::table('Bugs')
            ->where('id', $id)
            ->update(['state' => 'deferred','actualFixDate' =>date_format(Carbon::now(), 'Y-m-d')]);


        return redirect('Bugs');
    }

    public function Details($id)
    {
        $Bug = Bug::find($id);

        return view('Bugs.Details', compact('Bug'));
    }
}
