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
                <div style="width: 70%;" class="form-group">
                    <label  class="control-label" >Classification</label>
                    <select  id="classification"  name="classification"   >
                        <option  value="manual">Manual</option>
                        <option  value="automatic">Automatic </option>
                    </select>


                     <label  class="control-label">  Plan Time</label>
                    </span>  <input type="number" name="planTime" value="{{ old('planTime') }}"  />
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

        <a href="{{url('Testsuites/')}}">Back to List</a>
    </div>
    <table class="table">
        <tbody>
        <tr >
            <td colspan="2">
                Testsuite Summay: {{ $Testsuite->summary}}
            </td>
            <td colspan="2">
                Project: {{ $Testsuite->project->name}}
            </td>
            <td   colspan="2">
               Tests Number: {{  $Testsuite->summary}}
            </td>
            <td   colspan="2">
                Plan Time: {{  $Testsuite->summary}}
            </td>
        </tr>

        @if($Testsuite->tests->count()>0)
            <tr style="font-size: 120%">
                <td colspan="8">Tests list:</td>
            </tr>@endif
        @foreach($Testsuite->tests as $test)
            <tr>
                <td>
                    Test ID: {{ $test->id}}
                </td>

                <td>
                    Status: {{ $test->status}}
                </td>
                <td>
                  Test classification: {{$test->classification }}
                </td>

                <td>
                   Plan time: {{ $test->planTime }} hours
                </td>
            </tr>
            <tr>
                <td>
                    Cost time: {{ $test->planTime}} hours
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection