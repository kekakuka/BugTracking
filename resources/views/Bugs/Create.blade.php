@extends('Shared._layout')
@section('title', 'Bug Create')
@section('content')

    <h2> </h2>

    <h4>Bug/Test Enter</h4>
    <hr/>
    @if(Session::has('csuccess'))<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
       {{Session::get('csuccess')}}
    </div>
    @endif
    <div class="row">

        <div class="col-md-9">
            <form method="post" action="{{url('Bugs/Create')}}">
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
                <div class="form-group">
                    <label >New Test / Current Tests</label>
                    <select id="ifNewTest" onchange="check()"  style="width:60%;" name="ifNewTest" class="form-control">


                        <option  value="1">Enter Bug with new Test </option>
                        <option  value="2">Enter Bug with current Tests</option>
                        <option  value="3">Only Enter new Test</option>

                    </select>
                </div>
                <hr>
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
                <div  style="display: none" id="currentT" class="form-group">
                    <label class="control-label">Test</label>
                    <select  style="width:140%;" name="test_id" class="form-control">
                        @foreach($tests as $test)

                            @if($test->testcase->usecase->subsystem->project->status==='testing'&&$test->staff_id===Session::get('user')->id)
                            <option value="{{$test->id}}">Test Id: {{$test->id}}| -- | Tester:{{$test->staff->fullName}}; Testcase: {{$test->testcase->name}}; Setting: {{$test->setting->description}}; Date: {{date_format($test->created_at,'d/m/Y')}} </option>
@endif
                        @endforeach
                    </select>
                </div>


                <hr><div id="enterBug">
                <div class="form-group">
                    <label class="control-label">Description</label>
                    </span>  <textarea style="height: 150px" name="description"
                                       class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">

                    <label >Severity</label>
                    <select onchange="select()" id="severity"  name="severity" >

                        <option  value="1">1: Loss of data, hardware damage, safety issue.</option>
                        <option  value="2">2: Loss of functionality with no workaround.</option>
                        <option  value="3">3: Loss of functionality with a workaround.</option>
                        <option  value="4">4: Partial loss of functionality.</option>
                        <option  value="5">5: Cosmetic or trivial.</option>
                    </select>
                    <label>  </label>
                    <label>  </label>
                    <label  >Priority</label>
                    <select id="priority" onchange="select()"  name="priority" >

                        <option  value="1">1: Complete loss of system value.</option>
                        <option  value="2">2: Unacceptable loss of system value.</option>
                        <option  value="3">3: Possibly acceptable reduction in system value.</option>
                        <option  value="4">4: Acceptable reduction in system value.</option>
                        <option  value="5">5: Negligible reduction in system value.</option>
                    </select>
                    <label>  </label>
                    <br>
                    <label style="font-size: 27px">Bug RPN:  </label>
                    <label id="BUGRPN" style="font-size: 27px"> 1 </label>
                    <br>
                </div>
                <hr>
                <h4>Optional Fields</h4>
                <br>
                <div class="form-group">
                    <label  class="control-label">Estimated Fix Date</label>
                    <input type="date" name="estimatedFixDate" value="{{ old('estimatedFixDate') }}"  />
                    <label>  </label>
                    <label>  </label>
                    <label  >Taxonomy</label>
                    <select  name="taxonomy" >
                        <option  value="">-----Select Taxonomy------</option>
                        <option  value="functional">Functional</option>
                        <option  value="system">System</option>
                        <option  value="process">Process</option>
                        <option  value="data">Data</option>
                        <option value="documentation">Documentation</option>
                        <option  value="code">Code</option>
                        <option  value="standards">Standards</option>
                        <option  value="other">Other</option>
                        <option value="duplicate">Duplicate</option>
                        <option  value="NAP">NAP</option>
                        <option  value="badUnit">Bad Unit</option>
                        <option  value="RCN">RCN</option>
                        <option value="unknown">Unknown</option>
                    </select>
                </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-default"/>
                </div>

            </form>
        </div>

    </div>
<script>
function  select() {
  var priority=  document.getElementById('priority');
    var severity=  document.getElementById('severity');
    var BUGRPN=  document.getElementById('BUGRPN');
    BUGRPN.innerHTML=priority.value*severity.value;

}
</script>
    <div>
        <a href="{{url('/')}}">Back to Home Page</a>
    </div>
    <br><hr>
    <div>Functional<br>
        Specification. The specification is wrong.<br>
        Function. The specification is right, but implementation is wrong.<br>
        Test. The system works correctly, but the test reports a spurious error.<br>
<br><hr>
        System<br>
        Internal Interface. The internal system communication failed.<br>
        Hardware Devices. The hardware failed.<br>
        Operating System. The operating system failed.<br>
        Software Architecture. A fundamental design assumption proved invalid.<br>
        Resource Management. The design assumptions are OK, but some implementation of the assumption is wrong.<br>
        <br><hr>
        Process<br>
        Arithmetic. The program incorrectly adds, divides, multiplies, factors, integrates numerically, or otherwise fails to perform an arithmetic operation properly.
        Initialization. An operation fails on its first use.<br>
        Control or Sequence. An action occurs at the wrong time or for the wrong reason.<br>
        Static Logic. Boundaries are misdefined, logic is invalid, “can’t happen” events do happen, “won’t matter” events do matter, and so forth.<br>
        Other. A control-flow or processing error occurs that doesn’t fit in the preceding buckets.<br>
        <br><hr>
        Data<br>
        Type. An integer should be a float, an unsigned integer stores or retrieves a negative value, an object is improperly defined, and so forth.<br>
        Structure. A complex data structure is invalid or inappropriate.<br>
        Initial Value. A data element’s initialized value is incorrect. (This might not result in a process initialization error.)<br>
        Other. A data-related error occurs that doesn’t fit in the preceding buckets.<br>
        <br><hr>
        Code<br>
        A typo, misspelling, stylistic error, or other coding error occurs that results in a failure.
        <br>
        Documentation<br>
        The documentation says the system does X on condition Y, but the system does Z—a valid and correct action—instead.
        <br>
        Standards<br>
        The system fails to meet industry or vendor standards, follow code standards, adhere to naming conventions, and so forth.
        <br>
        Other<br>
        The root cause is known, but fits none of the preceding categories.
        <br>
        Duplicate<br>
        Two bug reports describe the same bug. (This can happen when two testers report the same symptom, or when two testers report different symptoms that share the same underlying code problem.)
        <br>
        NAP<br>
        The bug as described in the bug report is “not a problem” because the operation noted is correct. The report arises from a misunderstanding on the part of the tester about correct behavior. This situation is distinct from a test failure (whose root cause is cate- gorized as functional/test) in that this is tester failure; that is, human error.
        <br>
        Bad Unit<br>
        The bug is a real problem, but it arises from a random hardware failure that is unlikely to occur in the field. (If the bug indicates a lack of reliability in some hardware compo- nent, this is not the root cause.)
        <br>
        RCN<br>
        A “root cause needed”; the bug is confirmed as closed by test, but no one in develop- ment has supplied a root cause.
        <br>
        Unknown<br>
        No one knows what is broken. This root cause usually fits best when a sporadic bug doesn’t appear for quite awhile, leading people to conclude that some other change fixed the bug as a side effect.</div>
@endsection