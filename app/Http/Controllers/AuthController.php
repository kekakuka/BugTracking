<?php

namespace App\Http\Controllers;

use Session;

class AuthController
{
    public  static function IsManager(){
        if (!Session::has('user')||Session::get('user')->title==='admin'){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if (Session::get('user')->title!=='manager')
        {   abort(404,'Sorry, the page you are looking for could not be found.');
        }

    }


    public  static function SameCompany($item){
        if ($item->company_id&&$item->company_id!==Session::get('user')->company_id){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if($item->title&&$item->company_id!==Session::get('user')->company_id)
        {   abort(404,'Sorry, the page you are looking for could not be found.');}
        if($item->project_id&&$item->project->company_id!==Session::get('user')->company_id)
        {   abort(404,'Sorry, the page you are looking for could not be found.');}
        if($item->subsystem_id&&$item->subsystem->project->company_id!==Session::get('user')->company_id)
        {   abort(404,'Sorry, the page you are looking for could not be found.');}
        if($item->usecase_id&&$item->usecase->subsystem->project->company_id!==Session::get('user')->company_id)
        {   abort(404,'Sorry, the page you are looking for could not be found.');}
        if($item->testcase_id&&$item->testcase->usecase->subsystem->project->company_id!==Session::get('user')->company_id)
        {   abort(404,'Sorry, the page you are looking for could not be found.');}
        if($item->test_id&&$item->test->testcase->usecase->subsystem->project->company_id!==Session::get('user')->company_id)
        {   abort(404,'Sorry, the page you are looking for could not be found.');}

    }

    public  static function IsAdmin(){
        if (!Session::has('user')){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if (Session::get('user')->title!=='admin')
        {   abort(404,'Sorry, the page you are looking for could not be found.');
        }

    }

    public  static function IsNotDeveloper(){
        if (!Session::has('user')||Session::get('user')->title==='admin'){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if (Session::get('user')->title==='developer')
        {   abort(404,'Sorry, the page you are looking for could not be found.');
        }
    }

    public  static function IsDeveloper(){
        if (!Session::has('user')||Session::get('user')->title==='admin'){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
        if (Session::get('user')->title!=='developer')
        {   abort(404,'Sorry, the page you are looking for could not be found.');
        }
    }


    public  static function IsUser(){

        if (!Session::has('user')||Session::get('user')->title==='admin'){
            abort(404,'Sorry, the page you are looking for could not be found.');
        }
    }
}