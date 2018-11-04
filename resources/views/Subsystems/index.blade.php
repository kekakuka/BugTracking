@extends('Shared._layout')
@section('title', 'Subsystems Index')
@section('content')

    <h2>Index</h2>

    <p>
        @if(Session::has('user')&&Session::get('user')->title==='manager')
        <a href="{{url('Subsystems/Create')}}">Create New</a>
            @endif
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>
                 ID
            </th>
            <th>
            Subsystem Name
            </th>
            <th style="width: 55%">
             Description
            </th>
            <th>Project Name
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Subsystems as $Subsystem)
        <tr>
            <td>
                {{ $Subsystem->id}}
            </td>
            <td>
                {{ $Subsystem->name}}
            </td>

            <td>
                {{ $Subsystem->description}}
            </td>
            <td>
                {{ $Subsystem->project->name}}
            </td>
            <td>

                @if($Subsystem->project->status==='testing'&&Session::has('user')&&Session::get('user')->title==='manager')
                <a href="{{url('Subsystems/Edit/'.$Subsystem->id)}}">Edit</a> |
                @endif
                <a href="{{url('Subsystems/Details/'.$Subsystem->id)}}">Details</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection