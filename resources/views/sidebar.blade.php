<div style="margin-top: 1%" class="mysidebar col-md-2">

<div class="panel panel-default">
    <div class="panel-heading" style="background: linear-gradient(rgba(163, 165, 165, 0.1),rgba(123, 125, 125, 0.1))!important;height: 50px;">Manage</div>
    <ul style="font-size: 14px;" class="nav nav-pills nav-stacked">
        @if(Session::has('user'))
            @if(Session::get('user')->title==='manager')
                <li class="waitForActive"><a onclick="func(this)"  href="{{url('/BugsAssign')}}">BugsAssign<span style="margin-top: -2px; color:white;background-color:rgba(117, 119, 129, 0.83);"
                                                                                                                 class="badge">@if(Session::has('OpenBugNumber')){{Session::get('OpenBugNumber')}}
                            @endif
                            </span></a></li>
            @endif
                    <li class="waitForActive"><a onclick="func(this)" href="{{url('Projects')}}">Projects</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Subsystems')}}">Subsystems</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Usecases')}}">Usecases</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Testcases')}}">Testcases</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Settings')}}">Settings</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Testsuites')}}">Testsuites</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Bugs')}}">Bugs</a></li>
                    <li class="waitForActive"><a onclick="func(this)"  href="{{url('Staff')}}">Staff</a></li>
        @endif
    </ul>
</div>
</div>
