@extends('Shared._layout')
@section('title', 'Developer Report')
@section('content')


    <ul class="breadcrumb" style="font-size: 16px;">
        <li><a href="{{url('/Reports')}}">Reports</a></li>
        <li class="active">Developer Report</li>
    </ul>
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


                        <option value="">All Developer</option>
                        @foreach($staffs as  $staff )
                           @if($staff->title==='developer')
                            @if(isset($_GET['staff_id'])&&($_GET['staff_id']!=='')&&($_GET['staff_id']==$staff->id))
                                <option selected value="{{$staff->id}}">ID: {{$staff->id}} ; {{$staff->fullName}}</option>
                            @else
                                <option value="{{$staff->id}}">ID: {{$staff->id}} ; {{$staff->fullName}}</option>
                            @endif
                          @endif
                        @endforeach
                    </select>

                    <input style="margin-left: 1%" type="submit" value="Search" class="btn btn-default"/>
                </p>
            </div>
        </form>
        <div class="pull-right">
            <button class="btn btn-default"><a href="{{url('Reports')}}" >Back to List</a></button>
        </div>
        <div>

            <span style="font-size: 15px" class="text-info">Note : Unfinished bug assign are not affected by the filter</span>
        </div>
    </div>
    <hr>
    <div id="print" style="padding: 0% 10%;">
        <div style="background-color:white;width: 100%; border: 1px solid darkgray; border-radius: 10px;">
            <div style="margin: 0 2%; width: 96%;font-family: 'Times New Roman'">
                <div><P class="text-center" style="font-size: 26px">Summary</P></div>

                            <table class="table table-striped table-responsive">

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
                                    <th>
                                        Work Time
                                    </th>
                                </tr>

                                </thead>  <tbody>
                                @foreach($staffs as $staff)
@if($staff->title==='developer')
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
                                        <td>
                                            {{$staff->developerTime($moreThanDate,$lessThanDate) }}
                                        </td>
                                    </tr>

@endif
                                @endforeach    </tbody>
                            </table>

                <br>
                <div><P class="text-center" style="font-size: 26px">Bug Assigns List</P></div>
                @if(isset($_GET['staff_id'])&&($_GET['staff_id']!==''))
                    @foreach($staffs as $staff)
                        @if($_GET['staff_id']==$staff->id&&$staff->title==='developer')
            <hr>
                    <table class="table table-striped table-responsive">
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
        </tr>

        </thead>
            <tbody>
            @foreach($staff->bugsAssigns($moreThanDate,$lessThanDate) as $bugassign)
                <tr>
                    <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td> @if($bugassign->status!=='assigned')   <td colspan="4">Bug Description: {{$bugassign->bug->description}}</td><td colspan="1">Cost Time: {{$bugassign->costTime}} Hours</td>@else<td colspan="5">Bug Description: {{$bugassign->bug->description}}</td>@endif</tr>
                <tr><td colspan="1">Bug RPN: {{$bugassign->bug->bugRPN }} </td><td colspan="2">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td>
                    @if($bugassign->status!=='assigned')  <td colspan="2">Finished Date:{{date_format($bugassign->updated_at,'Y-m-d')}} </td><td>Status: {{$bugassign->status}}</td>@else <td colspan="3">Finished Date:<span style="color: red">Not Finished</span></td>@endif
                </tr>

            @endforeach
            </tbody>
    </table>
                        @endif
                    @endforeach
                @else
                    @foreach($staffs as $staff)
                        @if($staff->title==='developer')
                        <hr>
                        <table class="table table-striped table-responsive">
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
                                    <td colspan="1">Bug ID: {{$bugassign->bug->id}}</td> @if($bugassign->status!=='assigned')   <td colspan="4">Bug Description: {{$bugassign->bug->description}}</td><td colspan="1">Cost Time: {{$bugassign->costTime}} Hours</td>@else<td colspan="5">Bug Description: {{$bugassign->bug->description}}</td>@endif</tr>
                                <tr><td colspan="1">Bug RPN: {{$bugassign->bug->bugRPN }} </td><td colspan="2">  Assigned Date: {{date_format($bugassign->created_at,'Y-m-d') }}</td>
                                    @if($bugassign->status!=='assigned')  <td colspan="2">Finished Date:{{date_format($bugassign->updated_at,'Y-m-d')}} </td><td>Status: {{$bugassign->status}}</td>@else <td colspan="3">Finished Date:<span style="color: red">Not Finished</span></td>@endif
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                        @endif
                    @endforeach
                @endif

            </div></div></div>
@endsection