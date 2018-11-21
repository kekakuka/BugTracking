<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title') Bug Tracking System</title>


    <link rel="stylesheet" href="{{url('lib/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{url('css/site.css')}}" type="text/css"/>
    <link rel="icon" type="image/ico" href="{{url('images/Logo.ico')}}" sizes="16x16">
</head>
<body>

@include('Shared.header')


<div class="container-fluid content">
    <div style="min-height: 400px; margin:10px;">
        @include('dashboard')
       </div>

</div>

@include('Shared.footer')

</body>

{{--<script src="{{url('lib/jquery/dist/jquery.min.js')}}"></script>--}}
{{--<script src="{{url('lib/bootstrap/dist/js/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{url('js/site.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="{{url('lib/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/site.js') }}"></script>


</html>