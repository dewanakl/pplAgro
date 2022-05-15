<x-app-layout title="Edit Pesanan">
    @section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    @endsection

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('owner.pesanan') }}">Pesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-info-circle"></i>
                Edit Pesanan
            </h6>
        </div>
        <div class="card-body">
            <h5><strong>Status Pesanan</strong></h5>
            <div class="table-responsive mb-4">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->
                        <div class="step">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle" id="cdibuat"><i class="fas fa-clipboard"></i></span>

                                <span class="bs-stepper-label">Dibuat <small style="display: block" id="dibuat"></small>
                                </span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle" id="cterbayar"><i
                                        class="fas fa-money-bill-wave"></i></span>
                                <span class="bs-stepper-label">Terbayar <small style="display: block"
                                        id="terbayar"></small></span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle" id="cdiproses"><i class="fas fa-sync"></i></span>
                                <span class="bs-stepper-label">Diproses <small style="display: block"
                                        id="diproses"></small></span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle" id="cterkirim"><i class="fas fa-truck"></i></span>
                                <span class="bs-stepper-label">Terkirim <small style="display: block"
                                        id="terkirim"></small></span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle" id="cselesai"><i
                                        class="fas fa-clipboard-check"></i></span>
                                <span class="bs-stepper-label">Selesai <small style="display: block"
                                        id="selesai"></small></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('owner.pesanan.update', $data->id) }}">
                @csrf
                @method('put')
                {{-- <div class="form-group">
                    <label for="jumlah">
                        <i class="fas fa-plus-circle"></i>
                        Jumlah :
                    </label>
                    <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
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
                </div> --}}
                @isset($data->bukti_pembayaran)
                <div class="form-group">
                    <label for="pemesanan">
                        <i class="fas fa-exclamation-circle"></i>
                        Status Pesanan :
                    </label>
                    <select class="custom-select @error('pemesanan') is-invalid @enderror" name="pemesanan">
                        <option value="{{$data->status_pesanan }}" selected>Pesanan
                            {{$data->status_pesanan }}
                        </option>
                        <option value="diproses">Pesanan diproses</option>
                        <option value="dikirim">Pesanan dikirim</option>
                    </select>
                    @error('pemesanan')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                @else
                <h4 class="text-danger">Agen belum melakukan pembayaran</h4>
                @endisset
                <div class="modal-footer">
                    <a href="{{ route('owner.pesanan') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Batal
                    </a>
                    @isset($data->bukti_pembayaran)
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-paper-plane" style="font-size:13px"></i>
                        Simpan
                    </button>
                    @endisset
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script>
        let id = {{ $data->id }};
        fetch(`/status/${id}/pesanan`)
            .then((data) => data.json())
            .then((data) => {
                $('#info').hide();
                data.forEach((val) => {
                    Object.keys(val).forEach(function(key) {
                        var value = val[key];
                        $(`#${key}`).html(value);
                        $(`#c${key}`).attr('class', (value) ? 'bs-stepper-circle bg-success' : 'bs-stepper-circle');
                    });
                });
            });
    </script>
    @endsection
</x-app-layout>