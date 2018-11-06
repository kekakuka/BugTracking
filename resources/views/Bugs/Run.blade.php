@extends('Shared._layout')
@section('title', 'Take Tests')
@section('content')

    <h2>Take Tests</h2>

    <table class="table">
        <thead>
        <tr>
            <th>ID
            </th>

            <th style="width:28%">
                Test Suite Summary
            </th>
            <th>My Test
            </th>
            <th>Waiting/Total
            </th>
            <th>Project Name
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Testsuites as $Testsuite)
            @if($Testsuite->project->status==='testing')
            <tr>
                <td>
                    {{ $Testsuite->id}}
                </td>


                <td>
                    {{ $Testsuite->summary}}
                </td>
                <td>
                    {{ $Testsuite->myTesting()}}
                </td>
                <td>
                    {{ $Testsuite->waitingNumber()}}
                </td>
                <td>
                    {{ $Testsuite->project->name}}
                </td>
                <td>






                    @if($Testsuite->project->status==='testing'&&Session::has('user')&&Session::get('user')->title!=='developer')
                        <a style="margin-top: -3px" class="btn btn-default" href="{{url('Testsuites/Set/'.$Testsuite->id)}}">Set/Create Tests</a>  |
                        <a style="margin-top: -3px" class="btn btn-default" href="{{url('Testsuites/Take/'.$Testsuite->id)}}">Take Tests</a>  |
                        <a style="margin-top: -3px" class="btn btn-default" href="{{url('Bugs/Create/'.$Testsuite->id)}}">Enter Tests/Bugs</a>
                    @endif

                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection