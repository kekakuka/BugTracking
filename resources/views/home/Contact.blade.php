@extends('Shared._layout')
@section('content')

   <div class="container">
       <br>
       <hr>
       <div class="row">
        <div class="col-md-4 thumbnail" style="height: 500px; font-size: 17px;">
            <dl class="dl-horizontal">
                <h2 class="text-center">Contact us</h2><br>
                <dt class="text-info"> Address:</dt>

                <dd>
                    Building 183
                    139 Carrington Road
                    Mt Albert, Auckland
                </dd><br>
                <dt class="text-info">Lecturer:</dt>

                <dd>
                    Natalia
                </dd>
                <dt class="text-info">Email:</dt>

                <dd>
                    natalia@unitec.ac.nz
                </dd><br>

                <dt class="text-info">Developer/Tester:</dt>

                <dd>Lei Li</dd>
                <dt class="text-info">Email:</dt>

                <dd>
                    natalia@unitec.ac.nz
                </dd><br><dt class="text-info">UIDesigner/Tester:</dt>

                <dd>
                   MengXue Zhang
                </dd>
                <dt class="text-info">Email:</dt>

                <dd>
                    natalia@unitec.ac.nz
                </dd>
                <br>
                <dt class="text-info">Designer/Tester:</dt>

                <dd>
                    Lihui Jiang
                </dd>
                <dt class="text-info">Email:</dt>

                <dd>
                    natalia@unitec.ac.nz
                </dd>
                <br>
            </dl>
        </div>
           <div class="col-md-8"><div class="img-rounded" style="height: 500px" id="map"></div></div>
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