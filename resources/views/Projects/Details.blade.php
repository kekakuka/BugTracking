@extends('Shared.backend')
@section('title', 'Project Details')
@section('content')

    <h2>Details/Delete</h2>

    <div>

        <hr />
        <dl class="dl-horizontal">
            <dt>
               Project Name
            </dt>
            <dd>
                {{ $Project->name}}
            </dd>
            <dt>
                Description
            </dt>
            <dd >
                {{ $Project->description}}
            </dd>
            <dt>
               Status
            </dt>
            <dd >
                {{ $Project->status}}
            </dd>





        </dl>
    </div>
    <div>
        <a href="{{url('Projects/')}}">Back to List</a>
        <hr>
        {{--@if(Session::get('user')->title==='manager')--}}
        {{--<form method="post" action="{{url('Projects/Delete/'.$Project->id)}}">--}}
            {{--@csrf--}}
            {{--<label>Delete Password--}}
                {{--<input type="password" name="password"  />--}}
            {{--</label>--}}
            {{--<input type="submit" value="Delete" class="btn btn-default" /> |--}}

        {{--</form>--}}
        {{--@endif--}}

    </div>

@endsection