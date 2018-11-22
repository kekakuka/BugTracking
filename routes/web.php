<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});


Route::prefix('Staff')->group(function () {
    Route::get('/', 'StaffController@index');
    Route::post('/Create', 'StaffController@CreatePost');
    Route::get('/Details/{id}', 'StaffController@Details');
    Route::get('/Create', 'StaffController@Create');
    Route::get('/Edit/{id}', 'StaffController@Edit');
    Route::post('/EditPost/{id}', 'StaffController@EditPost');
});

Route::get('/QA', function (){return view('home.QA');});

Route::prefix('Projects')->group(function () {
    Route::get('/', 'ProjectController@index');
    Route::post('/Create', 'ProjectController@CreatePost');
    Route::get('/Details/{id}', 'ProjectController@Details');
    Route::post('/Delete/{id}', 'ProjectController@DeletePost');
    Route::get('/Create', 'ProjectController@Create');
    Route::get('/Edit/{id}', 'ProjectController@Edit');
    Route::post('/EditPost/{id}', 'ProjectController@EditPost');
});

Route::prefix('Subsystems')->group(function () {
    Route::get('/', 'SubsystemController@index');
    Route::post('/Create', 'SubsystemController@CreatePost');
    Route::get('/Details/{id}', 'SubsystemController@Details');
    Route::get('/Create', 'SubsystemController@Create');
    Route::get('/Edit/{id}', 'SubsystemController@Edit');
    Route::post('/EditPost/{id}', 'SubsystemController@EditPost');
});


Route::prefix('Testsuites')->group(function () {
    Route::get('/', 'TestsuiteController@index');
    Route::post('/Create', 'TestsuiteController@CreatePost');
    Route::get('/Details/{id}', 'TestsuiteController@Details');
    Route::get('/Take/{id}', 'TestsuiteController@Take');
    Route::get('/TakeTest/{id}', 'TestsuiteController@TakeTest');
    Route::get('/Create', 'TestsuiteController@Create');
    Route::get('/Edit/{id}', 'TestsuiteController@Edit');
    Route::post('/EditPost/{id}', 'TestsuiteController@EditPost');
    Route::get('/Set/{id}', 'TestsuiteController@Set')->name('testsuiteSet');
    Route::post('/SetPost/{id}', 'TestsuiteController@SetPost');
    Route::get('/TakeSingle', 'TestsuiteController@TakeSingle')->name('testsuiteTakeSingle');
    Route::get('/CreateSingle', 'TestsuiteController@CreateSingle')->name('testsuiteCreateSingle');
    Route::get('/TakeSingle/{id}', 'TestsuiteController@TakeSinglePost');
    Route::post('/CreateSingle', 'TestsuiteController@CreateSinglePost');
    Route::get('/EnterSingle', 'TestsuiteController@EnterSingle');
    Route::post('/EnterSingle', 'TestsuiteController@EnterSinglePost');
});

Route::get('admin', 'AdminController@index');




Route::prefix('Settings')->group(function () {
    Route::get('/', 'SettingController@index');
    Route::post('/Create', 'SettingController@CreatePost');
    Route::get('/Create', 'SettingController@Create');
    Route::get('/Edit/{id}', 'SettingController@Edit');
    Route::post('/EditPost/{id}', 'SettingController@EditPost');
});


Route::prefix('Usecases')->group(function () {
    Route::get('/', 'UsecaseController@index');
    Route::post('/Create', 'UsecaseController@CreatePost');
    Route::get('/Details/{id}', 'UsecaseController@Details');
    Route::get('/Create', 'UsecaseController@Create');
    Route::get('/Edit/{id}', 'UsecaseController@Edit');
    Route::post('/EditPost/{id}', 'UsecaseController@EditPost');
});
Route::prefix('Testcases')->group(function () {
    Route::get('/', 'TestcaseController@index');
    Route::post('/Create', 'TestcaseController@CreatePost');
    Route::get('/Details/{id}', 'TestcaseController@Details');
    Route::get('/Create', 'TestcaseController@Create');
    Route::get('/Edit/{id}', 'TestcaseController@Edit');
    Route::post('/EditPost/{id}', 'TestcaseController@EditPost');
});
Route::prefix('Bugs')->group(function () {
    Route::get('/', 'BugController@index');
    Route::post('/Create/{id}', 'BugController@CreatePost');
    Route::get('/Run', 'BugController@Run');
    Route::get('/Details/{id}', 'BugController@Details');
    Route::get('/Create/{id}', 'BugController@Create')->name('BugCreate');
    Route::get('/Edit/{id}', 'BugController@Edit');

    Route::get('/StaffAssign/{id}', 'BugController@StaffAssign')->name('StaffAssign');

    Route::get('/Reject/{id}', 'BugController@Reject')->name('BugReject');
    Route::post('/EditPost/{id}', 'BugController@EditPost');

    Route::get('/MyWork', 'BugController@MyWork')->name('MyWork');
    Route::post('/MyWorkPost/{id}', 'BugController@MyWorkPost')->name('MyWorkPost');
    Route::post('/ReAssign/{id}', 'BugController@ReAssign')->name('ReAssign');
});
Route::prefix('BugsAssign')->group(function () {
    Route::get('/', 'BugController@AssignIndex')->name('BugAssignIndex');
    Route::post('/Assign/{id}', 'BugController@AssignPost');
    Route::get('/Assign/{id}', 'BugController@Assign');
});


Route::prefix('Reports')->group(function () {
    Route::get('/', 'ReportController@index');
    Route::get('/ProjectReport/{id}', 'ReportController@ProjectReport');
    Route::get('/TestingProjectReport/{id}', 'ReportController@TestingProjectReport');
    Route::get('/StaffReport', 'ReportController@StaffReport');
    Route::get('/TesterReport', 'ReportController@TesterReport');
});

Route::get('/', function () {
    return view('home.index');
});

Route::get('/Contact', function () {
    return view('home.Contact');
});

Auth::routes();

Route::get('/myLogin', 'Auth\LoginController@Login')->name('myLogin');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('login/LoginPost', 'Auth\LoginController@LoginPost');
Route::post('LogOut', 'Auth\LoginController@LogOut')->name('Logout');