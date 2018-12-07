@extends('Shared._layout')
@section('title', 'Companies Index')
@section('content')

    <h2>Companies</h2>

    <p>
        @if(Session::has('user')&&Session::get('user')->title==='admin')

        <a href="{{url('Companies/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
            @endif
    </p>
    <table style="font-size: 17px" class="table">
        <thead>
        <tr>
            <th>
               ID
            </th>
            <th>
            Company Name
            </th>
            <th>
               First Manager Account
            </th>
            <th style="max-width:48%">
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
            <td>
                {{ $Company->staffs[0]->userName}}
            </td>
            <td >
                {{ $Company->description}}
            </td>

            <td>

                <a href="{{url('Companies/Details/'.$Company->id)}}" class="btn btn-warning">Details/Delete</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>
@endsection