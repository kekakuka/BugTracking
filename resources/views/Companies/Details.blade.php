@extends('Shared._layout')
@section('title', 'Company Details')
@section('content')

    <h2>Details/Delete</h2>

    <div>

        <hr />
        <dl style="font-size: 18px" class="dl-horizontal">
            <dt>
               Company Name
            </dt>
            <dd>
                {{ $Company->companyName}}
            </dd>
            <dt>
                First Manager
            </dt>
            <dd>
                {{ $Company->staffs[0]->userName}}
            </dd>
            <dt>
                Description
            </dt>
            <dd >
                {{ $Company->description}}
            </dd>
            <dt>
                Projects
            </dt>
            <dd >
                {{ $Company->companyDetails()['projectNumber']}}
            </dd>
            <dt>
                Staff
            </dt>
            <dd >
                {{ $Company->companyDetails()['staffNumber']}}
            </dd>
            <dt>
                Test Suites
            </dt>
            <dd >
                {{ $Company->companyDetails()['testsuiteNumber']}}
            </dd>
            <dt>
               TestCases
            </dt>
            <dd >
                {{ $Company->companyDetails()['testcaseNumber']}}
            </dd>
            <dt>
                Bugs
            </dt>
            <dd >
                {{ $Company->companyDetails()['bugNumber']}}
            </dd>
            <dt>
                Bug Assigns
            </dt>
            <dd >
                {{ $Company->companyDetails()['bugAssignNumber']}}
            </dd>



        </dl>
    </div>@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <a style="font-size: 18px" href="{{url('Companies/')}}">Back to List</a>
        <hr>

        @if(Session::get('user')->title==='admin'&&$Company->id!==1)
            <div >

                <span style="font-size: 18px;" class="text-warning">Note: Clear means that all related data of the company will be deleted except the company itself and the first manager. <br>Delete means that the company and all related data of the company will be deleted.</span>
            </div><br>
            <form style="font-size: 18px;" method="post" action="{{url('Companies/Clear/'.$Company->id)}}">
                @csrf
                <label>Admin Password
                    <input type="password" name="clearPassword"  />
                </label>
                <input type="submit" value="Clear The  Company " class="btn btn-default" />

            </form><br>
        <form style="font-size: 18px;" method="post" action="{{url('Companies/Delete/'.$Company->id)}}">
            @csrf
            <label>Admin Password
                <input type="password" name="password"  />
            </label>
            <input type="submit" value="Delete The Company" class="btn btn-default" />

        </form>

        @endif

    </div>

@endsection