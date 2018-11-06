@extends('Shared._layout')
@section('title', 'Staff Index')
@section('content')

    <h2>Tester Report</h2>
    <img id="img1" src="{{url('images/OpenClosed.jpg')}}" style="display:none;">
    <img id="img2" src="{{url('images/Numbers.jpg')}}" style="display:none;">
    <hr>
    <div>
        <form action="{{url('Reports/TesterReport')}}" method="get">
            <div class="form-actions no-color">

                    <label>Test Date From:</label><input style="margin-left:1%" placeholder="After" class="small" type="date"
                                                name="moreThanDate"
                                                value="@if(isset($_GET['moreThanDate'])){{ $_GET['moreThanDate']}}@endif"/>
                    -- <label>Test Date To:</label><input style="margin-left:1%" placeholder="Before" class="small" type="date"
                                                  name="lessThanDate"
                                                  value="@if(isset($_GET['lessThanDate'])){{ $_GET['lessThanDate']}}@endif"/>

                    <label style="margin-left: 2%" class="control-label">Project</label>
                    <select name="project_id" >

                        <option value="0">All Project</option>
                        @foreach($projects as $project)
                            @if(isset($_GET['project_id'])&&($_GET['project_id']!=0)&&$project->id==$_GET['project_id'])
                                <option selected value="{{$project->id}}">{{$project->id}}: {{$project->name}}</option>
                    @else
                                <option value="{{$project->id}}">{{$project->id}}: {{$project->name}}</option>
                            @endif
                        @endforeach

                    </select>
                <label style="margin-left: 2%"> Staff </label>   <select name="staff_id">


                    <option value="">All Testers</option>
                    @foreach($staffs as  $staff )
                        @if(isset($_GET['staff_id'])&&($_GET['staff_id']!=='')&&($_GET['staff_id']==$staff->id))
                            <option selected value="{{$staff->id}}">ID: {{$staff->id}} ; {{$staff->fullName}}</option>
                            @else
                        <option value="{{$staff->id}}">ID: {{$staff->id}} ; {{$staff->fullName}}</option>
                        @endif
                    @endforeach
                </select>

                    <input type="submit" value="Search" class="btn btn-default"/>


            </div>
        </form>
