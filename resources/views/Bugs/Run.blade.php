@extends('Shared._layout')
@section('title', 'Test Suite Index')
@section('content')

    <h2>Index</h2>
    <h3>  <a class="btn-default btn btn-lg" href="{{url('Bugs/Create')}}">Enter Tests/Bugs</a></h3>

    <table class="table">
        <thead>
        <tr>
            <th>ID
            </th>

            <th style="width:44%">
                Test Suite Summary
            </th>
            <th>Waiting/Total
            </th>
            <th>Project Name
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($Testsuites as $Testsuite)
            <tr>
                <td>
                    {{ $Testsuite->id}}
                </td>

                <td>
                    {{ $Testsuite->summary}}
                </td>
                <td>
                    {{ $Testsuite->waitingNumber()}}
                </td>
                <td>
                    {{ $Testsuite->project->name}}
                </td>
                <td>

                    @if($Testsuite->project->status==='testing'&&Session::has('user')&&Session::get('user')->title!=='developer')
                        <a href="{{url('Testsuites/Take/'.$Testsuite->id)}}">Take Tests</a>  |

                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection