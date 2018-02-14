<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#2196F3">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Racing+Sans+One" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.bxslider.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/lightbox.min.css') }}" rel="stylesheet" />

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body>
    <header>
        <div id="head">
            @include('layouts.header')
        </div>
        <div id="head2">
            @include('showNavBar')
        </div>
    </header>
    <main>
        <div class="row">
            <div class="col l3 m3 s12">
                <div class="card green darken-3">
                    <div class="card-content">
                        <label style="color: #fff;">Phone:</label>&nbsp;<span class="white-text">{{$address[0]->phone}}</span><br>
                        <label style="color: #fff;">region:</label>&nbsp;<span class="white-text">{{$address[0]->region}}</span><br>
                        <label style="color: #fff;">zone:</label>&nbsp;<span class="white-text">{{$address[0]->zone}}</span><br>
                        <label style="color: #fff;">woreda:</label>&nbsp;<span class="white-text">{{$address[0]->woreda}}</span>
                    </div>
                </div>
            </div>
            <div class="col l9 m9 s12">
                <div class="card" >
                    <div id="map" class="card-content" style="height: 350px; overflow: hidden; text-overflow: ellipsis;">

                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="page-footer scrollspy">
        @include('layouts.footer')
    </footer>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_n7J4QTEgv89AWttZDKYf7ALt41MLYrQ&callback=initMap">
    </script>
    <script>
        function initMap() {
            var lat = 9.1213156;
            var lon = 35.988784;
            var uluru = {lat: lat, lng:  lon};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/materialize.min.js')}}"></script>
    <script src="{{asset('js/init.js')}}"></script>
    <script src="{{asset('js/slider.js')}}"></script>
</body>
</html>