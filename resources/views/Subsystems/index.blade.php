@extends('Shared.backend')
@section('title', 'Subsystems Index')
@section('content')

    <h2>Subsystems</h2>

    <p>
        @if(Session::has('user')&&Session::get('user')->title==='manager')
        <a href="{{url('Subsystems/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
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
            <th style="width: 30%">
             Description
            </th>
            <th>Project Name
            </th>
            <th width="17%"></th>
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
                <a href="{{url('Subsystems/Edit/'.$Subsystem->id)}}" class="btn btn-primary">Edit</a> |
                @endif
                <a href="{{url('Subsystems/Details/'.$Subsystem->id)}}" class="btn btn-info">Details</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
    {{$Subsystems->links()}}
@endsection