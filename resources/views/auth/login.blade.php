@extends('Shared._layout')
@section('title', 'Login')
@section('content')


    <ul class="breadcrumb" style="font-size: 16px;">
        <li><a href="{{url('/')}}">Home</a></li>
        <li class="active">Log in</li>
    </ul>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="panel-title">
                        Management
                    </p>
                </div>
                <div class="panel-body" style="padding: 5% 10%;">
                    <section>
                        <form action="{{url('login/LoginPost')}}" method="post">
                            @if ($errors->any())
                                <div class="row alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                            <p class="text-info text-center">Use a local account to log in.</p>
                            <hr />

                            <div class="form-group row">
                                @if(isset($loginMessage))
                                    <span aria-errormessage="Email" class="text-danger">{{$loginMessage}}</span><br>
                                @endif
                                <label for="UserName" class="control-label col-md-4 text" style="color: #4e555b; font-size: 20px; font-weight: normal">Username</label>
                                    <div class="col-md-8"> <input name="userName" value="{{ old('userName') }}" class="form-control" style="height: 40px;"/>
                                        <span aria-errormessage="Email" class="text-danger"></span></div>

                            </div>
                            <div class="form-group row">
                                <label for="Password" class="control-label col-md-4 text" style="color: #4e555b; font-size: 20px; font-weight: normal">Password</label>
                                <div class="col-md-8">
                                <input type="password" name="password" class="form-control" style="height: 40px;"/>
                                <span aria-errormessage="Password" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-default" style="width: 60%;margin-top: 10%">
                                        Login
                                    </button>

                                </div>
                            </div>




                        </form>
                    </section>
                </div>
            </div>





        </div>
    </div>
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Login') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('login') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="form-check">--}}
                                    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{--<label class="form-check-label" for="remember">--}}
                                        {{--{{ __('Remember Me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-8 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Login') }}--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--{{ __('Forgot Your Password?') }}--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
