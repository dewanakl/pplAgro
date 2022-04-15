<x-guest-layout>
    @section('styles')
    <style>
        .map-container {
            overflow: hidden;
            padding-bottom: 56.25%;
            position: relative;
            height: 0;
        }

        .map-container iframe {
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
    </style>
    @endsection

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Thempe.id</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#alamat">Alamat</a>
                    </li>
                </ul>
                @auth
                <a class="btn btn-outline-success" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row py-4 align-items-center">
            <div class="col-md-6 ">
                <h1>Thempe.id</h1>
                <p class="mt-4 h5 text-dark">
                    Tempe adalah makanan khas Indonesia yang terbuat dari fermentasi kedelai. Sediaan fermentasi ini
                    secara umum dikenal sebagai "ragi tempe".
                </p>
                <small>wikipedia</small>
            </div>
            <div class="col-md-6 text-end d-md-block d-none">
                <img src="https://static.vecteezy.com/system/resources/previews/003/795/506/original/tempe-is-indonesian-traditional-food-vector.jpg"
                    alt="none" width="500">
            </div>
        </div>
        <!--Google map-->
        <h3 class="text-dark" id="alamat">Lokasi kami</h3>
        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
            <iframe src="https://maps.google.com/maps?q={{ $data->alamat }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <!--Google Maps-->
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="{{ asset('img/undraw_rocket.svg') }}" alt="" width="24" height="24">
                    <small class="d-block mb-3 text-dark">&copy; 2017-2021</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-dark" href="#">Cool stuff</a></li>
                        <li><a class="text-dark" href="#">Random feature</a></li>
                        <li><a class="text-dark" href="#">Team feature</a></li>
                        <li><a class="text-dark" href="#">Stuff for developers</a></li>
                        <li><a class="text-dark" href="#">Another one</a></li>
                        <li><a class="text-dark" href="#">Last time</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-dark" href="#">Resource</a></li>
                        <li><a class="text-dark" href="#">Resource name</a></li>
                        <li><a class="text-dark" href="#">Another resource</a></li>
                        <li><a class="text-dark" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-dark" href="#">Team</a></li>
                        <li><a class="text-dark" href="#">Locations</a></li>
                        <li><a class="text-dark" href="#">Privacy</a></li>
                        <li><a class="text-dark" href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</x-guest-layout>