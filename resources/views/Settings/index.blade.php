@extends('Shared.backend')
@section('title', 'Setting Index')
@section('content')

    <h2>Setting</h2>

    <p>
        @if(Session::get('user')->title==='manager')
        <a href="{{url('Settings/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
            @endif
    </p>
    <table class="table table-responsive" style="width: 80%;">
        <thead>
        <tr>
            <th>
                 ID
            </th>

            <th>
             Description
            </th>

            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Settings as $Setting)
        <tr>
            <td>
                {{ $Setting->id}}
            </td>


            <td>
                {{ $Setting->description}}
            </td>

            <td>

                @if(Session::has('user')&&Session::get('user')->title==='manager')
                <a href="{{url('Settings/Edit/'.$Setting->id)}}" class="btn btn-primary">Edit</a>
                @endif

            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection