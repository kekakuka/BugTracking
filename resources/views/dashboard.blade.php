


        {{--<div class="mywrapper">--}}
            {{--<div class="mysidebar col-md-2">--}}
                {{--@include('sidebar')--}}
            {{--</div>--}}
            {{--<div class="col-md-push-2 mainPart col-md-10 dashboard">--}}
                {{--<div class="panel panel-default p-5">--}}
                    {{--<div class="panel-heading" style="background: linear-gradient(rgba(163, 165, 165, 0.1),rgba(123, 125, 125, 0.1))!important;">Manage</div>--}}
                    {{--@yield('content')--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="container-fluid" style="margin:1% 5%;">
            <div class="row">
                @include('sidebar')
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: linear-gradient(rgba(163, 165, 165, 0.1),rgba(123, 125, 125, 0.1))!important;height: 50px;">
                        <ul class="breadcrumb">
                            <li><a href="#">Manage</a></li>
                            <li><a href="#">Projects</a></li>
                            <li class="active">Edit</li>
                        </ul>
                    </div>
                    <div style="padding: 2% 5% 5% 5%;">
                    @yield('content')
                    </div>
                </div>
            </div>
             </div>
        </div>