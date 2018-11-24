@extends('Shared.backend')
@section('title', 'Test Suite Details')
@section('content')

    <h2>Details</h2>
<hr>
    <div>
        <dl style="font-size: 120%" class="dl-horizontal">

            <dt>Testsuite: </dt>
            <dd>
                {{ $Testsuite->summary}}
            </dd>
            <dt>  Project: </dt>
            <dd>
                {{ $Testsuite->project->name}}
            </dd>
            <dt>  Setting:</dt>
            <dd>
                {{ $Testsuite->setting->description}}
            </dd>

            <dt> Tests Number: </dt><dd>   {{  $Testsuite->tests->count()}}</dd>
            <dt> Plan Time:</dt><dd> {{  $Testsuite->testsTime()}}</dd>



        </dl>
        <div>

            <a style="margin-left: 80px" href="{{url('Testsuites/')}}">Back to List</a>
        </div>
    </div>
<hr>

    <table style="width: 90%" class="table table-condensed" >
        <caption>   {{$tests->links()}}</caption>
        <tbody>
        <?php   $myCount=0 ?>
        @if($Testsuite->tests->count()>0)
            <div style="font-size: 22px;">Tests list:</div>
            <tr>
                @foreach($tests as $test)

                    @if ($myCount++% 3 === 0)

            </tr><tr>

                @endif

                <td>

                    <div style="border-radius:8px;width:270px;min-height:182px;" class="thumbnail text-center">
                        <br>



                        Test ID: {{ $test->id}}
                        <br>

                        @if(($test->status!=='waiting'&&$test->status!=='testing')&&$test->classification==='manual')

                            Status: {!! $test->testStatusTd() !!}
                            <br>
                            @if($test->costTime>$test->planTime )

                                Cost time: {{ $test->costTime}} hours
                                <br>
                            @else

                                Cost time: {{ $test->costTime}} hours
                                <br>
                            @endif
                        @else

                            Status: {!! $test->testStatusTd() !!}
                            <br>
                        @endif
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

                                <div class="tagline overtext">Description: {{$test->testcase->description }}<br>  Usecase: {{$test->testcase->usecase->name }}<br> Subsystem: {{$test->testcase->usecase->subsystem->name }}
                                    @if($test->staff_id!==null)
                                        <br> Tester: {{$test->staff->fullName }}
                                        @if($test->status!=='testing')
                                            <br> Test Date: {{date_format($test->updated_at,'Y-m-d') }}
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>





                    </div>


                @endforeach
            </tr>
        @endif
        </tbody>

    </table>


@endsection