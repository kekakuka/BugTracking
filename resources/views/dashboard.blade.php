


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

        <div class="container-fluid mywrapper" style="margin:1% 5%;">

                @include('sidebar')
            <div class="col-md-10 col-md-push-1 col-sm-push-3 col-xs-push-4 mainPart">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: linear-gradient(rgba(163, 165, 165, 0.1),rgba(123, 125, 125, 0.1))!important;height: 50px;">
                        <ul class="breadcrumb">
                            <li>Manage</li>
                            <li id="myMainMenu"></li>
                            <li id="mySubMenu" class="active"></li>
                        </ul>
                    </div>
                    <div style="padding: 2% 5% 5% 5%;">
                    @yield('content')
                    </div>
                </div>
            </div>

        </div>

        <script  type="text/javascript">

            var myMainMenu=document.getElementById('myMainMenu');
            var mySubMenu=document.getElementById('mySubMenu');
            var waitForActive=document.getElementsByClassName('waitForActive')
            function checkActive() {
                var url=window.location.href;
                var aa=url.indexOf('/public')
                url=url.substr(aa+8);

                var urlArray=url.split('/');

                localStorage.setItem( 'checkActive',urlArray[0]);

                myMainMenu.innerHTML=localStorage.getItem('checkActive')
                if (urlArray.length>1){
                    localStorage.setItem( 'subUrl',urlArray[1]);
                    mySubMenu.innerHTML=localStorage.getItem('subUrl')
                }

                for(i=0;i<waitForActive.length;i++)
                {
                    if (waitForActive[i].firstChild.text.indexOf( localStorage.getItem('checkActive'))>-1){
                        waitForActive[i].className='waitForActive active';
                    }
                }



            }
            window.onload=checkActive();
            function func(e) {
                localStorage.setItem( 'checkActive',$(e).text());
            }


        </script>