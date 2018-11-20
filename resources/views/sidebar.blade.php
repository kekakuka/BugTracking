<div class="thumbnail panel panel-default " style="margin-top: 10%;">
    <div class="panel-heading">Manage</div>
    <ul style="font-size: 18px;" class="nav nav-pills nav-stacked">
        @if(Session::has('user'))
                    <li class="waitForActive"><a onclick="func(this)" href="{{url('Projects')}}">Projects</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Subsystems')}}">Subsystems</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Usecases')}}">Usecases</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Testcases')}}">Testcases</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Settings')}}">Setting</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Testsuites')}}">Test Suite</a></li>
                    <li class="waitForActive"><a  onclick="func(this)"  href="{{url('Bugs')}}">Bugs</a></li>
                    <li class="waitForActive"><a onclick="func(this)"  href="{{url('Staff')}}">Staff</a></li>
            @if(Session::get('user')->title==='manager')
                <li class="waitForActive"><a onclick="func(this)"  href="{{url('/Bugs/AssignIndex')}}">Bug Assign</a></li>
            @endif
        @endif
    </ul>
</div>
<script  type="text/javascript">


var waitForActive=document.getElementsByClassName('waitForActive')
function checkActive() {


    for(i=0;i<waitForActive.length;i++)
    {
        if (waitForActive[i].firstChild.text===localStorage.getItem('checkActive')){
            waitForActive[i].className='waitForActive active';
        }
    }

}
window.onload=checkActive();
function func(e) {
    localStorage.setItem( 'checkActive',$(e).text());
}


</script>