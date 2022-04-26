<x-guest-layout>
    @section('styles')
    <style>
        .map-container {
            overflow: hidden;
            padding-bottom: 50%;
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

    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Thempe.id</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#alamat">Alamat</a>
                    </li>
                </ul>
                @auth
                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('dashboard') }}">Halaman Utama</a>
                @else
                <a class="btn btn-outline-primary my-2 my-sm-0" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="text-dark">Thempe.id</h1>
                <p class="mt-4 h5 text-dark">
                    Tempe adalah makanan khas Indonesia yang terbuat dari fermentasi kedelai. Sediaan fermentasi ini
                    secara umum dikenal sebagai "ragi tempe".
                </p>
                <small>wikipedia</small>
            </div>
            <div class="col-md-6 text-end d-md-block d-none">
                <img src="https://static.vecteezy.com/system/resources/previews/003/795/506/original/tempe-is-indonesian-traditional-food-vector.jpg"
                    alt="none" width="400">
            </div>
        </div>

        {{-- <section class="mb-4" id="kontak">
            <div class="p-3 rounded mt-4 mb-4 bg-light">
                <h3 class="text-dark text-center">Kontak Kami</h3>
                <h5 class="text-dark text-center">{{ $data->name }} | {{ $data->nohp }}</h5>
            </div>
        </section> --}}

        <section class="mb-4" id="alamat">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="p-3 rounded mt-4 mb-4 bg-light">
                        <h3 class="text-dark text-center">Alamat Kami</h3>
                    </div>
                    <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
                        <iframe src="https://maps.google.com/maps?q={{ $data->alamat }}&ie=UTF8&output=embed"
                            frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="py-3 bg-light">
        <div class="container">
            <p class="m-0 text-center text-dark">Copyright &copy; Thempe.id {{ date("Y") }}</p>
        </div>
    </footer>
</x-guest-layout>