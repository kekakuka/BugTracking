@extends('Shared._layout')
@section('title', 'Project Report')
@section('content')

    <h2>Project Report</h2>
    <img id="img1" src="{{url('images/OpenClosed.jpg')}}" style="display:none;">
    <img id="img2" src="{{url('images/Taxonomy.jpg')}}" style="display:none;">
    <hr>
    <div>
        <form action="{{url('Reports/ProjectReport/'.$project->id)}}" method="get">
            <div class="form-actions no-color">
                <p>

                    <label>From:</label> <input style="margin-left:1%" placeholder="After" class="small" type="date"
                                                name="moreThanDate"
                                                value="@if(isset($_GET['moreThanDate'])){{ $_GET['moreThanDate']}}@endif"/>
                    - <label>To:</label><input style="margin-left:1%" placeholder="Before" class="small" type="date"
                                                  name="lessThanDate"
                                                  value="@if(isset($_GET['lessThanDate'])){{ $_GET['lessThanDate']}}@endif"/>

                    <input type="submit" value="Search" class="btn btn-default"/>
                </p>
            </div>
        </form>


        <div>

            <a href="{{url('Reports')}}">Back to List</a>

        </div>
    </div>
    <hr>
    <div id="print">
        <div style="background-color:white;width:1044px; border: 1px solid">
            <div style="margin-left: 22px; width:1000px;margin-right: 22px;font-family: 'Times New Roman'">
                <br>
                <div><P class="text-center" style="font-size: 26px">Summary</P></div>
                <div id="projectReportBar" style="width: 800px; height: 400px; margin: 0 auto"></div>
                <div id="projectReportLine" style="width: 800px; height: 400px; margin: 0 auto"></div>
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
                        <td> Bugs Number</td>
                        <td>{{ $bugs->count()}}</td>
                    </tr>
                    <tr>
                        <td>Over Time Bugs</td>
                        <td style="color: red">  {{ $project->overTimeBugsNumbers($moreThanDate, $lessThanDate)}}</td>
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

                    <dl style="display: none;">
                        @foreach($project->bugsOpenClosed($moreThanDate,$lessThanDate) as $item)
                            <dt>
                                Date:
                            </dt>
                            <dd class="oneDay">{{$item->date}}
                            </dd>
                            <dt>
                                Open number:
                            </dt>
                            <dd class="oneDayOpens">{{ $item->countOpen}}
                            </dd>
                            <dt>
                                Closed Number:
                            </dt>
                            <dd class="oneDayCloseds">{{$item->countClosed}}
                            </dd>
                        @endforeach
                    </dl>


                <dl style="display: none" class="dl-horizontal">

                    <dt >
                        System:
                    </dt>
                    <dd id="isSystem">
                        {{$BugTaxonomy['system']}}
                    </dd>
                    <dt >
                        Functional:
                    </dt>
                    <dd id="isFunctional">
                        {{ $BugTaxonomy['functional']}}
                    </dd>
                    <dt >
                        Process:
                    </dt>
                    <dd id="isProcess">
                        {{ $BugTaxonomy['process']}}
                    </dd>
                    <dt >
                        Data:
                    </dt>
                    <dd id="isData">
                        {{ $BugTaxonomy['data']}}
                    </dd>
                    <dt >
                        Documentation:
                    </dt>
                    <dd id="isDocumentation">
                        {{ $BugTaxonomy['documentation']}}
                    </dd>
                    <dt>
                    <dt>
                        Code:
                    </dt>
                    <dd id="isCode">
                        {{ $BugTaxonomy['code']}}
                    </dd>
                    <dt >
                        Duplicate:
                    </dt>
                    <dd id="isDuplicate">
                        {{ $BugTaxonomy['duplicate']}}
                    </dd>
                    <dt >
                        Other:
                    </dt>
                    <dd id="isOther">
                        {{ $BugTaxonomy['other']}}
                    </dd>
                    <dt >
                        NAP
                    </dt>
                    <dd id="isNAP">
                        {{$BugTaxonomy['NAP']}}
                    </dd>
                    <dt >
                       BadUnit:
                    </dt>
                    <dd id="isBadUnit">
                        {{ $BugTaxonomy['badUnit']}}
                    </dd>
                    <dt >
                        Standards:
                    </dt>
                    <dd id="isStandards">
                        {{ $BugTaxonomy['standards']}}
                    </dd>
                    <dt >
                        RCN:
                    </dt>
                    <dd id="isRCN">
                        {{ $BugTaxonomy['RCN']}}
                    </dd>
                    <dt>
                        Unknown:
                    </dt>
                    <dd id="isUnknown">
                        {{ $BugTaxonomy['unknown']}}
                    </dd>
                    <dt >
                        NoTaxonomy:
                    </dt>
                    <dd id="isNoTaxonomy">
                        {{ $BugTaxonomy['noTaxonomy']}}
                    </dd>

                </dl>
           @if( $bugs->count()>0)
                <div class="row" id="canvasImg" style="width: 700px;height: 500px"></div>
