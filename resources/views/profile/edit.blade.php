<x-app-layout title="Profile Edit">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-fw fa-user-cog" style="font-size:13px;"></i>
                        Edit Profile
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-user fa-fw" style="font-size:13px;"></i>
                                Nama :
                            </label>
                            <input type="text" placeholder="Nama" class="form-control" name="name"
                                value="{{ $user->name }}">
                            @error('name')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope fa-fw" style="font-size:13px;"></i>
                                Email :
                            </label>
                            <input type="text" placeholder="Email" class="form-control" name="email"
                                value="{{ $user->email }}">
                            @error('email')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nohp">
                                <i class="fas fa-mobile-alt"></i>
                                No HP :
                            </label>
                            <input type="number" placeholder="nohp" class="form-control" name="nohp"
                                value="{{ $user->nohp }}">
                            @error('nohp')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">
                                <i class="fas fa-location-arrow"></i>
                                Alamat :
                            </label>
                            <input type="text" placeholder="alamat" class="form-control" name="alamat"
                                value="{{ $user->alamat }}">
                            @error('alamat')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="email">
                                    <i class="fas fa-lock fa-fw" style="font-size:13px;"></i>
                                    Password :
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password">
                                @error('password')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 ">
                                <label for="email">
                                    <i class="fas fa-sync fa-fw" style="font-size:13px;"></i>
                                    Konfirmasi Password :
                                </label>
                                <input type="password"
                                    class="form-control @error('konfirmasi_password') is-invalid @enderror"
                                    name="konfirmasi_password">
                                @error('konfirmasi_password')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('profile') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-paper-plane" style="font-size:13px"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-4 order-xl-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-fw fa-exclamation-circle" style="font-size:13px;"></i>
                        Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <small>
                            <i class="fas fa-dot-circle fa-fw" style="font-size:10px;"></i>
                            <b>
                                Untuk mengubah informasi akun tanpa mengubah password,
                                silahkan kosongkan password nya.
                            </b>
                        </small>
                    </div>
                    <div class="mb-4">
                        <small>
                            <i class="fas fa-dot-circle fa-fw" style="font-size:10px;"></i>
                            <b>Harap hati hati dalam mengubah password !</b>
                        </small>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

</x-app-layout>