<br>
        <div>

            <span style="font-size: 19px">Note : Unfinished tests and Confirmation tests are not affected by the filter </span>
        </div>
        <br>
        <div>

            <a href="{{url('Reports')}}">Back to List</a>
        </div>
    </div>
    <hr>
    <div id="print">
        <div style="background-color:white;width:1144px; border: 1px solid">
            <div style="margin-left: 22px; width:1100px;font-family: 'Times New Roman'">
                <br>

                <div><P class="text-center" style="font-size: 26px">Summary</P></div>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        Staff ID
                                    </th>

                                    <th>
                                        Full Name
                                    </th>

                                    <th>
                                       Unfinished Tests
                                    </th>
                                    <th>
                                        Unfinished   Confirmation
                                    </th>
                                    <th>
                                       All Tests Number
                                    </th>
                                    <th>
                                       Finished Confirmation
                                    </th>
                                    <th>
                                      Work Time
                                    </th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($staffs as $staff)
                               <tr>
                                   <td>
                                    {{$staff->id}}
                                   </td>

                                   <td>
                                     {{$staff->fullName}}
                                   </td>
                                   @if($staff->UnifinishedTestNumber()>0)
                                   <td style="color: red">
                                       {{$staff->UnifinishedTestNumber()}}
                                   </td>
                                   @else
                                       <td>
                                           {{$staff->UnifinishedTestNumber()}}
                                       </td>
                                       @endif
                                   @if($staff->workload($staff->bugassigns))
                                       <td style="color: red">
                                           {{$staff->workload($staff->bugassigns)}}
                                       </td>
                                   @else
                                       <td>
                                           {{$staff->workload($staff->bugassigns)}}
                                       </td>
                                   @endif

                                   <td>
                                     {{$staff->myTests($moreThanDate,$lessThanDate, $selectProject)->count()}}
                                   </td>
                                   <td>{{$staff->tBugsAssigns($moreThanDate,$lessThanDate,$selectProject)->count()}}</td>
                                   <td>{{$staff->workTime($moreThanDate,$lessThanDate,$selectProject)}}</td>
                               </tr>

                @endforeach
                                </tbody>
                            </table>
                <div><P class="text-center" style="font-size: 26px">Tests List</P></div>
                @if(isset($_GET['staff_id'])&&($_GET['staff_id']!==''))
                       @foreach($staffs as $staff)
                                  @if($_GET['staff_id']==$staff->id)
                    <hr>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        ID: {{$staff->id}}
                                    </th>

                                    <th>
                                        Full Name: {{$staff->fullName}}
                                    </th>

                                    <th>
                                        Title: {{$staff->title}}
                                    </th>


                                </tr>

                                </thead>
                                <tbody>

                                @foreach($staff->tests as $test)
                                    @if($test->status==='testing')
                                        <tr>
                                            <td colspan="1"> ID: {{$test->id}}</td>            <td style="color: red;" colspan="2">  Need Testing</td> <td colspan="3">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                                        </tr>
                                        <tr> <td colspan="4">
                                                <div class="box">
                                                    Testcase: {{$test->testcase->name }} (Hover Details)
                                                    <div class="overbox">

                                                        <div class="tagline overtext">Description: {{$test->testcase->description }}<br>  Usecase: {{$test->testcase->usecase->name }}<br> Subsystem: {{$test->testcase->usecase->subsystem->name }}</div>
                                                    </div>
                                                </div></td><td colspan="2">Setting: {{$test->setting->description}} </td>

                                        </tr>
                                        <tr>

                                            @if($test->classification==='manual'&&$test->costTime!==null)
                                                <td colspan="2">
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
                                                <td colspan="3">
                                                    Status: {!! $test->testStatusTd() !!}
                                                </td>
                                            @endif
                                            @if($test->classification==='manual')
                                                <td>
                                                    Plan time: {{ $test->planTime }} hours
                                                </td>

                                                <td colspan="2">
                                                    Classification: {{$test->classification }}
                                                </td>



                                            @else
                                                <td colspan="3">
                                                    Classification: {{$test->classification }}
                                                </td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td style="background-color: white;" colspan="6"></td>
                                        <tr>
                                    @endif
                                @endforeach
                                @foreach($staff->bugassigns as $bugassign)
                                    @if($bugassign->status==='assigned')
                                        <tr>
                                            <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td>  <td style="color: red">Need Confirmation Testing</td>  <td colspan="3">Bug Description: {{$bugassign->bug->description}}</td><td colspan="1">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td></tr>


                                        <tr><td colspan="1">Bug RPN: {{$bugassign->bug->bugRPN }} </td> <td colspan="2">
                                                <div class="box">
                                                    Testcase: {{$bugassign->bug->test->testcase->name }} (Hover Details)
                                                    <div class="overbox">

                                                        <div class="tagline overtext">Description: {{$bugassign->bug->test->testcase->description }}<br>  Usecase: {{$bugassign->bug->test->testcase->usecase->name }}<br> Subsystem: {{$bugassign->bug->test->testcase->usecase->subsystem->name }}</div>
                                                    </div>
                                                </div></td><td colspan="2">Setting: {{$bugassign->bug->test->setting->description}} </td>
                                            <td colspan="1">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: white;" colspan="6"></td>
                                        <tr>
                                    @endif
                                @endforeach

                                @foreach($staff->myTests($moreThanDate,$lessThanDate, $selectProject) as $test)
                                    @if($test->status!=='testing')
                                        <tr>
                                            <td colspan="1"> ID: {{$test->id}}</td>            <td colspan="2">  Test Date: {{date_format($test->updated_at,'Y-m-d') }}</td> <td colspan="3">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                                        </tr>
                                        <tr> <td colspan="4">
                                                <div class="box">
                                                    Testcase: {{$test->testcase->name }} (Hover Details)
                                                    <div class="overbox">

                                                        <div class="tagline overtext">Description: {{$test->testcase->description }}<br>  Usecase: {{$test->testcase->usecase->name }}<br> Subsystem: {{$test->testcase->usecase->subsystem->name }}</div>
                                                    </div>
                                                </div></td><td colspan="2">Setting: {{$test->setting->description}} </td>

                                        </tr>
                                        <tr>

                                            @if($test->classification==='manual'&&$test->costTime!==null)
                                                <td colspan="2">
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
                                                <td colspan="3">
                                                    Test  Status: {!! $test->testStatusTd() !!}
                                                </td>
                                            @endif
                                            @if($test->classification==='manual')
                                                <td>
                                                    Plan time: {{ $test->planTime }} hours
                                                </td>

                                                <td colspan="2">
                                                    Classification: {{$test->classification }}
                                                </td>



                                            @else
                                                <td colspan="3">
                                                    Classification: {{$test->classification }}
                                                </td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <td style="background-color: white;" colspan="6"></td>
                                        <tr>
                                    @endif
                                @endforeach
                                @foreach($staff->tBugsAssigns($moreThanDate,$lessThanDate,$selectProject) as $bugassign)
                                    @if($bugassign->status==='pass'||$bugassign->status==='failed')
                                        <tr>
                                            <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td>  <td >Test Date: {{date_format($bugassign->updated_at,'Y-m-d') }}</td>  <td colspan="3">Bug Description: {{$bugassign->bug->description}}</td><td colspan="1">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td></tr>


                                        <tr><td colspan="1">Bug RPN: {{$bugassign->bug->bugRPN }} </td> <td colspan="2">
                                                <div class="box">
                                                    Testcase: {{$bugassign->bug->test->testcase->name }} (Hover Details)
                                                    <div class="overbox">

                                                        <div class="tagline overtext">Description: {{$bugassign->bug->test->testcase->description }}<br>  Usecase: {{$bugassign->bug->test->testcase->usecase->name }}<br> Subsystem: {{$bugassign->bug->test->testcase->usecase->subsystem->name }}</div>
                                                    </div>
                                                </div></td><td colspan="2">Setting: {{$bugassign->bug->test->setting->description}} </td>        <td colspan="1">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>

                                        </tr>
                                        <tr>

                                            @if($bugassign->bug->test->classification==='manual')
                                                <td colspan="2">Confirmation Testing Result:{!! $bugassign->bugResulttd() !!}</td>


                                            @if($bugassign->costTime>$bugassign->bug->test->planTime)
                                                <td style="color: red">
                                                    Cost time: {{ $bugassign->costTime}} hours
                                                </td>
                                                @else
                                                    <td>
                                                        Cost time: {{ $bugassign->costTime}} hours
                                                    </td>
                                                @endif

                                            @else
                                                <td colspan="3">Confirmation Testing Result:{!! $bugassign->bugResulttd() !!}</td>
                                            @endif
                                            @if($bugassign->bug->test->classification==='manual')
                                                <td>
                                                    Plan time: {{ $bugassign->bug->test->planTime }} hours
                                                </td>

                                                <td colspan="2">
                                                    Classification: {{$bugassign->bug->test->classification }}
                                                </td>



                                            @else
                                                <td colspan="3">
                                                    Classification: {{$bugassign->bug->test->classification }}
                                                </td>
                                    @endif




                                    <tr>
                                    <tr>
                                        <td style="background-color: white;" colspan="6"></td>
                                    <tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                    @endif
                    @endforeach
                @else
                    @foreach($staffs as $staff)
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                ID: {{$staff->id}}
                            </th>

                            <th>
                                Full Name: {{$staff->fullName}}
                            </th>

                            <th>
                                Title: {{$staff->title}}
                            </th>


                        </tr>

                        </thead>
                        <tbody>

                        @foreach($staff->tests as $test)
                            @if($test->status==='testing')
                                <tr>
                                    <td colspan="1"> ID: {{$test->id}}</td>            <td style="color: red;" colspan="2">  Need Testing</td> <td colspan="3">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                                </tr>
                                <tr> <td colspan="4">
                                        <div class="box">
                                            Testcase: {{$test->testcase->name }} (Hover Details)
                                            <div class="overbox">

                                                <div class="tagline overtext">Description: {{$test->testcase->description }}<br>  Usecase: {{$test->testcase->usecase->name }}<br> Subsystem: {{$test->testcase->usecase->subsystem->name }}</div>
                                            </div>
                                        </div></td><td colspan="2">Setting: {{$test->setting->description}} </td>

                                </tr>
                                <tr>

                                    @if($test->classification==='manual'&&$test->costTime!==null)
                                        <td colspan="2">
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
                                        <td colspan="3">
                                            Status: {!! $test->testStatusTd() !!}
                                        </td>
                                    @endif
                                    @if($test->classification==='manual')
                                        <td>
                                            Plan time: {{ $test->planTime }} hours
                                        </td>

                                        <td colspan="2">
                                            Classification: {{$test->classification }}
                                        </td>



                                    @else
                                        <td colspan="3">
                                            Classification: {{$test->classification }}
                                        </td>
                                    @endif

                                </tr>
                                <tr>
                                    <td style="background-color: white;" colspan="6"></td>
                                <tr>
                            @endif
                        @endforeach
                        @foreach($staff->bugassigns as $bugassign)
                            @if($bugassign->status==='assigned')
                            <tr>
                                <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td>  <td style="color: red">Need Confirmation Testing</td>  <td colspan="3">Bug Description: {{$bugassign->bug->description}}</td><td colspan="1">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td></tr>


                            <tr><td colspan="1">Bug RPN: {{$bugassign->bug->bugRPN }} </td> <td colspan="2">
                                    <div class="box">
                                        Testcase: {{$bugassign->bug->test->testcase->name }} (Hover Details)
                                        <div class="overbox">

                                            <div class="tagline overtext">Description: {{$bugassign->bug->test->testcase->description }}<br>  Usecase: {{$bugassign->bug->test->testcase->usecase->name }}<br> Subsystem: {{$bugassign->bug->test->testcase->usecase->subsystem->name }}</div>
                                        </div>
                                    </div></td><td colspan="2">Setting: {{$bugassign->bug->test->setting->description}} </td>
                                <td colspan="1">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                            </tr>
                            <tr>
                                <td style="background-color: white;" colspan="6"></td>
                            <tr>
                            @endif
                        @endforeach

                        @foreach($staff->myTests($moreThanDate,$lessThanDate, $selectProject) as $test)
                            @if($test->status!=='testing')
                                <tr>
                                    <td colspan="1"> ID: {{$test->id}}</td>            <td colspan="2">  Test Date: {{date_format($test->updated_at,'Y-m-d') }}</td> <td colspan="3">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                                </tr>
                                <tr> <td colspan="4">
                                        <div class="box">
                                            Testcase: {{$test->testcase->name }} (Hover Details)
                                            <div class="overbox">

                                                <div class="tagline overtext">Description: {{$test->testcase->description }}<br>  Usecase: {{$test->testcase->usecase->name }}<br> Subsystem: {{$test->testcase->usecase->subsystem->name }}</div>
                                            </div>
                                        </div></td><td colspan="2">Setting: {{$test->setting->description}} </td>

                                </tr>
                                <tr>

                                    @if($test->classification==='manual'&&$test->costTime!==null)
                                        <td colspan="2">
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
                                        <td colspan="3">
                                          Test  Status: {!! $test->testStatusTd() !!}
                                        </td>
                                    @endif
                                    @if($test->classification==='manual')
                                        <td>
                                            Plan time: {{ $test->planTime }} hours
                                        </td>

                                        <td colspan="2">
                                            Classification: {{$test->classification }}
                                        </td>



                                    @else
                                        <td colspan="3">
                                            Classification: {{$test->classification }}
                                        </td>
                                    @endif

                                </tr>
                                <tr>
                                    <td style="background-color: white;" colspan="6"></td>
                                <tr>
                            @endif
                        @endforeach
                        @foreach($staff->tBugsAssigns($moreThanDate,$lessThanDate,$selectProject) as $bugassign)
                            @if($bugassign->status==='pass'||$bugassign->status==='failed')
                                <tr>
                                    <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td>  <td >Test Date: {{date_format($bugassign->updated_at,'Y-m-d') }}</td>  <td colspan="3">Bug Description: {{$bugassign->bug->description}}</td><td colspan="1">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td></tr>


                                <tr><td colspan="1">Bug RPN: {{$bugassign->bug->bugRPN }} </td> <td colspan="2">
                                        <div class="box">
                                            Testcase: {{$bugassign->bug->test->testcase->name }} (Hover Details)
                                            <div class="overbox">

                                                <div class="tagline overtext">Description: {{$bugassign->bug->test->testcase->description }}<br>  Usecase: {{$bugassign->bug->test->testcase->usecase->name }}<br> Subsystem: {{$bugassign->bug->test->testcase->usecase->subsystem->name }}</div>
                                            </div>
                                        </div></td><td colspan="2">Setting: {{$bugassign->bug->test->setting->description}} </td>
                                    <td colspan="1">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>

                                </tr>
                                <tr>

                                    @if($bugassign->bug->test->classification==='manual')
                                        <td colspan="2">Confirmation Testing Result:{!! $bugassign->bugResulttd() !!}</td>


                                        @if($bugassign->costTime>$bugassign->bug->test->planTime)
                                            <td style="color: red">
                                                Cost time: {{ $bugassign->costTime}} hours
                                            </td>
                                        @else
                                            <td>
                                                Cost time: {{ $bugassign->costTime}} hours
                                            </td>
                                        @endif

                                    @else
                                        <td colspan="3">Confirmation Testing Result:{!! $bugassign->bugResulttd() !!}</td>
                                    @endif
                                    @if($bugassign->bug->test->classification==='manual')
                                        <td>
                                            Plan time: {{ $bugassign->bug->test->planTime }} hours
                                        </td>

                                        <td colspan="2">
                                            Classification: {{$bugassign->bug->test->classification }}
                                        </td>



                                    @else
                                            <td colspan="3">
                                                Classification: {{$bugassign->bug->test->classification }}
                                            </td>
                                    @endif




                                <tr>
                                <tr>
                                    <td style="background-color: white;" colspan="6"></td>
                                <tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    @endforeach
                @endif

            </div></div></div>
@endsection