<x-app-layout title="Edit Pesanan">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agen.pesanan') }}">Pesanan</a></li>
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
                    <form method="post" action="{{ route('agen.pesanan.update', $data->id) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="jumlah">
                                <i class="fas fa-plus-circle"></i>
                                Jumlah :
                            </label>
                            <input type="number" min="1" step="1" name="jumlah" id="jumlah" oninput="autoNum()"
                                class="form-control @error('jumlah') is-invalid @enderror"
                                value="{{ $data->jumlah_pesanan }}" placeholder="Jumlah" @isset($data->dibayar)
                            disabled
                            @endisset>
                            @error('jumlah')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">
                                <i class="fas fa-dollar-sign"></i>
                                Harga :
                            </label>
                            <input type="hidden" id="harga" name="harga" value="{{ $data->harga_pesanan }}">
                            <input type="text" id="showharga" class="form-control @error('harga') is-invalid @enderror"
                                placeholder="Rp. 0" disabled>
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
                                name="keterangan" value="{{$data->keterangan }}" placeholder="Keterangan"
                                @isset($data->dibayar)
                            disabled
                            @endisset>
                            @error('keterangan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('agen.pesanan') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary" @isset($data->dibayar)
                                disabled
                                @endisset>
                                <i class="fas fa-paper-plane" style="font-size:13px"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script defer>
        const autoNum = () => {
            let num = document.getElementById('jumlah').value * 5000;
            let	numStr = num.toString();

            let sisa = numStr.length % 3;
            let rupiah = numStr.substr(0, sisa);
            let ribuan = numStr.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            document.getElementById("harga").value = num;
            document.getElementById("showharga").value = 'Rp. ' + rupiah;
        }
        autoNum();
    </script>
</x-app-layout>