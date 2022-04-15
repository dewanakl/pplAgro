<x-app-layout title="Lihat Agen">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                            <img src="{{ asset('img/undraw_profile.svg') }}" class="img-profile rounded-circle"
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
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"><strong>More Information</strong>
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
                                            <i class="fas fa-user-plus"></i>
                                            Tanggal Daftar
                                        </p>
                                        <h6 class="text-muted f-w-400">{{ $agen->created_at->diffForHumans() }}</h6>
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