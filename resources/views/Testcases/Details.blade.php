@extends('Shared._layout')
@section('title', 'Testcase Details')
@section('content')

    <h2>Details</h2>

    <div>

        <hr />
        <dl class="dl-horizontal">
            <dt>
               Testcase Name
            </dt>
            <dd>
                {{ $Testcase->name}}
            </dd>
            <dt>
                Description
            </dt>
            <dd>
                {{ $Testcase->description}}
            </dd>
            <dt>
                Usecase
            </dt>
            <dd>
                {{ $Testcase->Usecase->name}}
            </dd>
            <dt>
               Subsystem
            </dt>
            <dd>
                {{ $Testcase->Usecase->subsystem->name}}
            </dd>
            <dt>
                Project
            </dt>
            <dd>
                {{ $Testcase->Usecase->subsystem-> Project->name}}
            </dd>
        </dl>
    </div>
    <div>

        <a href="{{url('Testcases/')}}">Back to List</a>
    </div>

@endsection