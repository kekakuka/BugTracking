@extends('Shared._layout')
@section('title', 'Test Suite Details')
@section('content')

    <h2>Details</h2>

    <div>

        <hr />
        <dl class="dl-horizontal">
            <dt>
               Test Suite Summary
            </dt>
            <dd>
                {{ $Testsuite->summary}}
            </dd>

            <dt>
                Project
            </dt>
            <dd>
                {{ $Testsuite->project->name}}
            </dd>





        </dl>
    </div>
    <div>

        <a href="{{url('Testsuites/')}}">Back to List</a>
    </div>

@endsection