@extends('Shared._layout')
@section('title', 'Project Report')
@section('content')

    <h2>Project  Report</h2>
    <img id="img1" src="{{url('images/OpenClosed.jpg')}}" style="display:none;">
    <img id="img2" src="{{url('images/Numbers.jpg')}}" style="display:none;">
    <hr>
    <div>
        {{--<form action="{{url('Reports/ProjectReport/'.$project->id)}}" method="get">--}}
        {{--<div class="form-actions no-color">--}}
        {{--<p>--}}

        {{--<label>After</label> <input style="margin-left:1%" placeholder="After" class="small" type="date"--}}
        {{--name="moreThanDate"--}}
        {{--value="@if(isset($_GET['moreThanDate'])){{ $_GET['moreThanDate']}}@endif"/>--}}
        {{--- <label>Before</label><input style="margin-left:1%" placeholder="Before" class="small" type="date"--}}
        {{--name="lessThanDate"--}}
        {{--value="@if(isset($_GET['lessThanDate'])){{ $_GET['lessThanDate']}}@endif"/>--}}
        {{--<input type="submit" value="Search" class="btn btn-default"/>--}}
        {{--</p>--}}
        {{--</div>--}}
        {{--</form>--}}


        <div>

            <a href="{{url('Reports')}}">Back to List</a>
            {{--<input style="margin-left: 5%" type="button" value="Print the report" class="btn btn-default"--}}
            {{--onclick="printDiv('print')"/>--}}

        </div>
    </div>
    <hr>
    <div id="print">
        <div style="background-color:white;width:1044px; border: 1px solid">
            <div style="margin-left: 22px; width:1000px;font-family: 'Times New Roman'">
                <br>
                <div><P class="text-center" style="font-size: 26px">Summary</P></div>

                <table style="font-size: 20px" class="table table-striped">
                    <tr>
                        <td> Project Name</td>
                        <td> {{ $project->name}}</td>
                    </tr>
                    <tr>
                        <td>   Description</td>
                        <td> {{ $project->description}}</td>
                    </tr>
                    <tr>
                        <td> Status</td>
                        <td>{{ $project->status}}</td>
                    </tr>
                    <tr>
                        <td>  Bugs Number</td>
                        <td id="isBugNumber">{{ $bugs->count()}}</td>
                    </tr>
                    <tr>
                        <td> Not Assigned Bugs</td>
                        <td >  {{ (int)($BugStates['open'])+(int)($BugStates['reOpened'])}}</td>
                    </tr>
                    <tr>
                        <td> Not Closed Bugs</td>
                        <td >  {{ (int)($BugStates['open'])+(int)($BugStates['reOpened'])}}</td>
                    </tr>



                    <tr>
                        <td> Waiting/Total Tests</td>
                        <td> <span style="color: red">{{ $project->WaitingTestsNumber($moreThanDate, $lessThanDate)}}</span>/   {{ $project->TestsNumber($moreThanDate, $lessThanDate)}}</td>
                    </tr>
                    <tr>
                        <td>Tests Pass(%)</td>
                        <td>{{ $project->PassRunNumber($moreThanDate, $lessThanDate)}} (Pass tests number/Run tests number)</td>
                    </tr>
                </table>

<br>

                <dl style="display: none" class="dl-horizontal">
                    <dt>
                        Bug Number:
                    </dt>
                    <dd id="isBugNumber">
                        {{ $bugs->count()}}
                    </dd>
                    <dt style="color:red">
                        Open:
                    </dt>
                    <dd id="isOpen">
                        {{$BugStates['open']}}
                    </dd>
                    <dt style="color:lightgreen">
                        Closed:
                    </dt>
                    <dd id="isClosed">
                        {{ $BugStates['closed']}}
                    </dd>
                    <dt style="color: yellow">
                        Assigned:
                    </dt>
                    <dd id="isAssigned">
                        {{ $BugStates['assigned']}}
                    </dd>
                    <dt style="color:blue">
                        Test:
                    </dt>
                    <dd id="isTest">
                        {{ $BugStates['test']}}
                    </dd>
                    <dt style="color:green">
                        Deferred:
                    </dt>
                    <dd id="isDeferred">
                        {{ $BugStates['deferred']}}
                    </dd>
                    <dt style="color:orange">
                        Rejected:
                    </dt>
                    <dd id="isRejected">
                        {{ $BugStates['rejected']}}
                    </dd>
                    <dt style="color:darkred">
                        Reopened:
                    </dt>
                    <dd id="isReopened">
                        {{ $BugStates['reOpened']}}
                    </dd>
                </dl>
                @if($bugs->count()>0)

                    <div class="row" id="canvasImg" style="width: 700px;height: 500px"></div>
                @endif

                <canvas style="display:none;" id="myCanvas" width="700" height="500"></canvas>

                <br>

                <ul>
                    @foreach($project->subsystems as $subsystem)

                        @if($subsystem->usecases->count()===0)
                            <li style="font-size: 24px">Subsystem: {{$subsystem->name}}:<span style="color: red"> No Usecases</span>
                            </li>
                        @endif

                    @endforeach
                    @foreach($project->subsystems as $subsystem)

                        <ul>
                            @foreach($subsystem->usecases as $usecase)
                                @if($usecase->testcases->count()===0)
                                    <li style="font-size: 22px;">Subsystem: {{$usecase->subsystem->name}} -
                                        Usecase: {{$usecase->name}}: <span style="color: red">No Testcases</span></li>
                                @endif
                            @endforeach
                        </ul>

                    @endforeach
                    @foreach($project->subsystems as $subsystem)

                        <ul>
                            @foreach($subsystem->usecases as $usecase)

                                <ul>
                                    @foreach($usecase->testcases as $testcase)
                                        @if($testcase->tests->count()===0)
                                            <li style="font-size: 20px;">
                                                Subsystem: {{$testcase->usecase->subsystem->name}} -
                                                Usecase: {{$testcase->usecase->name}} - Testcase: {{$testcase->name}}:
                                                <span style="color: red">No Tests</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>

                    @endforeach
                </ul>
