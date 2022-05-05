<x-app-layout title="Edit Pembayaran">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('agen.pembayaran') }}">Pembayaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-info-circle"></i>
                        Edit pembayaran
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('agen.pembayaran.update', $pembayaran->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="pemesanan">
                                <i class="fas fa-plus-circle"></i>
                                Pilih pemesanan :
                            </label>
                            <select class="custom-select @error('pemesanan') is-invalid @enderror" name="pemesanan">
                                @if(null !== old('pemesanan'))
                                <?php $data = DB::table('pesanans')->where('id', old('pemesanan'))->first(); ?>
                                <option selected value="{{ old('pemesanan') }}">
                                    {{ date('Y/m/d', strtotime($data->tanggal_pesanan)) . ' - ' . $data->keterangan }}
                                </option>
                                @else
                                <option selected value="{{ $pembayaran->id }}">
                                    {{ date('Y/m/d', strtotime($pembayaran->tanggal_pesanan)) . ' - ' .
                                    $pembayaran->keterangan }}
                                </option>
                                @foreach (DB::table('pesanans')->get() as $pesan)
                                <option value="{{ $pesan->id }}">
                                    {{ date('Y/m/d', strtotime($pesan->tanggal_pesanan)) . ' - ' . $pesan->keterangan }}
                                </option>
                                @endforeach
                                @endisset
                            </select>
                            @error('pemesanan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bukti_pembayaran">
                                <i class="fas fa-exclamation-circle"></i>
                                Bukti :
                            </label>
                            <input type="file" accept=".png,.jpg,.jpeg"
                                class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                name="bukti_pembayaran">
                            @error('bukti_pembayaran')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('agen.pembayaran') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary" id="action">
                                <i class="fas fa-paper-plane" style="font-size:13px"></i>
                                Simpan pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>