@extends('Shared._layout')
@section('content')

            <ul class="breadcrumb" style="font-size: 16px;">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Instruction</li>
            </ul>
    <div class="panel-group col-md-10 col-md-offset-1" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapse1">
                       Main Work Flow:
                    </a>
                </h3>
            </div>
            <div id="collapse1" class="panel-collapse collapse in" >
                <div class="panel-body">
                        <img  class="img-responsive" src="{{url('Images/WorkFlow.jpg')}}" style="border-radius:7px;">
                </div>
            </div>
        </div>
    </div>
    <div class="panel-group col-md-10 col-md-offset-1" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse2">
                           Database:
                        </a>
                    </h3>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                        <img  class="img-responsive" src="{{url('Images/Database.jpg')}}" style="border-radius:7px;"></div>
                </div>
            </div>
    <div class="panel-group col-md-10 col-md-offset-1" id="accordion">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapse3">
                                Bug Life Cycle:
                            </a>
                        </h3>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                            <img class="img-responsive" src="{{url('Images/BugLifeCycle.jpg')}}" style="border-radius:7px;">
                    </div>
                </div>
            </div>
    <div class="panel-group col-md-10 col-md-offset-1" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapse4">
                                TestLifeCycle:
                            </a>
                        </h3>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                          <img class="img-responsive" src="{{url('Images/TestLifeCycle.jpg')}}" style="border-radius:7px;">
                    </div>
                </div>
            </div>

@endsection