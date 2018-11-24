@extends('Shared._layout')
@section('title', 'Take Single Tests')
@section('content')


    <h2>Take Single Tests</h2>

    <div>
        <a href="{{url('/Bugs/Run')}}">Back to List</a>
    </div>
<hr> @if($tests->count()>0)
    <table style="width: 90%" class="table table-condensed" >
        <caption>{{$tests->links()}}</caption>
        <tbody>
        <?php   $myCount=0 ?>

            <div style="font-size: 22px;">Waiting Tests list:</div>
            <tr>
                @foreach($tests as $test)
                    @if($test->status==='waiting')
                        @if ($myCount++% 3 === 0)

            </tr><tr>

                @endif

                <td>

                    <div style="border-radius:8px;width:270px;min-height:170px;" class="thumbnail text-center">
                        <br>
                        <a class="btn btn-default" href="{{url('Testsuites/TakeTest/'.$test->id)}}">Take the Test {{$test->id}}</a>
                        <br>


                        Status: {!! $test->testStatusTd() !!}
                        <br>
                        @if($test->classification==='manual')

                            Classification: {{$test->classification }}

                            <br>

                            Plan time: {{ $test->planTime }} hours

                            <br>

                        @else

                            Classification: {{$test->classification }}
                            <br>
                        @endif

                        Testcase: {{$test->testcase->name }}
                        <br>
                        <div class="box"><span style="color: navy">
                     Check More Details</span>
                            <div class="overbox">

                                <div class="tagline overtext">Description: {{$test->testcase->description }}<br>  Usecase: {{$test->testcase->usecase->name }}<br> Subsystem: {{$test->testcase->usecase->subsystem->name }}</div>
                            </div>
                        </div>





                    </div>

                @endif
                @endforeach

            </tr>

        </tbody>
    </table>
         @else<div style="font-size: 130%;color: red">No Waiting Single Tests</div>
    @endif
@endsection