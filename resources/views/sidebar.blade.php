<div class="col-md-2">

<div class="panel panel-default">
    <div class="panel-heading" style="background: linear-gradient(rgba(163, 165, 165, 0.1),rgba(123, 125, 125, 0.1))!important;height: 50px;">Manage</div>
    <ul style="font-size: 14px;" class="nav nav-pills nav-stacked">
        @if(Session::has('user'))
                    <li class="waitForActive"><a onclick="func(this)" href="{{url('Projects')}}">Projects</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Subsystems')}}">Subsystems</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Usecases')}}">Usecases</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Testcases')}}">Testcases</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Settings')}}">Settings</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Testsuites')}}">Testsuites</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Bugs')}}">Bugs</a></li>
                    <li class="waitForActive"><a onclick="func(this)"  href="{{url('Staff')}}">Staff</a></li>
            @if(Session::get('user')->title==='manager')
                <li class="waitForActive"><a onclick="func(this)"  href="{{url('/BugsAssign')}}">BugsAssign</a></li>
            @endif
        @endif
    </ul>
</div>
</div>
