@extends('Shared.backend')
@section('title', 'My Work Index')
@section('content')

    <h3>My Work Index</h3>

    <table class="table">
        <thead>
        <tr>
            <th>
               ID
            </th>
            <th>
                Bug State
            </th>
            <th style="width: 40%">
                Description
            </th>

            <th>
                Bug RPN
            </th>
            <th>
                Open Date
            </th>
            <th>Project Name</th>

            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($myBugs as $Bug)
            <tr>
                <td>
                    {{ $Bug->bug->id}}
                </td>
                <td>
                    {{ $Bug->bug->state}}
                </td>
                <td>
                    {{ $Bug->bug->description}}
                </td>


                <td>
                    {{ $Bug->bug->bugRPN}}
                </td>
                <td>
                    {{ date_format( $Bug->created_at,'d/m/Y')}}
                </td>
                <td>
                    {{ $Bug->bug->test->testcase->usecase->subsystem->project->name}}
                </td>

                <td>
                        <a href="{{url('Bugs/StaffAssign/'.$Bug->id)}}">Solve</a> |

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection