<x-app-layout title="Tambah Bahan Baku">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('bahanbaku') }}">Bahan Baku</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Bahan Baku</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-money-bill"></i>
                        Tambah Bahan Baku
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('bahanbaku.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nama">
                                <i class="fas fa-info"></i>
                                Nama :
                            </label>
                            <select class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                                @foreach ($namabahanbaku as $hasil)
                                <option value="{{ $hasil->id }}">{{ $hasil->namaBahanBaku }}</option>
                                @endforeach
                            </select>
                            @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">
                                <i class="fas fa-dollar-sign"></i>
                                Jumlah :
                            </label>
                            <input type="number" min="0" step="1"
                                class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                                value="{{ old('jumlah') }}" placeholder="Jumlah">
                            @error('jumlah')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sisa">
                                <i class="fas fa-dollar-sign"></i>
                                Sisa :
                            </label>
                            <input type="number" min="0" step="1"
                                class="form-control @error('sisa') is-invalid @enderror" name="sisa"
                                value="{{ old('sisa') }}" placeholder="sisa">
                            @error('sisa')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('bahanbaku') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary" id="action">
                                <i class="fas fa-paper-plane" style="font-size:13px"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>