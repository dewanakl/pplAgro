<x-app-layout title="Detail Pesanan">
    @section('styles')
    <style>
        .wrapper {
            object-position: center;
            object-fit: cover;
        }

        .wrapper img {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }
    </style>
    @endsection

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item"><a href="{{ route('owner.pesanan') }}">Pesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <a class="btn btn-warning btn-icon-split mb-3" href="{{ route('owner.pesanan') }}">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="d-none d-md-block text">Kembali</span>
    </a>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true"><strong>Detail</strong></a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status"
                aria-selected="false"><strong>Bukti</strong></a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row mt-4">
                <div class="col-xl-8 order-xl-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-info-circle"></i>
                                Detail Pesanan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="agen">
                                    <i class="fas fa-user fa-fw" style="font-size:13px;"></i>
                                    Agen :
                                </label>
                                <input type="text" name="agen" class="form-control" value="{{ $data->namaagen }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="alamat">
                                    <i class="fas fa-location-arrow"></i>
                                    Alamat :
                                </label>
                                <input type="text" name="alamat" class="form-control" value="{{ $data->alamatagen }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">
                                    <i class="fas fa-plus-circle"></i>
                                    Jumlah :
                                </label>
                                <input type="number" name="jumlah" class="form-control"
                                    value="{{ $data->jumlah_pesanan }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="harga">
                                    <i class="fas fa-dollar-sign"></i>
                                    Harga :
                                </label>
                                <input type="number" class="form-control" name="harga"
                                    value="{{ $data->harga_pesanan }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Keterangan :
                                </label>
                                <input type="text" class="form-control" name="keterangan"
                                    value="{{ $data->keterangan }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">
                                    <i class="fas fa-calendar"></i>
                                    Tanggal :
                                </label>
                                <input type="text" class="form-control" name="tanggal"
                                    value="{{ $data->tanggal_pesanan }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
            <div class="row mt-4">
                <div class="col-xl-8 order-xl-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">
                                <i class="fas fa-info-circle"></i>
                                Bukti Pesanan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="agen">
                                    <i class="fas fa-user fa-fw" style="font-size:13px;"></i>
                                    Agen :
                                </label>
                                <input type="text" name="agen" class="form-control" value="{{ $data->namaagen }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="alamat">
                                    <i class="fas fa-location-arrow"></i>
                                    Alamat :
                                </label>
                                <input type="text" name="alamat" class="form-control" value="{{ $data->alamatagen }}"
                                    disabled>
                            </div>
                            @isset($data->bukti_pembayaran)
                            <p><i class="fas fa-image"></i> Bukti :</p>
                            <a href="javascript:;" class="addAttr" title="Klik untuk memperbesar"
                                data-url="{{ asset('storage/posts/'. $data->bukti_pembayaran) }}">
                                <img src="{{ asset('storage/posts/'. $data->bukti_pembayaran) }}" width="300px" />
                            </a>
                            @else
                            <h4 class="text-danger">Agen belum melakukan pembayaran</h4>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrapper">
                        <img src="" id="url" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        $('.addAttr').click(function() {
            var url = $(this).attr('data-url');
            $('#url').attr('src', url);
            $('#showModal').modal('show');
        });
    </script>
    @endsection
</x-app-layout>