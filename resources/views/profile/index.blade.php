<x-app-layout title="Profile">
    @section('styles')
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    @endsection

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between mb-2">
        <div>
            <h4 class="h4 text-dark">Profile</h4>
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
                            <img src="{{ asset('img/' . $user->foto_profil) }}" class="img-profile rounded-circle"
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
                                            <a href="https://maps.google.com/maps?q={{ $user->alamat }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-success btn-sm">
                                                <i class="fas fa-location-arrow"></i> Lokasi Anda
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

    @section('scripts')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @if (session()->has('success'))
    <script>
        swal({title: "{{ session()->get('success') }}", text: "", type: "success"});
    </script>
    @endif
    @endsection
</x-app-layout>