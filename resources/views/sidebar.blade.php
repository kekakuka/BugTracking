<div class="panel panel-default" style="margin-top: 10%;">
    <div class="panel-heading">Manage</div>
    <ul class="nav nav-pills nav-stacked">
        @if(Session::has('user'))
                    <li class="active"><a href="{{url('Projects')}}">Projects</a></li>
                    <li class=""><a href="{{url('Subsystems')}}">Subsystems</a></li>
                    <li class=""><a href="{{url('Usecases')}}">Usecases</a></li>
                    <li class=""><a href="{{url('Testcases')}}">Testcases</a></li>
                    <li class=""><a href="{{url('Staff')}}">Staff</a></li>
                    <li class=""><a href="{{url('Settings')}}">Setting</a></li>
                    <li class=""><a href="{{url('Testsuites')}}">Test Suite</a></li>
                    <li class=""><a href="{{url('Bugs')}}">Bugs</a></li>
            @if(Session::get('user')->title==='manager')
                <li><a href="{{url('/Bugs/AssignIndex')}}">Bug Assign</a></li>
            @endif
        @endif
    </ul>
</div>