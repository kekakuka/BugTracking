<div style="font-size:15px;" class="navbar navbar-default navbar-fixed-top" role="navigation">


    <div style="margin-left:5%" class="col-md-2 navbar-header nav-title">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a   href="{{url('/')}}"><img class="img-rounded" style="width:50px;" src="{{URL::asset('images/Logo1.png')}}" alt="Bug Tracking"></a>
    </div>
    {{--@if(Session::has('user')&&Session::get('user')->title==='manager')--}}
        {{--<div style="padding-top:5px;margin-left:10px" class="col-md-2 dropdown">--}}

            {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{url('Staff')}}">Staff Management</a></li>--}}
                {{--<li><a href="{{url('Settings')}}">Setting Management</a></li>--}}
                {{--<li><a href="{{url('Projects')}}">Project Management</a></li>--}}
                {{--<li><a href="{{url('Subsystems')}}">=>Subsystem Management</a></li>--}}
                {{--<li><a href="{{url('Usecases')}}">==>Usecase Management</a></li>--}}
                {{--<li><a href="{{url('Testcases')}}">===>Testcase Management</a></li>--}}
                {{--<li><a href="{{url('Testsuites')}}">=>Test Suite Management</a></li>--}}
                {{--<li><a href="{{url('Bugs')}}">Bug Management</a></li>--}}


            {{--</ul>--}}
        {{--</div>--}}

        {{--<div style="padding-top:5px;margin-left:10px" class="col-md-2 dropdown">--}}
            {{--<a href="{{url('Projects')}}" class="btn btn-default dropdown-toggle" data-toggle="dropdown">--}}
               {{--<span class="caret"></span>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{url('Bugs')}}">Bugs</a></li>--}}
                {{--<li><a href="{{url('Projects')}}">Projects</a></li>--}}
                {{--<li><a href="{{url('Subsystems')}}">Subsystems</a></li>--}}
                {{--<li><a href="{{url('Usecases')}}">Usecases</a></li>--}}
                {{--<li><a href="{{url('Testcases')}}">Testcases</a></li>--}}
                {{--<li><a href="{{url('Staff')}}">Staff</a></li>--}}
                {{--<li><a href="{{url('Settings')}}">Setting</a></li>--}}
                {{--@if(Session::get('user')->title!=='developer')--}}
                    {{--<li><a href="{{url('Testsuites')}}">Test Suite Management</a></li>--}}
                {{--@endif--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--@endif--}}

    <div class="col-md-8  collapse navbar-collapse">


        <div class="col-md-pull-1 col-md-7 navbar-collapse collapse">
            <ul class="nav navbar-nav">

                <li ><a href="{{url('/')}}">Home</a></li>
                <li ><a href="{{url('/Contact')}}">Contact</a></li>
                <li ><a href="{{url('/QA')}}">Q&A</a></li>
                <li><a href="{{url('/Reports')}}">Reports</a></li>
                @if(Session::has('user'))
                    @if(Session::has('user')&&Session::get('user')->title==='manager')
                        <li> <a  href="{{url('BugsAssign')}}"  >
                                Management <span style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                                class="badge">
                                @if(Session::has('OpenBugNumber'))
                                        {{Session::get('OpenBugNumber')}}
                                    @endif
                            </span>
                            </a></li>
                    @else
                        <li> <a  href="{{url('Projects')}}"  >
                               Check Information
                            </a></li>
                    @endif


                    @if(Session::get('user')->title!=='developer')
                        <li><a href="{{url('/Bugs/Run')}}">Take Tests/Enter Bugs
                                <span style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                      class="badge">
                                @if(Session::has('user'))
                                        {{Session::get('user')->UnifinishedTestNumber()}}
                                    @endif
                            </span></a></li>

                    @endif

                    <li><a href="{{url('/Bugs/MyWork')}}">My Bugs
                            <span style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                  class="badge">
                                @if(Session::has('MyNumber'))
                                    {{Session::get('MyNumber')}}
                                @else 0
                                @endif
                            </span>
                        </a></li>
                    <li><a href="#" title="Manage">Hi {{Session::get('user')->fullName}}</a></li>
                    <li>
                        <form action="{{route('Logout')}}" method="post" id="logoutForm" class="navbar-right">
                            @csrf
                            <button type="submit" class="btn btn-link navbar-btn navbar-link">Log out</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('myLogin') }}">Log in</a></li>
                @endif
            </ul>
        </div>


    </div>


</div>
<script  type="text/javascript">




</script>