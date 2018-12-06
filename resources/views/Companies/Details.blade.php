@extends('Shared._layout')
@section('title', 'Company Details')
@section('content')

    <h2>Details/Delete</h2>

    <div>

        <hr />
        <dl class="dl-horizontal">
            <dt>
               Company Name
            </dt>
            <dd>
                {{ $Company->companyName}}
            </dd>
            <dt>
                Description
            </dt>
            <dd >
                {{ $Company->description}}
            </dd>






        </dl>
    </div>
    <div>
        <a href="{{url('Companies/')}}">Back to List</a>
        <hr>
        @if(Session::get('user')->title==='admin')
        <form method="post" action="{{url('Companies/Delete/'.$Company->id)}}">
            @csrf
            <label>Delete Password
                <input type="password" name="password"  />
            </label>
            <input type="submit" value="Delete" class="btn btn-default" /> |

        </form>
        @endif

    </div>

@endsection