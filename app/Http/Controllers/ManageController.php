<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ManageController extends Controller
{
    public function ChangePassword()
    {

        return view('Manage.Profile');
    }

    public function PasswordPost(Request $request)
    {

        $Cuser = Staff::find(Session::get('user')->id);
        if ($_POST['OldPassword']!==$Cuser->password)
        {
            $passwordErrors='Wrong Password!';
            return redirect(route('ChangePassword'))->with('passwordErrors', $passwordErrors);
        }
        if (strlen($_POST['NewPassword'])<4){
            $passwordErrors='The new Password should be more than 4 charactor!';
            return redirect(route('ChangePassword'))->with('passwordErrors', $passwordErrors);
        }
        if ($_POST['NewPassword']!==$_POST['ConfirmPassword'])
        {
            $passwordErrors='New Password must be the same as Confirm Password!';
            return redirect(route('ChangePassword'))->with('passwordErrors', $passwordErrors);
        }
        DB::table('staff')
            ->where('id', Session::get('user')->id)
            ->update(['password' => $_POST['NewPassword']]);
        $user = Staff::find(Session::get('user')->id);
        $PassSuccess = 'Your password has changed';
        Session::put('user', $user);
        return redirect(route('ChangePassword'))->with('PassSuccess', $PassSuccess);

    }
}
