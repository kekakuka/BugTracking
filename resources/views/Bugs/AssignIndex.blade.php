@extends('Shared.backend')
@section('title', 'Bugs Assign')
@section('content')

    <h3>Bugs Assign</h3>

    <table class="table">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th style="max-width: 31%">
             Description
            </th>
            <th>
                Bug State
            </th>
            <th>
                Bug RPN
            </th>
            <th>
                Open Date
            </th>
            <th>Project Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Bugs as $Bug)
        <tr>
            <td>
                {{ $Bug->id}}
            </td>
            <td>
                {{ $Bug->description}}
            </td>

            <td>
                {{ $Bug->state}}
            </td>
            <td>
                {{ $Bug->bugRPN}}
            </td>
            <td>
                {{ date_format( $Bug->created_at,'d/m/Y')}}
            </td>
            <td>
                {{ $Bug->Test->testcase->Usecase->subsystem->project->name}}
            </td>
            <td>
                <a href="{{url('BugsAssign/Assign/'.$Bug->id)}}" class="btn btn-warning" style="color: #0f0f0f">Assign</a>

            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection