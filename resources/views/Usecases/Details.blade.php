@extends('Shared.backend')
@section('title', 'Usecase Details')
@section('content')

    <h2>Details</h2>

    <div>

        <hr />
        <dl class="dl-horizontal">
            <dt>
               Usecase Name
            </dt>
            <dd>
                {{ $Usecase->name}}
            </dd>
            <dt>
                Description
            </dt>
            <dd>
                {{ $Usecase->description}}
            </dd>
            <dt>
                Subsystem
            </dt>
            <dd>
                {{ $Usecase->Subsystem->name}}
            </dd>
            <dt>
               Project
            </dt>
            <dd>
                {{ $Usecase->Subsystem->Project->name}}
            </dd>




        </dl>
    </div>
    <div>

        <a href="{{url('Usecases/')}}">Back to List</a>
    </div>

@endsection