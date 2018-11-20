@extends('Shared.backend')
@section('title', 'Staff Edit')
@section('content')

    <h2>Edit</h2>

    <h4>Staff</h4>
    <hr />

    <div class="row">

        <div class="col-md-4">
            <form method="post" action="{{url('Staff/EditPost/'.$staff->id)}}">
                @csrf
                <div class="form-group">
                    <label  class="control-label">UserName</label>
                   </span>  <input readonly name="userName" value="{{$staff->userName}}" class="form-control" />
                </div>
                <div class="form-group">
                    <label  class="control-label">Full Name</label>
                   </span>  <input name="fullName" value="{{ $staff->fullName }}" class="form-control" />
                </div>
                {{--<div class="form-group">--}}
                    {{--<label  class="control-label">Title</label>--}}
                    {{--<select  name="title" class="form-control">--}}

                        {{--<option {{ $t }} value="tester">Tester</option>--}}
                        {{--<option {{$d}} value="developer">Developer</option>--}}
                        {{--<option  {{ $m }} value="manager">Manager</option>--}}

                        {{--</select>--}}
                {{--</div>--}}

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