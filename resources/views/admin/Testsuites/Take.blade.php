@extends('Shared.backend')
@section('title', 'Take Tests')
@section('content')


    <h2>Take Tests </h2>



    <div>
        <table class="table" >
            <tbody>
            <tr style="font-size: 130%">
                <td  colspan="3">
                    Testsuite Summay: {{ $Testsuite->summary}}
                </td>
                <td colspan="1">
                    Project: {{ $Testsuite->project->name}}
                </td>

            </tr>


            </tbody>
        </table>
        <a href="{{url('/Bugs/Run')}}">Back to List</a>
    </div>

    @if($Testsuite->waitingNumber()>0)
            <div style="font-size: 22px;">Waiting Tests list:</div>
   @endif
        @foreach($Testsuite->tests->reverse() as $test)
            @if($test->status==='waiting')


            <table class="table table-bordered" >
                <tbody>
            <tr>
                <td>
                    <a class="btn btn-default" href="{{url('Testsuites/TakeTest/'.$test->id)}}">Take the Test {{$test->id}}</a>
                </td>
                @if(($test->status!=='waiting'&&$test->status!=='testing')&&$test->classification==='manual')
                    <td>
                        Status: {!! $test->testStatusTd() !!}
                    </td>
                    @if($test->costTime>$test->planTime )
                    <td style="color: red">
                        Cost time: {{ $test->costTime}} hours
                    </td>
@else
                        <td>
                            Cost time: {{ $test->costTime}} hours
                        </td>
                    @endif
                @else
                    <td colspan="2">
                        Status: {!! $test->testStatusTd() !!}
                    </td>
                    @endif
                @if($test->classification==='manual')
                    <td>
                        Classification: {{$test->classification }}
                    </td>

                    <td>
                        Plan time: {{ $test->planTime }} hours
                    </td>


                @else
                    <td colspan="2">
                        Classification: {{$test->classification }}
                    </td>
                @endif

            </tr>
            <tr>
                <td colspan="2">

                    <div class="box">
                        Testcase: {{$test->testcase->name }}
                        <div class="overbox">

                            <div class="tagline overtext">Description: {{$test->testcase->description }}<br>  Usecase: {{$test->testcase->usecase->name }}<br> Subsystem: {{$test->testcase->usecase->subsystem->name }}</div>
                        </div>
                    </div>
                </td>

                <td colspan="3">
                   Setting: {{ $test->setting->description}}
                </td>
            </tr>
            </tbody>
            </table>
            @endif
            @endforeach
@endsection