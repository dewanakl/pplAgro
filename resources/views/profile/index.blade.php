<x-app-layout title="Profile">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-2">
        <div>
            <h3 class="h3 text-dark">Profile</h3>
        </div>
        <div>
            <a class="btn btn-warning btn-icon-split" href="{{ route('profile.edit') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="d-none d-md-block text">Edit</span>
            </a>
        </div>
    </div>

    <div class="mt-2 mb-4">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="row no-gutters m-l-0 m-r-0">
                        <div class="col-sm-4">
                            <img src="img/undraw_profile.svg" class="img-profile rounded-circle" width="300">
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
                                        <h6 class="text-muted f-w-400">{{ $user->name }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-envelope"></i>
                                            Email
                                        </p>
                                        <h6 class="text-muted f-w-400">{{ $user->email }}</h6>
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
                                        <h6 class="text-muted f-w-400">{{ $user->nohp }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">
                                            <i class="fas fa-location-arrow"></i>
                                            Alamat
                                        </p>
                                        <h6 class="text-muted f-w-400">
                                            @isset($user->alamat)
                                            <a href="https://www.google.com/maps/place/{{ $user->alamat }}"
                                                target="_blank" rel="noopener noreferrer">
                                                {{ $user->alamat }}
                                            </a>
                                            @else
                                            {{ 'Silahkan isi alamat untuk bertransaksi' }}
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