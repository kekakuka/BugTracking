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
                       href="#collapse5">
                        Instruction
                    </a>
                </div>
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
            <div id="collapse1" class="panel-collapse collapse ">

                <img class="img-responsive" src="{{url('Images/WorkFlow.jpg')}}" style="border-radius:7px;">

            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <img class="img-responsive" src="{{url('Images/Database.jpg')}}" style="border-radius:7px;"></div>
            <div id="collapse3" class="panel-collapse collapse">
                <img class="img-responsive" src="{{url('Images/BugLifeCycle.jpg')}}" style="border-radius:7px;">
            </div>
            <div id="collapse4" class="panel-collapse collapse">
                <img class="img-responsive" src="{{url('Images/TestLifeCycle.jpg')}}" style="border-radius:7px;">
            </div>
            <div  id="collapse5" class="panel-collapse collapse in">
              <article  style="font-size: 20px;padding: 25px 25px 25px 25px ;">Admin can create company and the first manager for the new company at the same time.
                  <br>
                  Admin can delete company and all related data of the company is deleted as well.
                  <br>
                  <br>
                  Manager can hire staff(manager/tester/developer) of the company.
                  <br>
                  Manager can create project of the company.
                  <br>
                  Manager can create subsystem under project.
                  <br>

                  Manager can create usecase under subsystem.
                  <br>
                  Manager can create testcase under usecase.
                  <br>
                  Manager can create testsuite under project.
                  <br>
                  Manager can assign Open and ReOpened bug to developer.
                  <br>
                  Manager has all permissions of the tester.
                  <br>
                  <br>
                  Tester can assemble the test cases into the testsuite.
                  <br>
                  Tester can take the test from the testsuite.
                  <br>
                  Tester can record the test result and enter bugs.
                  <br>
                  Tester can record the confirmation testing result for fixed bugs.
                  <br>
                  <br>
                  Developer can assign the fixed bug to the tester.
                  <br>
              </article>
            </div>
        </div>
    </div>



@endsection