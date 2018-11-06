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
                <div class="form-group">
                    <input type="submit" class="btn btn-default"/>
                </div>

            </form>
        </div>

    </div>







    <div>

        <a   href="{{url('/Bugs/Run')}}">Back to List</a>
    </div>
    <table class="table" >
        <tbody>
        <tr >
            <td colspan="4">
                Testsuite Summay: {{ $Testsuite->summary}}
            </td>

        </tr>
        <tr >

            <td colspan="2">
                Project: {{ $Testsuite->project->name}}
            </td>
            <td   >
                Tests Number: {{  $Testsuite->tests->count()}}
            </td>
            <td  >
                Plan Time: {{  $Testsuite->testsTime()}}
            </td>
        </tr>

        </tbody>
    </table>
    @if($Testsuite->tests->count()>0)
            <div style="font-size: 22px;">Tests list:</div>
   @endif
        @foreach($Testsuite->tests->reverse() as $test)
            <table class="table table-bordered" >
                <tbody>
            <tr>
                <td>
                    Test ID: {{ $test->id}}
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
                    Testcase: {{$test->testcase->name }}
                </td>

                <td colspan="3">
                   Setting: {{ $test->setting->description}}
                </td>
            </tr>
            </tbody>
            </table>

            @endforeach

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