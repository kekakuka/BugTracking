<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        AuthController::IsUser();
        $Settings = Setting::all();
        return view('Settings.index', compact('Settings'));
    }

    public function Create()
    {
        AuthController::IsManager();
        return view('Settings.Create');
    }



    public function CreatePost(Request $request)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [
            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Settings/Create')
                ->withErrors($validator)
                ->withInput();
        }
        $Setting = new Setting([

            'description' => $_POST['description']
            ,
        ]);
        $Setting->save();
        return redirect('Settings');
    }
    public function Edit($id)
    {
        AuthController::IsManager();
        $Setting =Setting::find($id);

        return view('Settings.Edit',compact('Setting'));
    }

    public function EditPost(Request $request,$id)
    {
        AuthController::IsManager();
        $validator = Validator::make($request->all(), [

            'description' => 'max:500',
        ]);

        if ($validator->fails()) {
            return redirect('Settings/Edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::table('settings')
            ->where('id', $id)
            ->update(['description' =>$_POST['description']]);

        return redirect('Settings');
    }

}
