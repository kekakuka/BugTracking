<?php

namespace App\Http\Controllers\Auth;

use App\Bug;
use App\Http\Controllers\Controller;
use App\Staff;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function Login()
    {

        if(Session::has('user')){
            return redirect('/');

        }

        return view('auth.login');

    }


    public function LogOut()
    {
        Session::forget('MyNumber');
        Session::forget('user');
        return redirect('/');
    }

    public function LoginPost(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'userName' => 'required',
            'password' => 'required|min:4',

        ]);


        if ($validator->fails()) {
            return redirect( route('login') )
                ->withErrors($validator)
                ->withInput();
        }

//       if (Auth::attempt(['EmailAddress'=>$request->input('EmailAddress'),'Password'=>$request->input('Password')],$request->post('remember'))){
//           return redirect('/');
//       }
        $user=DB::table('staff')->where('userName', '=', $request->input('userName'))->first();
        if ($user===null||$user->password!==$request->input('password')){
            $loginMessage='Please Enter the right Email and Password';

            return view('auth.login',compact('loginMessage'));
        }
        $user1=Staff::find($user->id);
        Session::put('user',$user1);
        Session::put('MyNumber',$user1->workLoad($user1->bugassigns) );

        Session::put('OpenBugNumber', Bug::AllOpenBugNumber());
        return redirect('/');
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
