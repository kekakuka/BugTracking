@extends('Shared._layout')
@section('title', 'Create Single Tests')
@section('content')

    <h3>Create/Review Single Tests </h3>


    <a href="{{url('/Bugs/Run')}}">Back to List</a>
    <hr/>
    @if(Session::has('stsuccess'))<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        {{Session::get('stsuccess')}}
    </div>
    @endif
    <div class="row">

        <div class="col-md-9">
            <form method="post" action="{{url('Testsuites/CreateSingle')}}">
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

                <div  id="newT">
                    <div  class="form-group">
                        <label class="control-label">Test Case</label>
                        <select  style="width:140%;" name="testcase_id" class="form-control">
                            @foreach($testcases as $testcase)
                                @if($testcase->usecase->subsystem->project->status==='testing')
                                    <option value="{{$testcase->id}}">Test Case: {{$testcase->id}}:{{$testcase->name}}| - - |  Usecase: {{$testcase->usecase->name}} | - - |  Project: {{$testcase->usecase->subsystem->project->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Setting</label>
                        <select  style="width:140%;" name="setting_id" class="form-control">
                            @foreach($settings as $setting)

                                <option value="{{$setting->id}}">Setting: {{$setting->id}}:{{$setting->description}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div  style="width: 50%;"  class="form-group">
                    <label  class="control-label" >Classification</label>
                    <select onchange="select()" id="classification"  name="classification"  class="form-control" >
                        <option  value="manual">Manual</option>
                        <option  value="automatic">Automatic </option>
                    </select>
                </div>

                <div style="width: 50%; height: 80%"  id="planTime" class="form-group">

                    <label  class="control-label">  Plan Time (Hours)</label>
                   <input id="planTime1" style="width: 20%;" type="text" name="planTime" value="1" class="form-control" />
                </div>

                <div class="form-group">
                    <input style="width: 100px" type="submit" class="btn btn-default"/>
                </div>

            </form>
        </div>

    </div>
    <hr>

    <table style="width: 90%" class="table table-condensed" >
        <tbody>
        <?php   $myCount=0 ?>
    @if($tests->count()>0)
        <div style="font-size: 22px;">Single Tests List:</div>
        <tr>
    @foreach($tests as $test)
                @if ($myCount++% 3 === 0)

        </tr><tr>

    @endif
            <td>

                <div style="border-radius:8px;width:270px;min-height:205px;" class="thumbnail text-center">
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


                    Setting: {{ $test->setting->description}}
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