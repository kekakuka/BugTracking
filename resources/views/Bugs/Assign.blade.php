@extends('Shared._layout')
@section('title', 'Bug Assign')
@section('content')



    <h4>Assign Bug</h4>
    <hr/>

    <div class="row">

        <div class="col-md-12">
            <form method="post" action="{{url('Bugs/Assign/'.$bug->id)}}">
                @csrf
                <div class="col-md-6">

                    <div class="form-group">

                        <label> State: </label> <label>{{$bug->state}}</label>


                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        </span>  <textarea style="height: 150px" name="description"
                                           class="form-control">{{ $bug->description }}</textarea>
                    </div>

                    <div class="form-group">

                        <label>Severity</label>
                        <select onchange="select()" id="severity"  name="severity" >
                            <option value="{{$bug->severity}}">{{$bug->severity}}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label> </label>
                        <label> </label>
                        <label>Priority</label>
                        <select id="priority" onchange="select()"  name="priority" >
                            <option value="{{$bug->priority}}">{{$bug->priority}}</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label> </label>


                        <label>Bug RPN:  </label>
                        <label id="BUGRPN">  </label>
                        <br>
                        <label class="control-label">Estimated Fix Date</label>
                        @if($bug->estimatedFixDate!==null&&$bug->estimatedFixDate!=='')
                            <input type="date" name="estimatedFixDate" value="{{ $bug->estimatedFixDate }}"/>
                        @else
                            <input type="date" name="estimatedFixDate" value="{{$date}}"/>
                        @endif
                    </div>
                    <div class="form-group">

                        <label>Assign To: </label> <label> Developer</label>
                        <select name="staff_id">
                            @foreach($staffs as  $staff )
                            <option value="{{$staff->id}}">ID: {{$staff->id}} ; {{$staff->fullName}}</option>

                            @endforeach
                        </select>
                    </div>
                    <script>
                        window.onload=select();
                        function  select() {
                            var priority=  document.getElementById('priority');
                            var severity=  document.getElementById('severity');
                            var BUGRPN=  document.getElementById('BUGRPN');
                            BUGRPN.innerHTML=priority.value*severity.value;

                        }
                    </script>
                    <hr>
                    <h4>Optional Fields</h4>
                    <br>
                    <div class="form-group">

                        <label>Taxonomy</label>
                        <select name="taxonomy">
                            <option value="{{$bug->taxonomy}}">{{$bug->taxonomy}}</option>
                            <option value="functional">Functional</option>
                            <option value="system">System</option>
                            <option value="process">Process</option>
                            <option value="data">Data</option>
                            <option value="documentation">Documentation</option>
                            <option value="code">Code</option>
                            <option value="standards">Standards</option>
                            <option value="other">Other</option>
                            <option value="duplicate">Duplicate</option>
                            <option value="NAP">NAP</option>
                            <option value="badUnit">Bad Unit</option>
                            <option value="RCN">RCN</option>
                            <option value="unknown">Unknown</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <input type="submit" value="Assign The Bug" class="btn btn-default"/>
                        <a style="margin-left: 40px" class="btn btn-default" href="{{route('BugReject',$bug->id)}}">
                            Reject The Bug
                        </a>

                            <a class="col-lg-offset-1" href="{{url('Bugs/AssignIndex')}}">Back to List</a>

                    </div>
                    <div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-lg-offset-1">Test Information:</label>
                        <dl class="dl-horizontal">
                            <dt> Test Id:</dt>
                            <dd>{{$bug->test->id}}</dd>
                            <dt> Tester:</dt>
                            <dd>{{$bug->test->staff->fullName}}</dd>
                            <dt> Test Case:</dt>
                            <dd>{{$bug->test->testcase->name}}</dd>
                            <dt> Setting:</dt>
                            <dd>{{$bug->test->setting->description}}</dd>

                            <dt> Date:</dt>
                            <dd>{{date_format($bug->test->created_at,'d/m/Y')}}</dd>
                        </dl>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-offset-1">Other Information:</label>
                        <dl class="dl-horizontal">
                            <dt> Use Case</dt>
                            <dd>{{$bug->test->testcase->usecase->name}}</dd>
                            <dt> Subsystem:</dt>
                            <dd>{{$bug->test->testcase->usecase->subsystem->name}}</dd>
                            <dt> Project:</dt>
                            <dd>{{$bug->test->testcase->usecase->subsystem->project->name}}</dd>

                        </dl>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </form>

        </div>

    </div>
    @if($bug->bugassigns!==null&&$bug->bugassigns->count()>0)
    <hr/>
    <div >
        <dl class="dl-horizontal">
            <dt>
                Bug Assign:
            </dt>
            <dd>
                <table class="table">
                    <tr><th>Staff Name</th><th>Title</th><th>Status</th><th>Assign Date</th><th>Submit Date</th></tr>
                    @foreach($bug->bugassigns as $bugassign)
                        <tr><td>{{ $bugassign->staff->fullName}}</td><td>{{ $bugassign->staff->title}}</td><td>{{ $bugassign->status}}</td><td>{{date_format($bugassign->created_at,'Y-m-d') }}</td>
                            <td>@if($bugassign->status==='finished'){{date_format($bugassign->updated_at,'Y-m-d') }}@endif</td></tr>
                    @endforeach
                </table>
            </dd>
        </dl>
    </div>
@endif
@endsection