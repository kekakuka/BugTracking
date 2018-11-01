@extends('Shared._layout')
@section('title', 'Staff Index')
@section('content')

    <h2>Staff Bug Assign Report</h2>
    <img id="img1" src="{{url('images/OpenClosed.jpg')}}" style="display:none;">
    <img id="img2" src="{{url('images/Numbers.jpg')}}" style="display:none;">
    <hr>
    <div>
        <form action="{{url('Reports/StaffReport')}}" method="get">
            <div class="form-actions no-color">
                <p>

                    <label>Assigned Date From:</label><input style="margin-left:1%" placeholder="After" class="small" type="date"
                                                name="moreThanDate"
                                                value="@if(isset($_GET['moreThanDate'])){{ $_GET['moreThanDate']}}@endif"/>
                    -- <label>Assigned Date To:</label><input style="margin-left:1%" placeholder="Before" class="small" type="date"
                                                  name="lessThanDate"
                                                  value="@if(isset($_GET['lessThanDate'])){{ $_GET['lessThanDate']}}@endif"/>
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

                    <input style="margin-left: 1%" type="submit" value="Search" class="btn btn-default"/>
                </p>
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
                                        Unfinished Work
                                    </th>
                                    <th>
                                        Finished Work
                                    </th>
                                </tr>

                                </thead>  <tbody>
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
                                          @if($staff->workLoad($staff->bugassigns)>0)<span style="color: red">{{ $staff->workLoad($staff->bugassigns) }}</span>@else {{ $staff->workLoad($staff->bugassigns) }} @endif
                                        </td>
                                        <td>
                                           {{$staff->finishedWork($staff->bugassigns,$moreThanDate,$lessThanDate) }}
                                        </td>

                                    </tr>


                                @endforeach    </tbody>
                            </table>

                <br>
                <div><P class="text-center" style="font-size: 26px">Bug Assigns List</P></div>
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
                Unfinished Work:  @if($staff->workLoad($staff->bugassigns)>0)<span style="color: red">{{ $staff->workLoad($staff->bugassigns) }}</span>@else {{ $staff->workLoad($staff->bugassigns) }} @endif
            </th>
            <th>
                Finished Work:{{$staff->finishedWork($staff->bugassigns,$moreThanDate,$lessThanDate) }}
            </th>
        </tr>

        </thead>
            <tbody>
            @foreach($staff->bugsAssigns($moreThanDate,$lessThanDate) as $bugassign)
                <tr>
                    <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td>   <td colspan="4">Bug Description: {{$bugassign->bug->description}}</td></tr>
                <tr><td colspan="1">Bug RPN: {{$bugassign->bug->bugRPN }} </td><td colspan="2">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td>
                    <td colspan="2">Finished Date: @if($bugassign->status==='finished'){{date_format($bugassign->updated_at,'Y-m-d')}} @else <span style="color: red"> {{'Not Finished'}}</span>@endif</td>
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
                                   Name: {{$staff->fullName}}
                                </th>

                                <th>
                                    Title: {{$staff->title}}
                                </th>
                                <th>
                                    Unfinished:  @if($staff->workLoad($staff->bugassigns)>0)<span style="color: red">{{ $staff->workLoad($staff->bugassigns) }}</span>@else {{ $staff->workLoad($staff->bugassigns) }} @endif
                                </th>
                                <th>
                                    Finished:{{$staff->finishedWork($staff->bugassigns,$moreThanDate,$lessThanDate) }}
                                </th>
                                <th>

                                </th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($staff->bugsAssigns($moreThanDate,$lessThanDate) as $bugassign)
                                <tr>
                                    <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td>   <td colspan="3">Bug Description: {{$bugassign->bug->description}}</td><td colspan="2">Bug RPN: {{$bugassign->bug->bugRPN }} </td></tr>
                                <tr><td colspan="2">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td>
                                    <td colspan="2">Finished Date: @if($bugassign->status==='finished'){{date_format($bugassign->updated_at,'Y-m-d')}} @else <span style="color: red"> {{'Not Finished'}}</span>@endif</td><td colspan="2">Project: {{$bugassign->bug->test->testcase->usecase->subsystem->project->name}}</td>
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