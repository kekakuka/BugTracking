@extends('Shared._layout')
@section('title', 'Reports Index')
@section('content')

    <h2>Reports</h2>

    <br>
    <hr>
    <br>
    <div>
        <a class="btn btn-default " href="{{url('Reports/StaffReport')}}"> Staff Bug Assign Report</a> <a style="margin-left: 5%" class="btn btn-default " href="{{url('Reports/TesterReport')}}">Tester Report</a>
    </div>
    <div>

    </div>
    <br>
    <hr>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                Project Name
            </th>
            <th style="width: 40%">
                Description
            </th>
            <th >
                Status
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Projects as $Project)
            <tr>
                <td>
                    {{ $Project->id}}
                </td>
                <td>
                    {{ $Project->name}}
                </td>

                <td >
                    {{ $Project->description}}
                </td>
                <td >
                    {{ $Project->status}}
                </td>
                <td>
                    <a class="btn btn-default" href="{{url('Reports/ProjectReport/'.$Project->id)}}">Finshed Project Report</a>
                <td>
                    <a class="btn btn-default" href="{{url('Reports/TestingProjectReport/'.$Project->id)}}">Testing Project Report</a>
                </td>
                </td>
            </tr>
        @endforeach




        </tbody>
    </table>

@endsection