@endif
                @if($project->bugsOpenClosed($moreThanDate,$lessThanDate)->count()>1)

                <div class="row" id="canvasLineImg" style="width: 700px;height: 500px"></div>
                @endif

                <canvas style="display: none" id="myCanvas" width="700" height="500"></canvas>
                <canvas style="display:none;" id="myLineCanvas" width="700" height="630"></canvas>

                <hr>
                <br>

                <div style="margin-top: 20%" class="row">
                    <div><P class="text-center" style="font-size: 26px">Bugs List</P></div>
                    @foreach($project->subsystems as $subsystem)

                        <hr>  <br>
                        <table class="table table-striped">
                            <tbody>
                            <tr style="font-size: 120%;font-weight: bolder">
                                <td colspan="2">
                                    Subsystem Name: {{ $subsystem->name}}
                                </td>
                                <td style="font-weight: bolder" colspan="2">
                                    Bugs Number: {{ $subsystem->bugsCount($moreThanDate,$lessThanDate)}}
                                </td>
                            </tr>
                            <tr  style="font-size: 110%;font-weight: bolder">
                                <td colspan="4">
                                    Description: {{ $subsystem->description}}
                                </td>

                            </tr>
                            @if($subsystem->bugsCount($moreThanDate,$lessThanDate)>0)
                                <tr style="font-size: 120%">
                                    <td colspan="8">Bugs list:</td>
                                </tr>@endif
                            @foreach($subsystem->bugs($moreThanDate,$lessThanDate) as $Bug)
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
                                    <td>
                                        Tester: {{ $Bug->test->staff->fullName}}
                                    </td>
                                    <td>
                                        Estimated fix
                                        date: @if($Bug->estimatedFixDate!==null&&$Bug->estimatedFixDate!=='')
                                            {{ $Bug->estimatedFixDate}}
                                        @else No record
                                        @endif
                                    </td>

                                    <td>
                                        Actual fix date: @if($Bug->actualFixDate!==null&&$Bug->actualFixDate!=='')
                                            @if($Bug->actualFixDate>$Bug->estimatedFixDate)
                                                <span style="color: red">{{  $Bug->actualFixDate}}</span>
                                            @else
                                                {{   $Bug->actualFixDate}}
                                            @endif
                                        @else  No record
                                        @endif
                                    </td>

                                    <td> Taxonomy:
                                        @if($Bug->taxonomy!==null&&$Bug->taxonomy!=='')
                                            {{ $Bug->taxonomy}}
                                        @else No record
                                        @endif
                                    </td>

                                </tr>
                                <tr>

                                    <td colspan="8">
                                        Description: {{ $Bug->description}}
                                    </td>
                                </tr>
                                @if($Bug->actualFixDate!==null&&$Bug->actualFixDate!=='')
                                    @if($Bug->actualFixDate>$Bug->estimatedFixDate)
                                        @foreach($Bug->bugassigns as $bugassign)
                                            <tr style="color: firebrick">
                                                <td >
                                                    Bug Assign ID: {{ $bugassign->id}}
                                                </td>
                                                <td >
                                                    Assigned Date: {{ date_format($bugassign->created_at,'Y-m-d')}}
                                                </td>
                                                <td >
                                                    Finshed Date: {{ date_format($bugassign->updated_at,'Y-m-d')}}
                                                </td>
                                                <td >
                                                    Staff Name: {{ $bugassign->staff->fullName}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                                <tr>
                                    <td style="background-color: white;" colspan="8"></td>
                                <tr>

                            @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <script>
        window.onload = drawBarChart();
        window.onload = drawLineChart();


        function drawBarChart() {

            var c = document.getElementById("myCanvas");
            var context = c.getContext("2d");
            var isFunctional = parseInt(document.getElementById("isFunctional").innerHTML);
            var isSystem = parseInt(document.getElementById("isSystem").innerHTML);
            var isProcess = parseInt(document.getElementById("isProcess").innerHTML);
            var isData = parseInt(document.getElementById("isData").innerHTML);
            var isCode = parseInt(document.getElementById("isCode").innerHTML);
            var isDuplicate = parseInt(document.getElementById("isDuplicate").innerHTML);
            var isOther = parseInt(document.getElementById("isOther").innerHTML);
            var isNAP = parseInt(document.getElementById("isNAP").innerHTML);
            var isBadUnit = parseInt(document.getElementById("isBadUnit").innerHTML);
            var isStandards = parseInt(document.getElementById("isStandards").innerHTML);
            var isRCN = parseInt(document.getElementById("isRCN").innerHTML);
            var isUnknown = parseInt(document.getElementById("isUnknown").innerHTML);
            var isNoTaxonomy = parseInt(document.getElementById("isNoTaxonomy").innerHTML);
            var  isDocumentation=parseInt(document.getElementById("isDocumentation").innerHTML);
var mostnumber=0;

                if (mostnumber < isFunctional) {
                    mostnumber = isFunctional;
                }
                if (mostnumber <isSystem) {
                    mostnumber = isSystem;
                }
                if (mostnumber <isProcess) {
                    mostnumber = isProcess;
                }
                if (mostnumber <isNoTaxonomy) {
                    mostnumber = isNoTaxonomy;
                }

            var img2 = document.getElementById("img2");
            context.drawImage(img2, 5, 5);
            context.font = '23px cursive';
            context.fillStyle = "black";
            context.fillText( mostnumber,14 , 50);
            context.fillText( parseInt( mostnumber/2),14 , 230);
            context.fillText(0,24 , 410);
            context.font = '13px cursive';
            context.fillStyle = "blue";
            context.fillText('Functional',44 , 425);
            context.fillText('Process', 126,  425);
            context.fillText('Code', 218, 425);
            context.fillText('Other', 296, 425);
            context.fillText('BadUnit', 373, 425);
            context.fillText('RCN', 468, 425);
            context.fillText('Document', 534, 425);
            context.font = '16px cursive';
            context.lineWidth="10";
            context.strokeStyle="blue";
            context.beginPath();
            context.moveTo(68,401);
            context.lineTo(68, 400- 360*(isFunctional/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isFunctional,65 ,395- 360*(isFunctional/mostnumber));
            context.beginPath();
            context.moveTo(150,401);
            context.lineTo(150, 400- 360*(isProcess/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isProcess,147 ,395- 360*(isProcess/mostnumber));
            context.beginPath();
            context.moveTo(232,401);
            context.lineTo(232, 400- 360*(isCode/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isCode,229 ,395- 360*(isCode/mostnumber));
            context.beginPath();
            context.moveTo(314,401);
            context.lineTo(314, 400- 360*(isOther/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isOther,311 ,395- 360*(isOther/mostnumber));
            context.beginPath();
            context.moveTo(396,401);
            context.lineTo(396, 400- 360*(isBadUnit/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isBadUnit,393 ,395- 360*(isBadUnit/mostnumber));
            context.beginPath();
            context.moveTo(478,401);
            context.lineTo(478, 400- 360*(isRCN/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isRCN,475 ,395- 360*(isRCN/mostnumber));
            context.beginPath();
            context.moveTo(560,401);
            context.lineTo(560, 400- 360*(isDocumentation/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isDocumentation,556 ,395- 360*(isDocumentation/mostnumber));
            context.fillStyle = "red";
            context.fillText('System', 83 , 441);
            context.fillText('Data', 176, 441);
            context.fillText('Duplicate',247,441);
            context.fillText('NAP', 342, 441);
            context.fillText('Standards', 410, 441);
            context.fillText('Unknown', 497, 441);
            context.fillText('NoTaxonomy', 584, 441);
            context.lineWidth="10";
            context.strokeStyle="red";
            context.beginPath();
            context.moveTo(109,401);
            context.lineTo(109, 400- 360*(isSystem/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isSystem,106 ,395- 360*(isSystem/mostnumber));
            context.beginPath();
            context.moveTo(191,401);
            context.lineTo(191, 400- 360*(isData/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isData,188 ,395- 360*(isData/mostnumber));
            context.beginPath();
            context.moveTo(273,401);
            context.lineTo(273, 400- 360*(isDuplicate/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isDuplicate,270 ,395- 360*(isDuplicate/mostnumber));
            context.beginPath();
            context.moveTo(355,401);
            context.lineTo(355, 400- 360*(isNAP/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isNAP,352 ,395- 360*(isNAP/mostnumber));
            context.beginPath();
            context.moveTo(437,401);
            context.lineTo(437, 400- 360*(isStandards/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isStandards,434 ,395- 360*(isStandards/mostnumber));
            context.beginPath();
            context.moveTo(519,401);
            context.lineTo(519, 400- 360*(isUnknown/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isUnknown,516 ,395- 360*(isUnknown/mostnumber));
            context.beginPath();
            context.moveTo(601,401);
            context.lineTo(601, 400- 360*(isNoTaxonomy/mostnumber));
            context.stroke();
            context.closePath();
            context.fillText(isNoTaxonomy,598 ,395- 360*(isNoTaxonomy/mostnumber));
            context.font = '22px cursive';
            context.fillStyle ="darkgray";
            context.fillText('Project Report Chart 1: Bug Taxonomy ', 150 , 464);

            var img = c.toDataURL("image/png");
            var elem = document.createElement("img");
            elem.setAttribute("src", img);

            document.getElementById("canvasImg").appendChild(elem);
            // c.body.appendChild(img);
        }

        function drawLineChart() {
            var c = document.getElementById("myLineCanvas");
            var ctx = c.getContext("2d");
            var oneDay = document.getElementsByClassName('oneDay');
            var oneDayOpens = document.getElementsByClassName('oneDayOpens');
            var oneDayCloseds = document.getElementsByClassName('oneDayCloseds');
            var img = document.getElementById("img1");
            var mostnumber = 0;
            ctx.drawImage(img, 18, 30);

            for (i = 0; i < oneDay.length; i++) {
                if (mostnumber < parseInt(oneDayOpens[i].innerHTML)) {
                    mostnumber = parseInt(oneDayOpens[i].innerHTML);
                }
                if (mostnumber < parseInt(oneDayCloseds[i].innerHTML)) {
                    mostnumber = parseInt(oneDayCloseds[i].innerHTML);
                }

            }

            var eachWidth = 650 / (oneDay.length + 1);
            var eachHeight = 550 / (mostnumber + 2);
            ctx.font = 'bold 24px cursive';
            ctx.fillStyle = "black";
            ctx.fillText(mostnumber, 28, 168);
            ctx.fillText(parseInt(mostnumber / 3 * 2), 28, 294);
            ctx.fillText(parseInt(mostnumber / 3), 28, 420);
            ctx.fillText(0, 28, 568);
            ctx.fillText(oneDay[0].innerHTML, 48, 599);
            ctx.fillText(oneDay[oneDay.length - 1].innerHTML, 538, 599);

            ctx.font = 'bold 24px cursive';
            ctx.fillStyle = "black";
            ctx.fillText('Closed', 528, 128);
            ctx.fillText('Open', 528, 68);
            ctx.lineWidth = "6";
            ctx.beginPath();

            ctx.moveTo(608, 61);
            ctx.lineTo(638, 61);
            ctx.strokeStyle = "red";
            ctx.stroke();
            ctx.beginPath();
            ctx.strokeStyle = "green";

            ctx.moveTo(608,121);
            ctx.lineTo(638,121);
            ctx.stroke();

            ctx.beginPath();




            for (i = 1; i < oneDay.length; i++) {
                ctx.strokeStyle = "red";
                ctx.moveTo(71+eachWidth * (i-1), 570 - (eachHeight * parseInt(oneDayOpens[i - 1].innerHTML)));
                ctx.lineTo(71+eachWidth * i, 570 - (eachHeight * parseInt(oneDayOpens[i].innerHTML)));
                ctx.lineWidth = "3";
                ctx.stroke();
            }
            ctx.closePath();

            ctx.beginPath();
            for (i = 1; i < oneDay.length; i++) {
                ctx.strokeStyle = "green";
                ctx.moveTo(74+eachWidth * (i-1), 570 - (eachHeight * parseInt(oneDayCloseds[i - 1].innerHTML)));
                ctx.lineTo(74+eachWidth * i, 570 - (eachHeight * parseInt(oneDayCloseds[i].innerHTML)));
                ctx.lineWidth = "3";
                ctx.stroke();
            }
            ctx.closePath();
            ctx.font = '22px cursive';
            ctx.fillStyle ="darkgray";
            ctx.fillText('Project Report Chart 2: Bug Open Closed', 140 , 620);

            var img1 = c.toDataURL("image/png");
            var elem = document.createElement("img");
            elem.setAttribute("src", img1);

            document.getElementById("canvasLineImg").appendChild(elem);
            // // c.body.appendChild(img);
        }




    </script>

@endsection