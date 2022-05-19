<x-app-layout title="Edit Produk">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('keuangan') }}">Keuangan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-box"></i>
                        Edit Produk
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('keuangan.produk.update', $data->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nama">
                                <i class="fas fa-archive"></i>
                                Nama :
                            </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ $data->nama }}" placeholder="nama" readonly>
                            @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">
                                <i class="fas fa-dollar-sign"></i>
                                Harga :
                            </label>
                            <input type="number" min="1" step="1"
                                class="form-control @error('harga') is-invalid @enderror" name="harga"
                                value="{{ $data->harga }}" placeholder="harga">
                            @error('harga')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('keuangan') }}" class="btn btn-sm btn-secondary">
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
    </div>
</x-app-layout>