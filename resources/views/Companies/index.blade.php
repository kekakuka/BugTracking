@extends('Shared._layout')
@section('title', 'Companies Index')
@section('content')

    <ul class="breadcrumb" style="font-size: 16px;">
        <li><a href="{{url('/')}}">Home</a></li>
        <li class="active">Company Management</li>
    </ul>
    <hr>
    <div class="col-md-12  mainPart" style="margin-top: 0%">
        <div class="panel panel-default">
            <div class="panel-heading" style="background: linear-gradient(rgba(163, 165, 165, 0.1),rgba(123, 125, 125, 0.1))!important;height: 50px;">
                <ul class="breadcrumb">
                    <li>Manage</li>
                    <li>Company</li>

                </ul>
            </div>
            <div style="padding: 2% 5% 5% 5%;">
                <p>
                    @if(Session::has('user')&&Session::get('user')->title==='admin')

                        <a href="{{url('Companies/Create')}}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Create New</a>
                    @endif
                </p>
                <table style="font-size: 18px" class="table">
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
                        <th >
                            Staff Number
                        </th>
                        <th>Projects Number</th>
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
                                {{ $Company->staffs->count()}}
                            </td>
                            <td >
                                {{ $Company->projects->count()}}
                            </td>

                            <td>

                                <a href="{{url('Companies/Details/'.$Company->id)}}" class="btn btn-warning">Details/Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection