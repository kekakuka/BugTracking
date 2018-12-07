@extends('Shared._layout')
@section('title', 'Company Create')
@section('content')

    <h2>Create</h2>

    <h4>Company</h4>
    <hr />

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{url('Companies/Create')}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">Company Name</label>
                   <input name="companyName" value="{{ old('companyName') }}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Description</label>
                <textarea style="height: 100px" name="description"  class="form-control" >{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label  class="control-label">First Manager UserName</label>
                    </span>  <input name="userName" value="{{ old('userName') }}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Manager Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="ConfirmPassword">Confirm Password</label>
                    </span> <input id="password-confirm" type="password" name="password_confirmation" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">First  Manager Full Name</label>
                    </span>  <input name="fullName" value="{{ old('fullName') }}" class="form-control" />
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <input type="submit"  class="btn btn-default" />
                </div>

            </form>
        </div>

    </div>

    <div>
        <a href="{{url('Companies/')}}">Back to List</a>
    </div>
@endsection