<?php

namespace App\Http\Controllers;

use Session;

class AuthController
{
    public  static function IsManager(){
        if (!Session::has('user')){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if (Session::get('user')->title!=='manager')
        {   abort(404,'Sorry, the page you are looking for could not be found.');
        }

    }
    public  static function IsNotDeveloper(){
        if (!Session::has('user')){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if (Session::get('user')->title==='developer')
        {   abort(404,'Sorry, the page you are looking for could not be found.');
        }
    }
    public  static function IsDeveloper(){
        if (!Session::has('user')){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if (Session::get('user')->title!=='developer')
        {   abort(404,'Sorry, the page you are looking for could not be found.');
        }
    }


    public  static function IsUser(){

        if (!Session::has('user')){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
    }
}