<hr>
                <div><P class="text-center" style="font-size: 26px">Bugs List</P></div>
                @foreach($project->subsystems as $subsystem)
                    <br>
                    <table class="table table-striped">
                        <tbody>
                        <tr style="font-size: 120%;font-weight: bolder">
                            <td colspan="2">
                                Subsystem Name: {{ $subsystem->name}}
                            </td>
                            <td colspan="2">
                                Not Closed Bugs Number: {{ $subsystem->noClosedBugsCount()}}
                            </td>
                        </tr>
                        <tr style="font-size: 110%;font-weight: bolder">
                            <td colspan="4">
                                Description: {{ $subsystem->description}}
                            </td>

                        </tr>
                        @if($subsystem->noClosedBugsCount()>0)
                            <tr style="font-size: 120%">
                                <td colspan="8"> Not Closed Bugs list:</td>
                            </tr>@endif
                        @foreach($subsystem->bugs('2000-1-1','2099-1-1') as $Bug)
                            @if($Bug->state!=='closed'&&$Bug->state!=='deferred')
                                <tr>
                                    <td>
                                        Bug ID: {{ $Bug->id}}
                                    </td>

                                    <td>
                                        State: {{ $Bug->state}}
                                    </td>
                                    <td>
                                        Bug RPN: {!! $Bug->bugRPNtd() !!}
                                    </td>

                                    <td>
                                        Open date: {{ date_format( $Bug->created_at,'Y-m-d')}}
                                    </td>
                                </tr>

                                <tr>

                                    <td colspan="4">
                                        Description: {{ $Bug->description}}
                                    </td>

                                </tr><tr><td colspan="4">
                                        <div class="box">
                                            More  Details:
                                            <div class="overbox">
                                                <div class="tagline overtext">Test Description: {{$Bug->test->testcase->description }}<br>  Usecase: {{$Bug->test->testcase->usecase->name }}<br> Subsystem: {{$Bug->test->testcase->usecase->subsystem->name }}</div>
                                            </div>
                                        </div>
                                    </td></tr>
                                <tr>
                                    <td style="background-color: white;" colspan="4"></td>
                                <tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                    <br>
                    <hr>
                @endforeach


            </div>
        </div>
    </div>
    <script>
        window.onload = drawPieChart();


        function drawPieChart() {

            var c = document.getElementById("myCanvas");
            var context = c.getContext("2d");
            var isBugNumber = parseInt(document.getElementById("isBugNumber").innerHTML);
            var isReopened = parseInt(document.getElementById("isReopened").innerHTML);
            var isOpen = parseInt(document.getElementById("isOpen").innerHTML);
            var isRejected = parseInt(document.getElementById("isRejected").innerHTML);
            var isAssigned = parseInt(document.getElementById("isAssigned").innerHTML);
            var isTest = parseInt(document.getElementById("isTest").innerHTML);
            var isDeferred = parseInt(document.getElementById("isDeferred").innerHTML);
            var isClosed = parseInt(document.getElementById("isClosed").innerHTML);
            var img2 = document.getElementById("img2");
            context.drawImage(img2, 25, 5);
            context.font = 'bold 24px cursive';
            context.fillStyle = "black";
            context.fillText(isBugNumber, 175, 28);
            context.fillText(isOpen, 175, 61);
            context.fillText(isClosed, 175, 94);
            context.fillText(isAssigned, 175, 127);
            context.fillText(isTest, 175, 160);
            context.fillText(isDeferred, 175, 193);
            context.fillText(isRejected, 175, 226);
            context.fillText(isReopened, 175, 259);
            context.beginPath();
            context.moveTo(440, 210);
            context.lineTo(440 + 200, 210);
            context.arc(440, 210, 200, 0, (Math.PI / isBugNumber) * 2 * isReopened);
            context.lineTo(440, 210);
            context.fillStyle = "darkred";
            context.fill();
            context.stroke();
            context.closePath();
            context.beginPath();
            context.moveTo(440, 210);
            context.lineTo(440 + 200 * Math.cos(0 + (Math.PI / isBugNumber) * 2 * isReopened), 210 + 200 * Math.sin(0 + (Math.PI / isBugNumber) * 2 * isReopened));
            context.arc(440, 210, 200, 0 + (Math.PI / isBugNumber) * 2 * isReopened, (Math.PI / isBugNumber) * 2 * isReopened + (Math.PI / isBugNumber) * 2 * isOpen);
            context.lineTo(440, 210);
            context.fillStyle = "red";
            context.fill();
            context.stroke();
            context.closePath();
            isReopened += isOpen;

            context.beginPath();
            context.moveTo(440, 210);
            context.lineTo(440 + 200 * Math.cos(0 + (Math.PI / isBugNumber) * 2 * isReopened), 210 + 200 * Math.sin(0 + (Math.PI / isBugNumber) * 2 * isReopened));
            context.arc(440, 210, 200, 0 + (Math.PI / isBugNumber) * 2 * isReopened, (Math.PI / isBugNumber) * 2 * isReopened + (Math.PI / isBugNumber) * 2 * isRejected);
            context.lineTo(440, 210);
            context.fillStyle = "orange";
            context.fill();
            context.stroke();
            context.closePath();
            isReopened += isRejected;
            context.beginPath();
            context.moveTo(440, 210);
            context.lineTo(440 + 200 * Math.cos(0 + (Math.PI / isBugNumber) * 2 * isReopened), 210 + 200 * Math.sin(0 + (Math.PI / isBugNumber) * 2 * isReopened));
            context.arc(440, 210, 200, 0 + (Math.PI / isBugNumber) * 2 * isReopened, (Math.PI / isBugNumber) * 2 * isReopened + (Math.PI / isBugNumber) * 2 * isAssigned);
            context.lineTo(440, 210);
            context.fillStyle = "yellow";
            context.fill();
            context.stroke();
            context.closePath();
            isReopened += isAssigned;
            context.beginPath();
            context.moveTo(440, 210);
            context.lineTo(440 + 200 * Math.cos(0 + (Math.PI / isBugNumber) * 2 * isReopened), 210 + 200 * Math.sin(0 + (Math.PI / isBugNumber) * 2 * isReopened));
            context.arc(440, 210, 200, 0 + (Math.PI / isBugNumber) * 2 * isReopened, (Math.PI / isBugNumber) * 2 * isReopened + (Math.PI / isBugNumber) * 2 * isTest);
            context.lineTo(440, 210);
            context.fillStyle = "blue";
            context.fill();
            context.stroke();
            context.closePath();
            isReopened += isTest;
            context.beginPath();
            context.moveTo(440, 210);
            context.lineTo(440 + 200 * Math.cos(0 + (Math.PI / isBugNumber) * 2 * isReopened), 210 + 200 * Math.sin(0 + (Math.PI / isBugNumber) * 2 * isReopened));
            context.arc(440, 210, 200, 0 + (Math.PI / isBugNumber) * 2 * isReopened, (Math.PI / isBugNumber) * 2 * isReopened + (Math.PI / isBugNumber) * 2 * isDeferred);
            context.lineTo(440, 210);
            context.fillStyle = "green";
            context.fill();
            context.stroke();
            context.closePath();
            isReopened += isDeferred;
            context.beginPath();
            context.moveTo(440, 210);
            context.lineTo(440 + 200 * Math.cos(0 + (Math.PI / isBugNumber) * 2 * isReopened), 210 + 200 * Math.sin(0 + (Math.PI / isBugNumber) * 2 * isReopened));
            context.arc(440, 210, 200, 0 + (Math.PI / isBugNumber) * 2 * isReopened, (Math.PI / isBugNumber) * 2 * isReopened + (Math.PI / isBugNumber) * 2 * isClosed);
            context.lineTo(440, 210);
            context.fillStyle = "lightgreen";
            context.fill();
            context.stroke();
            context.closePath();
            context.font = '22px cursive';
            context.fillStyle ="darkgray";
            context.fillText('Project Report Chart 1: Bug State', 140 , 430);
            var img = c.toDataURL("image/png");
            var elem = document.createElement("img");
            elem.setAttribute("src", img);

            document.getElementById("canvasImg").appendChild(elem);
            // c.body.appendChild(img);
        }

    </script>

@endsection