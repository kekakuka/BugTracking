@extends('Shared._layout')
@section('title', 'Staff Details')
@section('content')

    <h2>Details</h2>

    <div>

        <hr />
        <dl class="dl-horizontal">
            <dt>
                Staff ID
            </dt>
            <dd>
                {{ $staff->id}}
            </dd>
            <dt>
                User Name
            </dt>
            <dd>
                {{ $staff->userName}}
            </dd>
            <dt>
               Full Name
            </dt>
            <dd>
                {{ $staff->fullName}}
            </dd>

            <dt>
              Title
            </dt>
            <dd>
                {{ $staff->title}}
            </dd>





        </dl>
    </div>
    <div>

        <a href="{{url('Staff/')}}">Back to List</a>
    </div>

    <hr>
    @if($unfinishedBugAssign->count()>0)
        @if(Session::get('user')->title==='manager')
        <div class="container">

                    <table class="table table-sm">
                        <caption>Assigned</caption>
                        <th style="width: 44%">Bug Description</th> <th>Bug State</th>  <th>Assign Date</th><th>ReAssign to</th><th></th></tr>
                        @foreach($unfinishedBugAssign as $bugassign)
                            <form method="post" action="{{url('Bugs/ReAssign/'.$bugassign->id)}}">
                                @csrf
                            <tr><td>{{$bugassign->bug->description}}</td><td>{{$bugassign->bug->state}}</td><td>{{date_format($bugassign->created_at,'Y-m-d') }}</td>
                               <td> <select  name="staff_id">
                                        @foreach($staffs as  $staff )
                                            <option value="{{$staff->id}}">ID: {{$staff->id}} ; {{$staff->fullName}}</option>
                                        @endforeach
                                       </select></td><td><input type="submit" class="btn btn-default">  </td></tr>
                            </form>
                        @endforeach
                    </table>

        </div>
            @else
            <div class="container">

                <table class="table table-sm">
                    <caption>Assigned Work</caption>
                    <th style="width: 64%">Bug Description</th><th>Bug State</th>  <th>Assign Date</th></tr>
                    @foreach($unfinishedBugAssign as $bugassign)
                        <form method="post" action="{{url('Bugs/ReAssign/'.$bugassign->id)}}">
                            @csrf
                            <tr><td>{{$bugassign->bug->description}}</td><td>{{$bugassign->bug->state}}</td><td>{{date_format($bugassign->created_at,'Y-m-d') }}</td>
                                </tr>
                        </form>
                    @endforeach
                </table>

            </div>

            @endif
    @endif
@endsection