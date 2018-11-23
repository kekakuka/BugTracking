@extends('Shared.backend')
@section('title', 'Projects Index')
@section('content')

    <h2>Projects</h2>

    <p>
        @if(Session::has('user')&&Session::get('user')->title==='manager')

        <a href="{{url('Projects/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
            @endif
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>
                Project ID
            </th>
            <th>
            Project Name
            </th>
            <th style="width:48%">
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
                @if(Session::has('user')&&Session::get('user')->title==='manager')
                <a href="{{url('Projects/Edit/'.$Project->id)}}" class="btn btn-primary">Edit</a> |

                @endif
                <a href="{{url('Projects/Details/'.$Project->id)}}" class="btn btn-info">Details</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection