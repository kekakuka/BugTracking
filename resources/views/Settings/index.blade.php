@extends('Shared._layout')
@section('title', 'Setting Index')
@section('content')

    <h2>Index</h2>

    <p>
        @if(Session::get('user')->title==='manager')
        <a href="{{url('Settings/Create')}}">Create New</a>
            @endif
    </p>
    <table class="table">
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
                <a href="{{url('Settings/Edit/'.$Setting->id)}}">Edit</a> |
                @endif

            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection