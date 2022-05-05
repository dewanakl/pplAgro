<x-app-layout title="Edit Pesanan">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('owner.pesanan') }}">Pesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-info-circle"></i>
                        Edit Pesanan
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('owner.pesanan.update', $data->id) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="jumlah">
                                <i class="fas fa-plus-circle"></i>
                                Jumlah :
                            </label>
                            <input type="number" name="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror"
                                value="{{ $data->jumlah_pesanan }}" placeholder="Jumlah">
                            @error('jumlah')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">
                                <i class="fas fa-dollar-sign"></i>
                                Harga :
                            </label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                                value="{{ $data->harga_pesanan }}" placeholder="Harga">
                            @error('harga')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-exclamation-circle"></i>
                                Keterangan :
                            </label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" value="{{$data->keterangan }}" placeholder="Keterangan">
                            @error('keterangan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('owner.pesanan') }}" class="btn btn-sm btn-secondary">
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
    </div>

</x-app-layout>