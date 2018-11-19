@extends('Shared._layout')
@section('title', 'Create Single Tests')
@section('content')

    <h2> </h2>

    <h4>Create Single Tests</h4>
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
                    <input type="submit" class="btn btn-default"/>
                </div>

            </form>
        </div>

    </div>
    @if($tests->count()>0)
        <div style="font-size: 22px;">Single Tests List:</div>
    @endif
    @foreach($tests as $test)
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