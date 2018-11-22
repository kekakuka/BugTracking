@extends('Shared.backend')
@section('title', 'Staff Create')
@section('content')

    <h2>Create</h2>

    <h4>Staff</h4>
    <hr />

    <div class="row">

        <div class="col-md-5">
            <form method="post" action="{{url('Staff/Create')}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">UserName</label>
                    </span>  <input name="userName" value="{{ old('userName') }}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="ConfirmPassword">ConfirmPassword</label>
                   </span> <input id="password-confirm" type="password" name="password_confirmation" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Full Name</label>
                   </span>  <input name="fullName" value="{{ old('fullName') }}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Title</label>
                    <select  name="title" class="form-control">

                            <option  value="tester">Tester</option>
                        <option  value="developer">Developer</option>
                        <option  value="manager">Manager</option>
                    </select>
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
        <a href="{{url('Staff/')}}">Back to List</a>
    </div>
@endsection