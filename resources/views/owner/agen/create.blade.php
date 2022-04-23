<x-app-layout title="Tambah Agen">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agen.index') }}">Agen</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Agen</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-fw fa-user-cog" style="font-size:13px;"></i>
                        Tambah Agen
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('agen.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">
                                <i class="fas fa-user fa-fw" style="font-size:13px;"></i>
                                Nama :
                            </label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Nama">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope fa-fw" style="font-size:13px;"></i>
                                Email :
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{  old('email') }}" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nohp">
                                <i class="fas fa-mobile-alt"></i>
                                No HP :
                            </label>
                            <input type="number" class="form-control @error('nohp') is-invalid @enderror" name="nohp"
                                value="{{ old('nohp') }}" placeholder="No HP">
                            @error('nohp')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">
                                <i class="fas fa-location-arrow"></i>
                                Alamat :
                            </label>
                            <input type="text" placeholder="alamat" class="form-control" name="alamat"
                                value="{{ old('alamat') }}">
                            @error('alamat')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock fa-fw" style="font-size:13px;"></i>
                                Password :
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('agen.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary" id="action">
                                <i class="fas fa-paper-plane" style="font-size:13px"></i>
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 order-xl-5">
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
                                Daftarkan agen sesuai dengan form yang tersedia
                            </b>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>