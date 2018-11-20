<div class="panel panel-default">
    <div class="panel-heading">Manage</div>
    <ul class="list-group">
        @if(Session::has('user')&&Session::get('user')->title==='manager')
                    <li class="list-group-item"><a href="{{url('Staff')}}">Staff</a></li>
                    <li class="list-group-item"><a href="{{url('Settings')}}">Setting</a></li>
                    <li class="list-group-item"><a href="{{url('Projects')}}">Project</a></li>
                    <li class="list-group-item"><a href="{{url('Subsystems')}}">Subsystem</a></li>
                    <li class="list-group-item"><a href="{{url('Usecases')}}">Usecase</a></li>
                    <li class="list-group-item"><a href="{{url('Testcases')}}">Testcase</a></li>
                    <li class="list-group-item"><a href="{{url('Testsuites')}}">Test Suite</a></li>
                    <li class="list-group-item"><a href="{{url('Bugs')}}">Bug</a></li>
        @elseif(Session::has('user'))
                    <li class="list-group-item"><a href="{{url('Bugs')}}">Bugs</a></li>
                    <li class="list-group-item"><a href="{{url('Projects')}}">Projects</a></li>
                    <li class="list-group-item"><a href="{{url('Subsystems')}}">Subsystems</a></li>
                    <li class="list-group-item"><a href="{{url('Usecases')}}">Usecases</a></li>
                    <li class="list-group-item"><a href="{{url('Testcases')}}">Testcases</a></li>
                    <li class="list-group-item"><a href="{{url('Staff')}}">Staff</a></li>
                    <li class="list-group-item"><a href="{{url('Settings')}}">Setting</a></li>
                    @if(Session::get('user')->title!=='developer')
                        <li class="list-group-item"><a href="{{url('Testsuites')}}">Test Suite</a></li>
                    @endif
        @endif
    </ul>
</div>