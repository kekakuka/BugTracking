@extends('Shared._layout')
@section('title', 'Project Details')
@section('content')

    <h2>Details</h2>

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
        @if(Session::get('user')->title==='manager')
        <form method="post" action="{{url('Projects/Delete/'.$Project->id)}}">
            @csrf
            <label>Delete Password
                <input type="password" name="password"  />
            </label>
            <input type="submit" value="Delete" class="btn btn-default" /> |

        </form>
        @endif
        <a href="{{url('Projects/')}}">Back to List</a>
    </div>

@endsection