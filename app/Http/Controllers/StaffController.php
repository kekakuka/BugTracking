<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class StaffController extends Controller
{
    public function index()
    {
        AuthController::IsUser();
        $staffs = Staff::all();
        $staffs=Session::get('user')->BelongMyCompany( $staffs);
        $staffs =  $staffs->paginate(15);
        return view('Staff.index', compact('staffs'));
    }

    public function Create()
    {
        AuthController::IsManager();
        return view('Staff.Create');
    }

    public function Edit($id)
    {
        AuthController::IsManager();
        $staff = Staff::find($id);
//        $t='';
//        $d='';
//        $m='';
//        if ($staff->title==='tester'){
//            $t='selected';
//        }
//        if ($staff->title==='developer'){
//            $d='selected';
//
//        }
//        if ($staff->title==='manager'){
//            $m='selected';
//        }

        return view('Staff.Edit',compact('staff'));
    }

    public function EditPost(Request $request,$id)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('Staff/Edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::table('staff')
            ->where('id', $id)
            ->update(['fullName' =>$_POST['fullName']]);

        return redirect('Staff');
    }
    
    public function CreatePost(Request $request)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'userName' => 'required|max:100|alpha_num|unique:staff',
            'fullName' => 'required|max:100',
            'password' => 'required|string|min:4|confirmed',

        ]);

        if ($validator->fails()) {
            return redirect('Staff/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Staff = new Staff([
            'userName' => $_POST['userName']
            ,  'fullName' => $_POST['fullName']
            ,  'title' => $_POST['title']
            ,  'password' => $_POST['password'],
             'company_id' => Session::get('user')->company_id
        ]);
        $Staff->save();
        return redirect('Staff');
    }

    public function Details($id)
    {
        AuthController::IsUser();
        $staff = Staff::find($id);
        $unfinishedBugAssign=new Collection();
        foreach ($staff->bugassigns as $bugassign) {
            if (($bugassign->status === 'assigned')
              ) {
               $unfinishedBugAssign->push($bugassign);
            }
        }
        $staffs=new Collection();
        $allStaff = Staff::all();
        foreach ($allStaff as $otherStaff) {
            if ($staff->userName!==$otherStaff->userName){
               if($staff->title==='developer'&&$staff->title===$otherStaff->title){
                $staffs->push($otherStaff);
                }
               elseif($staff->title!=='developer'&&($otherStaff->title==='tester'||$otherStaff->title==='manager')){
                   $staffs->push($otherStaff);
               }
            }
        }
        return view('Staff.Details', compact('staff','unfinishedBugAssign','staffs'));
    }
}
