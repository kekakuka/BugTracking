@extends('Shared.backend')
@section('title', 'Usecases Index')
@section('content')

    <h2>Usecases</h2>

    <p>
        @if(Session::has('user')&&Session::get('user')->title==='manager')
        <a href="{{url('Usecases/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
            @endif
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>
               ID
            </th>
            <th>
          Usecase  Name
            </th>
            <th style="max-width:36%">
             Description
            </th>
            <th>Subsystem Name
            </th><th>Project Name
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Usecases as $Usecase)
        <tr>
            <td>
                {{ $Usecase->id}}
            </td>
            <td>
                {{ $Usecase->name}}
            </td>

            <td>
                {{ $Usecase->description}}
            </td>
            <td>
                {{ $Usecase->Subsystem->name}}
            </td>
            <td>
                {{ $Usecase->Subsystem->project->name}}
            </td>
            <td>
                @if($Usecase->Subsystem->project->status==='testing'&&Session::get('user')->title==='manager')
                <a href="{{url('Usecases/Edit/'.$Usecase->id)}}" class="btn btn-primary">Edit</a> |
                @endif
                <a href="{{url('Usecases/Details/'.$Usecase->id)}}" class="btn btn-info">Details</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection