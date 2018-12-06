<div style="font-size:15px; max-height: 80px" class="navbar navbar-default navbar-fixed-top" role="navigation">


    <div style="margin-left:5%;" class="col-md-2 navbar-header nav-title">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="{{url('/')}}"><img class="img-rounded" style="width:50px;" src="{{URL::asset('images/Logo1.png')}}"
                                    alt="Bug Tracking"></a>
    </div>

    <div class="col-md-8 collapse navbar-collapse">


        <div class="col-md-pull-1 col-md-7 navbar-collapse collapse"
             style="background: linear-gradient(rgba(233, 235, 235, 0.51),rgba(158, 160, 160, 0.51));">
            <ul style="font-size: 15px" class="nav navbar-nav">

                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/Contact')}}">Contact</a></li>
                <li><a href="{{url('/QA')}}">Instruction</a></li>

                @if(Session::has('user'))

                    @if(Session::get('user')->title==='admin')
                        <li><a href="{{url('Companies')}}">
                                Companies Management
                            </a></li>
                        @else
                        <li><a href="{{url('/Reports')}}">Reports</a></li>
                    @if(Session::has('user')&&Session::get('user')->title==='manager')
                        <li><a href="{{url('BugsAssign')}}">
                                Management @if(Session::has('OpenBugNumber')&&Session::get('OpenBugNumber')!==0)<span
                                        style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                        class="badge">

                                        {{Session::get('OpenBugNumber')}}

                            </span>
                                @endif
                            </a></li>
                    @else
                        <li><a href="{{url('Projects')}}">
                                Check Information
                            </a></li>
                    @endif


                    @if(Session::get('user')->title!=='developer')
                        <li><a href="{{url('/Bugs/Run')}}">Create Tests/Enter Bugs
                                @if(Session::get('user')->UnifinishedTestNumber()!==0)      <span
                                        style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                        class="badge">

                                        {{Session::get('user')->UnifinishedTestNumber()}}

                            </span> @endif</a></li>

                    @endif

                    <li><a href="{{url('/Bugs/MyWork')}}">My Bugs
                            @if(Session::has('MyNumber')&&Session::get('MyNumber')!==0) <span
                                    style="color:white;background-color:rgba(117, 119, 129, 0.83);"
                                    class="badge">
                                    {{Session::get('MyNumber')}}
                            </span>  @endif
                        </a></li>
                    <li><a href="#" title="Manage">Hi {{Session::get('user')->fullName}}</a></li>
                    @endif
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
<script type="text/javascript">


</script>