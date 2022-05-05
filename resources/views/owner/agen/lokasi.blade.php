<x-app-layout title="Lokasi Agen">
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
            <li class="breadcrumb-item">Lokasi</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $agen->name }}</li>
        </ol>
    </nav>

    <a class="btn btn-warning btn-icon-split" href="{{ route('agen.show', $agen->id) }}">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="d-none d-md-block text">Kembali</span>
    </a>

    @isset($agen->alamat)
    <div id="map-container-google-1" class="z-depth-1-half map-container mb-4 mt-4" style="height: 500px">
        <iframe src="https://maps.google.com/maps?q={{ $agen->alamat }}&ie=UTF8&output=embed" frameborder="0"
            style="border:0" allowfullscreen></iframe>
    </div>
    @endisset
</x-app-layout>