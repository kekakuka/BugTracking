@extends('Shared._layout')
@section('title', 'Subsystem Details')
@section('content')

    <h2>Details</h2>

    <div>

        <hr />
        <dl class="dl-horizontal">
            <dt>
               Subsystem Name
            </dt>
            <dd>
                {{ $Subsystem->name}}
            </dd>
            <dt>
                Description
            </dt>
            <dd>
                {{ $Subsystem->description}}
            </dd>
            <dt>
                Project
            </dt>
            <dd>
                {{ $Subsystem->project->name}}
            </dd>





        </dl>
    </div>
    <div>

        <a href="{{url('Subsystems/')}}">Back to List</a>
    </div>

@endsection