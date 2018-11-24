@extends('Shared._layout')
@section('title', 'Set Test Suite')
@section('content')

    <h2>Set Test Suite</h2>

    <h4>Create Test under Test Suite</h4>
    <hr/>
    @if(isset($tsuccess))<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{$tsuccess}}
    </div>
    @endif
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
    <a style="margin-left: 70px" href="{{url('/Bugs/Run')}}">Back to List</a>
</div>
    <hr/>

    <div class="row">
        <div class="col-md-9">
            <form method="post" action="{{url('Testsuites/SetPost/'.$Testsuite->id)}}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                <div  style="width: 50%;"  class="form-group col-md-3">
                    <label  class="control-label" >Classification</label>
                    <select onchange="select()" id="classification"  name="classification"   >
                        <option  value="manual">Manual</option>
                        <option  value="automatic">Automatic </option>
                    </select>
                </div>

                <div style="width: 50%; height: 80%"  id="planTime" class="col-md-3 col-md-pull-2 form-group">

                     <label  class="control-label">  Plan Time</label>
                    <input  id="planTime1" style="width: 20%;" type="text" name="planTime" value="1"  /> Hours
                </div>
                </div>
                @if($testcases->count()>0)
                <div  >
                    <div  class="form-group">
                        <label class="control-label">Test Case</label>
                        <select  style="width:140%;" name="testcase_id" class="form-control">
                            @foreach($testcases as $testcase)
                                @if($testcase->usecase->subsystem->project->status==='testing')
                                    <option value="{{$testcase->id}}">Test Case: {{$testcase->id}}: {{$testcase->name}}: {{$testcase->description}} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="form-group">
                        <input style="width: 100px" type="submit" class="btn btn-default"/>
                    </div>
                    @else
                    <div  >
                        <div style="font-size: 19px; color: red" class="form-group">
                           All test cases have assembled into this test suite
                        </div>
                    </div>
                @endif


            </form>
        </div>

    </div>

    @if($Testsuite->tests->count()>0)
    <table style="width: 90%" class="table table-condensed" >
        <caption>{{$tests->links()}}</caption>
        <tbody>
        <?php   $myCount=0 ?>

     <div style="font-size: 22px;">Tests list:</div>
            <tr>
                @foreach( $tests as $test)

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





                        <div class="box"><span style="font-size: 115%;color: navy">
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

        </tbody>
    </table>

    @endif




    <script>
        function  select() {
            var classification=  document.getElementById('classification');
            var planTime=  document.getElementById('planTime');

if (classification.value==='manual'){
    planTime.style.display='block';
}
else {
    planTime.style.display='none';
}

        }
    </script>
@endsection