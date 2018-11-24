@extends('Shared.backend')
@section('title', 'Test Suite Index')
@section('content')

    <h2>Test Suites</h2>

    <p>
        @if(Session::has('user')&&Session::get('user')->title==='manager')
        <a href="{{url('Testsuites/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
            @endif
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>ID
            </th>

            <th style="width: 35%">
                Test Suite Summary
            </th>
            <th>Setting
            </th>
            <th>Project Name
            </th>
            <th width="17%"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Testsuites as $Testsuite)
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

                @if($Testsuite->project->status==='testing'&&Session::has('user')&&Session::get('user')->title==='manager')

                    <a href="{{url('Testsuites/Edit/'.$Testsuite->id)}}" class="btn btn-primary">Edit</a>  |

                @endif

                <a href="{{url('Testsuites/Details/'.$Testsuite->id)}}" class="btn btn-info">Details</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
    {{$Testsuites->links()}}
@endsection