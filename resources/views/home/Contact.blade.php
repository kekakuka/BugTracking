@extends('Shared._layout')
@section('title', 'Contact ')
@section('content')
    <h2>Contact</h2>
   <div class="container">
        <div class="col-md-6">
            <dl class="dl-horizontal">
                <dt> Address:</dt>
                <dd>
                    Building 183
                    139 Carrington Road
                    Mt Albert, Auckland
                </dd>
                <dt>Lecturer:</dt>
                <dd>
                    Natalia
                </dd>


            </dl>
        </div>
        <div class="col-md-6">
            <dl class="dl-horizontal">


                <dt>Designer/Tester:</dt>
                <dd>
                    Lihui Jiang
                </dd>

                <dt>Developer/Tester:</dt>
                <dd>Lei Li</dd>


            </dl>
        </div>
    </div>
    <div></div>
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
         <div style="height: 500px" class="jumbotron" id="map"></div>
        </div>
    </div>

    <script>

        function initMap() {
            var myLatLng = { lat: -36.8808, lng: 174.7078 };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Quality Souvenir'
            });
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_zok3TctZQOdZzoR1lqs9a1q_mT0DN5c&callback=initMap">
    </script>
@endsection