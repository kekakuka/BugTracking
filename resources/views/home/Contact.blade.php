@extends('Shared._layout')
@section('content')

   <div class="container">
       <ul class="breadcrumb" style="font-size: 16px;">
           <li><a href="{{url('/')}}">Home</a></li>
           <li class="active">Contact us</li>
       </ul>
       <hr>
       <div class="row">
           <div class="col-md-4"><div class="panel panel-default" style="height:100%;">
                   <div class="panel-heading">
                       <p class="panel-title">Contact us</p>
                   </div>
                   <div class="panel-body">
                       <dl class="dl-horizontal">
                           <br>
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

                           <dt class="text-info">Developer:</dt>

                           <dd>Lei Li</dd>
                           <dt class="text-info">Email:</dt>

                           <dd>
                               natalia@unitec.ac.nz
                           </dd><br><dt class="text-info">Designer:</dt>

                           <dd>
                               Mengxue Zhang
                           </dd>
                           <dt class="text-info">Email:</dt>

                           <dd>
                               natalia@unitec.ac.nz
                           </dd>
                           <br>
                           <dt class="text-info">Tester:</dt>

                           <dd>
                               Lihui Jiang
                           </dd>
                           <dt class="text-info">Email:</dt>

                           <dd>
                               natalia@unitec.ac.nz
                           </dd>
                           <br>
                       </dl></div>

               </div></div>

           <div class="col-md-8"><div class="img-rounded" style="height: 430px" id="map"></div></div>
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