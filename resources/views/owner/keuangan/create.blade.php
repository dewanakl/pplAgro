<x-app-layout title="Tambah Keuangan">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('keuangan') }}">Keuangan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Keuangan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-money-bill"></i>
                        Tambah Keuangan
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('keuangan.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="bulan">
                                <i class="fas fa-calendar-alt"></i>
                                Tanggal :
                            </label>
                            <input type="date" name="bulan" class="form-control @error('bulan') is-invalid @enderror"
                                value="{{ old('bulan') }}" placeholder="Nama">
                            @error('bulan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nohp">
                                <i class="fas fa-mobile-alt"></i>
                                Tipe :
                            </label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Pendapatan</option>
                                <option>Pengeluaran</option>
                            </select>
                            @error('nohp')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nohp">
                                <i class="fas fa-mobile-alt"></i>
                                Jumlah :
                            </label>
                            <input type="number" class="form-control @error('nohp') is-invalid @enderror" name="nohp"
                                value="{{ old('nohp') }}" placeholder="No HP">
                            @error('nohp')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>Keterangan</strong></label>
                            <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp"
                                value="{{ old('nohp') }}" placeholder="No HP">
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