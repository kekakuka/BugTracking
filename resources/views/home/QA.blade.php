@extends('Shared._layout')
@section('content')



        <div class="container">
    <div class="panel-group col-md-12" id="accordion">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion"
                       href="#collapse1">
                       Main Work Flow:
                    </a>
                </h3>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="container">
                        <img  src="{{url('Images/WorkFlow.jpg')}}" style="width:90% ;border-radius:7px;">
                    </div>



                </div>
            </div>
        </div>
    </div>
        <div class="panel-group col-md-12" id="accordion">

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
                    <div class="container">
                        <img  src="{{url('Images/Database.jpg')}}" style="width:90% ;border-radius:7px;">
                    </div>
                </div>
            </div>
        </div>
            <div class="panel-group col-md-12" id="accordion">

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
                        <div class="container">
                            <img  src="{{url('Images/BugLifeCycle.jpg')}}" style="width:90% ;border-radius:7px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group col-md-12" id="accordion">
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
                        <div class="container">
                            <img  src="{{url('Images/TestLifeCycle.jpg')}}" style="width:90% ;border-radius:7px;">
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection