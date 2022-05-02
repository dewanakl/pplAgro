<x-app-layout title="Tambah Pesanan">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agen.pesanan') }}">Pesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-fw fa-user-cog" style="font-size:13px;"></i>
                        Tambah Pesanan
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('agen.pesanan.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="jumlah">
                                <i class="fas fa-user fa-fw" style="font-size:13px;"></i>
                                Jumlah :
                            </label>
                            <input type="number" name="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}"
                                placeholder="Jumlah">
                            @error('jumlah')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">
                                <i class="fas fa-envelope fa-fw" style="font-size:13px;"></i>
                                Harga :
                            </label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                                value="{{  old('harga') }}" placeholder="Harga">
                            @error('harga')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-mobile-alt"></i>
                                Keterangan :
                            </label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" value="{{ old('keterangan') }}" placeholder="Keterangan">
                            @error('keterangan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('agen.pesanan') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary" id="action">
                                <i class="fas fa-paper-plane" style="font-size:13px"></i>
                                Buat pesanan
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
                                Daftarkan agen sesuai dengan form yang tersedia
                            </b>
                        </small>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</x-app-layout>