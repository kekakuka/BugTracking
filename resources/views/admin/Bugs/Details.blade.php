@extends('Shared.backend')
@section('title', 'Bug Details')
@section('content')

    <h2>Details</h2>

    <div>

        <hr/>
        <dl class="dl-horizontal">

            <dt>
                Description
            </dt>
            <dd>
                {{ $Bug->description}}
            </dd>

            <dt>
Bug state
            </dt>

            <dd>
                {{ $Bug->state}}
            </dd>
            <dt>
                Severity
            </dt>

            <dd>
                {{ $Bug->severity}}
            </dd>
            <dt>
                Priority
            </dt>

            <dd>
                {{ $Bug->priority}}
            </dd>
            <dt>
                RPN
            </dt>
            <dd>
                {{ $Bug->bugRPN}}
            </dd>

            <dt>
                Open date
            </dt>
            <dd>
                {{ date_format( $Bug->created_at,'Y-m-d')}}
            </dd>
            <dt>
                Estimated Fix Date
            </dt>
            <dd>
                {{  $Bug->estimatedFixDate}}
            </dd>
            <dt>
                Actual Fix Date
            </dt>
            <dd>
                {{ $Bug->actualFixDate}}
            </dd>
            <dt>
                Taxonomy
            </dt>
            <dd>
                {{ $Bug->taxonomy}}
            </dd>
            <dt>
               Tester
            </dt>
            <dd>
                {{ $Bug->Test->staff->fullName}}
            </dd>
            <dt>
Testcase
            </dt>
            <dd>
                {{ $Bug->Test->testcase->name}}
            </dd>
            <dt>
              Subsystem
            </dt>
            <dd>
                {{ $Bug->Test->testcase->Usecase->subsystem->name}}
            </dd>
            <dt>
                Project
            </dt>
            <dd>
                {{ $Bug->Test->testcase->Usecase->subsystem->project->name}}
            </dd>
            <dt>
                Bug Assign
            </dt>
            <dd>
                <table class="table">
                    <tr><th>Staff Name</th><th>Title</th><th>Status</th><th>Assign Date</th><th>Submit Date</th></tr>
                    @foreach($Bug->bugassigns as $bugassign)
                        <tr><td>{{ $bugassign->staff->fullName}}</td><td>{{ $bugassign->staff->title}}</td><td>{{ $bugassign->status}}</td><td>{{date_format($bugassign->created_at,'Y-m-d') }}</td>
                            <td>@if($bugassign->status!=='assigned'){{date_format($bugassign->updated_at,'Y-m-d') }}@endif</td></tr>
                    @endforeach

                </table>
            </dd>

        </dl>
        @if($Bug->bugcomments->count()>0)

            <div >
                <dl class="dl-horizontal">
                    <dt>
                        Bug Comments:
                    </dt>
                    <dd>
                        <table class="table">
                            <tr><th>Staff Name</th><th>Comment Date</th><th colspan="4">Comment</th></tr>
                            @foreach($Bug->bugcomments as $bugcomment)
                                <tr><td>{{ $bugcomment->staff->fullName}}</td><td>{{date_format($bugcomment->created_at,'Y-m-d') }}</td><td colspan="4">{{ $bugcomment->comment}}</td>

                            @endforeach
                        </table>
                    </dd>
                </dl>
            </div>
        @endif
    </div>
    <div>

        <a href="{{url('Bugs/')}}">Back to List</a>
    </div>

@endsection