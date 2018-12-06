@extends('Shared._layout')
@section('title', 'Companies Index')
@section('content')

    <h2>Companies</h2>

    <p>
        @if(Session::has('user')&&Session::get('user')->title==='admin')

        <a href="{{url('Companies/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
            @endif
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>
                Company ID
            </th>
            <th>
            Company Name
            </th>
            <th style="width:48%">
             Description
            </th>

            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Companies as $Company)
        <tr>
            <td>
                {{ $Company->id}}
            </td>
            <td>
                {{ $Company->companyName}}
            </td>

            <td >
                {{ $Company->description}}
            </td>

            <td>

                <a href="{{url('Companies/Details/'.$Company->id)}}" class="btn btn-info">Details</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection