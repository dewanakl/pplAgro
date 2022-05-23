<x-app-layout title="Edit Keuangan">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('keuangan') }}">Keuangan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Keuangan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-xl-8 order-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-money-bill"></i>
                        Edit Keuangan
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('keuangan.update', $data->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="bulan">
                                <i class="fas fa-calendar-alt"></i>
                                Tanggal :
                            </label>
                            <input type="date" name="bulan" class="form-control @error('bulan') is-invalid @enderror"
                                value="{{ date('Y-m-d', strtotime($data->tanggal)) }}">
                            @error('bulan')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipe">
                                <i class="fas fa-money-check"></i>
                                Tipe :
                            </label>
                            <select class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe">
                                @if (old('tipe') != null)
                                <option value="{{ old('tipe') }}">{{ old('tipe') }}</option>
                                @endif
                                <option value="{{ $data->pendapatan ? 'Pendapatan' : 'Pengeluaran' }}" selected>{{
                                    $data->pendapatan ? 'Pendapatan' : 'Pengeluaran' }}</option>
                                <option value="Pendapatan">Pendapatan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                            @error('tipe')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah">
                                <i class="fas fa-dollar-sign"></i>
                                Jumlah :
                            </label>
                            <input type="number" min="1" step="1"
                                class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                                value="{{ $data->pendapatan ?? $data->pengeluaran }}" placeholder="Jumlah">
                            @error('jumlah')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-info"></i>
                                Keterangan :
                            </label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                name="keterangan" value="{{ $data->keterangan }}" placeholder="Keterangan">
                            @error('keterangan')
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
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>