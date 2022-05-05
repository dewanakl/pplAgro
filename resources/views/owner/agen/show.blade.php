<x-app-layout title="Lihat Agen">
    @isset($agen->alamat)
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
    @endisset

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agen.index') }}">Agen</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $agen->name }}</li>
        </ol>
    </nav>

    <a class="btn btn-warning btn-icon-split" href="{{ route('agen.index') }}">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="d-none d-md-block text">Kembali</span>
    </a>

    <div class="mt-2 mb-4">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="row no-gutters m-l-0 m-r-0">
                        <div class="col-sm-4">
                            <img src="{{ asset('img/' . $agen->foto_profil) }}" class="img-profile rounded-circle"
                                width="300">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600"><strong>Informasi</strong></h6>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-user"></i>
                                            Name
                                        </p>
                                        <h6 class="text-muted f-w-400">{{ $agen->name }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-envelope"></i>
                                            Email
                                        </p>
                                        <h6 class="text-muted f-w-400">{{ $agen->email }}</h6>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"><strong>Informasi Lanjut</strong>
                                </h6>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-mobile-alt"></i>
                                            No HP
                                        </p>
                                        <h6 class="text-muted f-w-400">{{ $agen->nohp }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-location-arrow"></i>
                                            Alamat
                                        </p>
                                        <h6 class="text-muted f-w-400">
                                            @isset($agen->alamat)
                                            <a href="{{ route('agen.lokasi', $agen->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-location-arrow"></i> Lokasi agen
                                            </a>
                                            @else
                                            {{ 'Agen belum ada alamat' }}
                                            @endisset
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>