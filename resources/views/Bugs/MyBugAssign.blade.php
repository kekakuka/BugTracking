@extends('Shared._layout')
@section('title', 'Solve My Bugs')
@section('content')



    <h3>Solve My Bugs</h3>
    <hr/>
    <div>

        <a href="{{url('/Bugs/MyWork')}}">Back to List</a>
    </div>
    <hr/>

    <div class="row">

        <div class="col-md-12">
            <form method="post" action="{{url('Bugs/MyWorkPost/'.$bug->id)}}">
                @csrf
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Bug ID:</dt>
                        <dd>{{$bug->bug->id}}</dd>
                        <dt>State:</dt>
                        <dd>{{$bug->bug->state}}</dd>
                        <dt>Open Date:</dt>
                        <dd>{{ date_format( $bug->bug->created_at ,'d/m/Y')}}</dd>
                        <dt>Assign Date:</dt>
                        <dd>{{ date_format( $bug->created_at ,'d/m/Y')}}</dd>

                        <dt>Severity:</dt>
                        <dd>{{$bug->bug->severity}}</dd>
                        <dt>Priority:</dt>
                        <dd>{{$bug->bug->priority}}</dd>
                        <dt>Bug RPN:</dt>
                        <dd>{{$bug->bug->bugRPN}}</dd>
                        <dt>Estimated Fix Date:</dt>
                        <dd>{{ $bug->bug->estimatedFixDate }}</dd>
                        <dt>Description:</dt>
                        <dd>{{ $bug->bug->description }}</dd>
                        @if(Session::get('user')->title==='developer')

                            <div style="width: 100%; height: 80%" id="costTime" class="form-group">
                                <dt>Fix Time:</dt>
                              <dd>  <input id="costTime1" style="border-radius: 1px; width: 22%;" type="text" name="costTime" value="1"/> Hours
                              </dd> </div>
                        @else
                            @if($bug->bug->state!=='rejected'&&$bug->bug->test->classification==='manual')
                            <div style="width: 100%; height: 80%" id="costTime" class="form-group">
                                <dt> Cost Time:</dt>
                                <dd>   <input id="costTime1" style="border-radius: 1px; width: 15%;" type="text" name="costTime" value="1"/>Hours
                                </dd>   </div>
                            @endif

                        @endif

                       <div class="form-group">
                        <dt>Taxonomy:</dt>
                        <dd><select class="form-control" name="taxonomy">


                                @if(Session::get('user')->title==='developer')
                                    <option value="">---Select taxonomy---</option>
                                @endif
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
                                @if($bug->bug->taxonomy!==null&&$bug->bug->taxonomy!=='')
                                    <option selected value="{{$bug->bug->taxonomy}}">{{$bug->bug->taxonomy}}</option>
                                @endif
                            </select></dd>
                        </div>
                        @if(Session::get('user')->title==='developer')
                            <div class="form-group">
                            <dt>Assign To:</dt>
                            <dd><select class="form-control" name="staff_id">

                                    @foreach($staffs as  $staff )
                                        @if($staff->id!==Session::get('user')->id)
                                        @if($staff->id===$bug->bug->test->staff_id)
                                            <option selected value="{{$staff->id}}">ID: {{$staff->id}}
                                                ; {{$staff->fullName}}</option>
                                        @else
                                            <option value="{{$staff->id}}">ID: {{$staff->id}}
                                                ; {{$staff->fullName}}</option>
                                        @endif
                                        @endif
                                    @endforeach

                                </select></dd>
                            </div>
                        @else
                            <div class="form-group">
                            @if($bug->bug->state==='rejected')
                                <dt>Result:</dt>
                                <dd><select class="form-control" name="state">
                                        <option value="closed">Close the Bug</option>
                                        <option value="open">Open the Bug</option>
                                    </select></dd>
                            @else
                                <dt>Result:</dt>
                                <dd><select class="form-control" name="state">
                                        <option value="closed">Close the Bug</option>
                                        <option value="reOpened">Reopen the Bug</option>
                                    </select></dd>
                            @endif
                            </div>
                        @endif
                    </dl>
                    <div class="form-group">
                        <dt>Bug Comments (Optional)</dt>
                        <dd> <input name="comment" value="{{ old('comment') }}" class="form-control" /></dd>
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
                    <div class="form-group col-lg-offset-6">
                        <input type="submit" class="btn btn-default"/>
                    </div>


                    <hr>
                    <div class="form-group">


                        <a class="col-lg-offset-1" href="{{url('Bugs/MyWork')}}">Back to List</a>

                    </div>
                    <div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-lg-offset-1">Test Information:</label>
                        <dl class="dl-horizontal">
                            <dt> Test Id:</dt>
                            <dd>{{$bug->bug->test->id}}</dd>
                            <dt> Tester:</dt>
                            <dd>{{$bug->bug->test->staff->fullName}}</dd>
                            <dt> Test Case:</dt>
                            <dd>{{$bug->bug->test->testcase->name}}</dd>
                            <dt> Setting:</dt>
                            <dd>{{$bug->bug->test->setting->description}}</dd>
                            <dt> Test Plan Time:</dt>
                            <dd>{{$bug->bug->test->planTime}}</dd>
                            <dt> Date:</dt>
                            <dd>{{date_format($bug->bug->test->created_at,'d/m/Y')}}</dd>
                            <dt> Classification:</dt>
                            <dd>{{$bug->bug->test->classification}}</dd>
                        </dl>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-offset-1">Other Information:</label>
                        <dl class="dl-horizontal">
                            <dt> Use Case:</dt>
                            <dd>{{$bug->bug->test->testcase->usecase->name}}</dd>
                            <dt> Subsystem:</dt>
                            <dd>{{$bug->bug->test->testcase->usecase->subsystem->name}}</dd>
                            <dt> Project:</dt>
                            <dd>{{$bug->bug->test->testcase->usecase->subsystem->project->name}}</dd>

                        </dl>
                    </div>
                </div>
            </form>

        </div>

    </div>

    @if($bug->bug->bugassigns!==null&&$bug->bug->bugassigns->count()>0)

        <div>
            <dl class="dl-horizontal">
                <dt>
                    Bug Assign:
                </dt>
                <dd>
                    <table class="table">
                        <tr>
                            <th>Staff Name</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Cost Time</th>
                            <th>Assign Date</th>
                            <th>Submit Date</th>
                        </tr>
                        @foreach($bug->bug->bugassigns as $bugassign)
                            <tr>
                                <td>{{ $bugassign->staff->fullName}}</td>
                                <td>{{ $bugassign->staff->title}}</td>
                                <td>{{ $bugassign->status}} </td>
                                <td>
                                @if($bugassign->status!=='assigned')
                                        {{ $bugassign->costTime}}
                                @endif
                                </td>
                                <td>{{date_format($bugassign->created_at,'Y-m-d') }}</td>
                                <td>@if($bugassign->status!=='assigned'){{date_format($bugassign->updated_at,'Y-m-d') }}@endif</td>
                            </tr>
                        @endforeach
                    </table>
                </dd>
            </dl>
        </div>
    @endif
    @if($bug->bug->bugcomments->count()>0)

        <div >
            <dl class="dl-horizontal">
                <dt>
                    Bug Comments:
                </dt>
                <dd>
                    <table class="table">
                        <tr><th>Staff Name</th><th>Comment Date</th><th colspan="3">Comment</th></tr>
                        @foreach($bug->bug->bugcomments as $bugcomment)
                            <tr><td>{{ $bugcomment->staff->fullName}}</td><td>{{date_format($bugcomment->created_at,'Y-m-d') }}</td><td colspan="3">{{ $bugcomment->comment}}</td>

                        @endforeach
                    </table>
                </dd>
            </dl>
        </div>
    @endif
    <br>
    <hr>


@endsection