<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')Bug Tracking System</title>


    <link rel="stylesheet" href="{{url('lib/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{url('css/site.css')}}" type="text/css"/>
    <link rel="icon" type="image/ico" href="{{url('images/Logo.ico')}}" sizes="16x16">
</head>
<body>

@include('Shared.header')


<div class="container body-content content">
    <div style="min-height: 400px; margin:10px;">
        @yield('content')</div>

</div>

@include('Shared.footer')

</body>

<script src="{{url('lib/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('lib/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('js/site.js')}}"></script>
</html>