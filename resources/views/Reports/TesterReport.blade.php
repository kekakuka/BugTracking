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


                    <option value="">All Staff</option>
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


        <div>

            <a href="{{url('Reports')}}">Back to List</a>
        </div>
    </div>
    <hr>
    <div id="print">
        <div style="background-color:white;width:744px; border: 1px solid">
            <div style="margin-left: 22px; width:700px;font-family: 'Times New Roman'">
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
                                        Title
                                    </th>

                                    <th>
                                        Finished Tests
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

                                   <td>
                                      {{$staff->title}}
                                   </td>

                                   <td>
                                     {{$staff->myTests($moreThanDate,$lessThanDate, $selectProject)->count()}}
                                   </td>
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

                            <th>
                                Finished Tests:{{$staff->myTests($moreThanDate,$lessThanDate, $selectProject)->count()}}
                            </th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($staff->myTests($moreThanDate,$lessThanDate, $selectProject) as $test)
                            <tr>
                                <td colspan="1">Test ID: {{$test->id}}</td>  <td colspan="2">  Test Date: {{date_format($test->created_at,'Y-m-d') }}</td> <td colspan="2">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                            </tr>
                            <tr> <td colspan="3">Setting: {{$test->setting->description}} </td><td colspan="2">Test Case: {{$test->testcase->name}}</td>
                            </tr>
                            <tr>
                                <td style="background-color: white;" colspan="5"></td>
                            <tr>
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

                            <th>
                                Finished Tests:{{$staff->myTests($moreThanDate,$lessThanDate, $selectProject)->count()}}
                            </th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach($staff->myTests($moreThanDate,$lessThanDate, $selectProject) as $test)
                            <tr>
                                <td colspan="1">Test ID: {{$test->id}}</td>  <td colspan="2">  Test Date: {{date_format($test->created_at,'Y-m-d') }}</td> <td colspan="2">Project: {{$test->testcase->usecase->subsystem->project->name}}</td>
                            </tr>
                            <tr> <td colspan="3">Setting: {{$test->setting->description}} </td><td colspan="2">Test Case: {{$test->testcase->name}}</td>
                            </tr>
                            <tr>
                                <td style="background-color: white;" colspan="5"></td>
                            <tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endforeach
                @endif

            </div></div></div>
@endsection