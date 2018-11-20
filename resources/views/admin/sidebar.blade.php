<div class="panel panel-default">
    <div class="panel-heading">Manage</div>
    <ul class="list-group">
        @if(Session::has('user')&&Session::get('user')->title==='manager')
                    <li class="list-group-item"><a href="{{url('admin/Staff')}}">Staff</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Settings')}}">Setting</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Projects')}}">Project</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Subsystems')}}">Subsystem</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Usecases')}}">Usecase</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Testcases')}}">Testcase</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Testsuites')}}">Test Suite</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Bugs')}}">Bug</a></li>
        @elseif(Session::has('user'))
                    <li class="list-group-item"><a href="{{url('admin/Bugs')}}">Bugs</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Projects')}}">Projects</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Subsystems')}}">Subsystems</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Usecases')}}">Usecases</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Testcases')}}">Testcases</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Staff')}}">Staff</a></li>
                    <li class="list-group-item"><a href="{{url('admin/Settings')}}">Setting</a></li>
                    @if(Session::get('user')->title!=='developer')
                        <li class="list-group-item"><a href="{{url('admin/Testsuites')}}">Test Suite</a></li>
                    @endif
        @endif
    </ul>
</div>