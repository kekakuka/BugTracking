@extends('Shared._layout')
@section('title', 'Take Tests')
@section('content')

    <h2>Create/Take/Enter Tests</h2>
    <hr>
    <a style="margin-top: -3px" class="btn btn-default btn-lg" href="{{url('Testsuites/CreateSingle')}}">Create/Review Single Tests </a>  |
    <a style="margin-top: -3px" class="btn btn-default btn-lg" href="{{url('Testsuites/TakeSingle')}}"> Take Single Tests @if($SingleTestsNumber!==0)<span style="color:white;background-color:rgba(204,114,101,0.98);" class="badge">{{$SingleTestsNumber}}</span> @endif</a>  |
    <a style="margin-top: -3px" class="btn btn-default btn-lg" href="{{url('Testsuites/EnterSingle')}}"> Enter Single Tests/Bugs @if(Session::has('user')&& Session::get('user')->testsNumber(0)!==0) <span style="color:white;background-color:rgba(117, 119, 129, 0.83);" class="badge">{{Session::get('user')->testsNumber(0)}} </span>  @endif</a>
    <hr>
    <table class="table">
        <caption>{{$Testsuites->links()}}</caption>
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
            <th style="width: 42% "></th>
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
                        <a style="margin-top: -3px" class="btn btn-default " href="{{url('Testsuites/Set/'.$Testsuite->id)}}">Create Tests</a>  |
                        <a style="margin-top: -3px" class="btn btn-default " href="{{url('Testsuites/Take/'.$Testsuite->id)}}">Take Tests
                           @if($Testsuite->waitingNumber()[0]!=="0")<span style="color:white;background-color:rgba(204,114,101,0.98);"
                                  class="badge">
                                {{ $Testsuite->waitingNumber()}}
                            </span>@endif
                        </a>
                        |
                        <a style="margin-top: -3px" class="btn btn-default" href="{{url('Bugs/Create/'.$Testsuite->id)}}">Enter Tests/Bugs
                            @if(Session::has('user')&&Session::get('user')->testsNumber($Testsuite->id)!==0)
                                <span style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                  class="badge">

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