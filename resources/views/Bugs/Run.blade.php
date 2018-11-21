@extends('Shared._layout')
@section('title', 'Take Tests')
@section('content')

    <h2>Create/Take/Enter Tests</h2>
    <hr>
    <a style="margin-top: -3px" class="btn btn-default btn-lg" href="{{url('Testsuites/CreateSingle')}}">Create/Review Single Tests </a>  |
    <a style="margin-top: -3px" class="btn btn-default btn-lg" href="{{url('Testsuites/TakeSingle')}}"> Take Single Tests<span style="color:white;background-color:rgba(57,59, 219, 0.83);" class="badge">{{$SingleTestsNumber}}</span> </a>  |
    <a style="margin-top: -3px" class="btn btn-default btn-lg" href="{{url('Testsuites/EnterSingle')}}"> Enter Single Tests/Bugs <span style="color:white;background-color:rgba(117, 119, 129, 0.83);" class="badge">@if(Session::has('user')){{Session::get('user')->testsNumber(0)}}@endif</span> </a>
    <hr>
    <table class="table">
        <thead>
        <tr>
            <th>ID
            </th>

            <th>
                Test Suite Summary
            </th>
            <th>Setting
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
                    {{ $Testsuite->setting->description}}
                </td>


                <td>
                    {{ $Testsuite->project->name}}
                </td>
                <td>
                    @if($Testsuite->project->status==='testing'&&Session::has('user')&&Session::get('user')->title!=='developer')
                        <a style="margin-top: -3px" class="btn btn-default " href="{{url('Testsuites/Set/'.$Testsuite->id)}}">Create/Review Tests</a>  |
                        <a style="margin-top: -3px" class="btn btn-default " href="{{url('Testsuites/Take/'.$Testsuite->id)}}">Take Tests
                            <span style="color:white;background-color:rgba(57,59, 219, 0.83);"
                                  class="badge">
                                {{ $Testsuite->waitingNumber()}}
                            </span>
                        </a>
                        |
                        <a style="margin-top: -3px" class="btn btn-default" href="{{url('Bugs/Create/'.$Testsuite->id)}}">Enter Tests/Bugs
                            <span style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                  class="badge">
                                @if(Session::has('user'))
                                    {{Session::get('user')->testsNumber($Testsuite->id)}}
                                @endif
                            </span>
                        </a>
                    @endif

                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection