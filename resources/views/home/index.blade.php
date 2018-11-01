@extends('Shared._layout')
@section('title', 'Home Page')
@section('content')
<div class="container " style=" width:95% ; box-shadow: 9px 12px 0 rgba(0, 0, 0, 0.3);">
    <div class="row">

        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:100%">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>

            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <a style="border-radius:5px;   box-shadow:5px 7px 0px rgba(0, 0, 0, 0.3);" href="#">
                        <img class="img-thumbnail" src="{{url('Images/MB.jpg')}}" style="width:100% ;border-radius:7px;">
                    </a>


                </div>
                <div class="item">
                    <a style="border-radius:5px;   box-shadow:5px 7px 0px rgba(0, 0, 0, 0.3);" href="#">
                        <img class="img-thumbnail" src="{{url('Images/AB.jpg')}}"  style="width:100% ;border-radius:7px;">





                    </a>


                </div>

                <div class="item">
                    <a style="border-radius:5px;   box-shadow: 6px 7px 0 rgba(0, 0, 0, 0.3);" href="#">

                        <img class="img-thumbnail img-rounded" src="{{url('Images/CB.jpg')}}" style="width:100% ;border-radius:7px; ">



                    </a>

                </div>
                <div class="item">
                    <a style="border-radius:5px;   box-shadow: 6px 7px 0 rgba(0, 0, 0, 0.3);" href="#">

                        <img class="img-thumbnail img-rounded" src="{{url('Images/EB.jpg')}}" style="width:100% ;border-radius:7px;  ">



                    </a>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

@endsection