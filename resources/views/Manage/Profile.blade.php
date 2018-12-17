@extends('Shared._layout')
@section('title', 'Profile')
@section('content')

    <ul class="breadcrumb" style="font-size: 16px;">
        <li><a href="{{url('/')}}">Home</a></li>
        <li class="active">Profile</li>
    </ul>
    <hr/>
    <div class="row">


        <div class="col-md-8 col-md-push-2 col-sm-push-4 col-xs-push-4 mainPart" style="margin-top: 1%;">
            <div class="panel panel-default">
                <div class="panel-heading"
                     style="background: linear-gradient(rgba(163, 165, 165, 0.1),rgba(123, 125, 125, 0.1))!important;height: 50px;">
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li>Profile</li>

                    </ul>
                </div>
                <div style="padding: 2% 5%;">
                    <h4>Change My Profile</h4>
                    @if(Session::has('PassSuccess'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            Your Password has been updated
                        </div>
                    @else <br>
                    @endif
                    @if(Session::has('passwordErrors'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            {{Session::get('passwordErrors')}}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{route('PasswordPost')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="userName">User Name</label>
                                    <input name="userName" value="{{Session::get('user')->userName}}"
                                           class="form-control" readonly/>
                                </div>
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input name="fullName" value="{{Session::get('user')->fullName}}"
                                           class="form-control" readonly/>
                                    <span aria-errormessage="LastName" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="OldPassword">Current Password</label>
                                    <input type="password" name="OldPassword" class="form-control"/>
                                    <span aria-errormessage="OldPassword" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="NewPassword">New Password</label>
                                    <input type="password" name="NewPassword" class="form-control"/>
                                    <span aria-errormessage="NewPassword" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                    <input type="password" name="ConfirmPassword" class="form-control"/>
                                    <span aria-errormessage="ConfirmPassword" class="text-danger"></span>
                                </div>
                                <button type="submit" class="btn btn-default">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>  </div>
@endsection