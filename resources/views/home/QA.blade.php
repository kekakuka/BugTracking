@extends('Shared._layout')
@section('content')

            <ul class="breadcrumb" style="font-size: 16px;">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Instruction</li>
            </ul>
    <div class="panel-group col-md-10 col-md-offset-1" id="accordion">
        <div class="panel panel-default">
            <div style="min-height: 44px; font-size: 15px" class="panel-heading">
<div class="col-md-2">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapse1">
                       Main Work Flow
                    </a>
</div>
    <div class="col-md-2">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapse2">
                        Logical ERD
                    </a>
    </div>
                <div class="col-md-2">

                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapse3">
                        Bug Life Cycle
                    </a>
                </div>
                <div class="col-md-2">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapse4">
                        Test Life Cycle
                    </a>
                </div>

            </div>
            <div id="collapse1" class="panel-collapse collapse in" >

                        <img  class="img-responsive" src="{{url('Images/WorkFlow.jpg')}}" style="border-radius:7px;">

            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <img  class="img-responsive" src="{{url('Images/Database.jpg')}}" style="border-radius:7px;"></div>
            <div id="collapse3" class="panel-collapse collapse">
                <img class="img-responsive" src="{{url('Images/BugLifeCycle.jpg')}}" style="border-radius:7px;">
            </div>
            <div id="collapse4" class="panel-collapse collapse">
                <img class="img-responsive" src="{{url('Images/TestLifeCycle.jpg')}}" style="border-radius:7px;">
            </div>
        </div>
    </div>



@endsection