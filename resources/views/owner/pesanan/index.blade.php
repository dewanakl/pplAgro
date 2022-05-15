<x-app-layout title="Pesanan">
    @section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    @endsection

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
        </ol>
    </nav>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true"><strong>Pesanan</strong></a>
        </li>
        {{-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status"
                aria-selected="false"><strong>Status</strong></a>
        </li> --}}
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                aria-selected="false"><strong>Riwayat</strong></a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Daftar Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $idx => $hasil)
                                <tr>
                                    <td>{{ $idx + 1 }}</td>
                                    <td>{{ date('Y/m/d', strtotime($hasil->tanggal_pesanan)) }}</td>
                                    <td>{{ $hasil->jumlah_pesanan }}</td>
                                    <td>Rp. {{ number_format($hasil->harga_pesanan ,0,',','.') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('owner.pesanan.detail', $hasil->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>
                                            <a href="javascript:;" class="addAttr btn btn-warning btn-sm"
                                                data-id="{{ $hasil->id }}"
                                                data-url="{{ route('owner.pesanan.edit', $hasil->id) }}">
                                                <i class="fas fa-bell"></i> Status
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Status Pesanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statuspesanan as $idx => $pesanan)
                                    <tr>
                                        <td>{{ $idx + 1 }}</td>
                                        <td>{{ date('Y/m/d', strtotime($hasil->tanggal_pesanan)) }}</td>
                                        <td>{{ $pesanan->jumlah_pesanan }}</td>
                                        <td>Rp. {{ $pesanan->harga_pesanan }}</td>
                                        <td>{{ $pesanan->status_pesanan }}</td>
                                        <td>
                                            <a href="{{ route('owner.pesanan.edit', $pesanan->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card shadow mb-4 mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Riwayat Pesanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Agen</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayatpesanan as $idx => $hasil)
                                    <tr>
                                        <td>{{ $idx + 1 }}</td>
                                        <td>{{ $hasil->nama_agen }}</td>
                                        <td>{{ date('Y/m/d', strtotime($hasil->tanggal_pesanan)) }}</td>
                                        <td>{{ $hasil->jumlah_pesanan }}</td>
                                        <td>Rp. {{ number_format($hasil->harga_pesanan ,0,',','.') }}</td>
                                        <td>{{ $hasil->keterangan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModal" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="h4 text-dark">Status Pesanan</h4>
                        </div>
                        <div>
                            <div class="spinner-border" role="status" id="info">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <small class="text-dark font-weight-bold" id="showID"></small>
                    <div class="table-responsive mb-4">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle" id="cdibuat"><i
                                                class="fas fa-clipboard"></i></span>

                                        <span class="bs-stepper-label">Dibuat <small style="display: block"
                                                id="dibuat"></small>
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
                                        <span class="bs-stepper-circle" id="cdiproses"><i
                                                class="fas fa-sync"></i></span>
                                        <span class="bs-stepper-label">Diproses <small style="display: block"
                                                id="diproses"></small></span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle" id="cterkirim"><i
                                                class="fas fa-truck"></i></span>
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
                    <a id="link" href="" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $('#dataTable1').DataTable();
        });

        $('.addAttr').click(function() {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            $('#link').attr('href', url);
            $('#showID').text('ID Pesanan : ' + id);
            $('#info').show();
            
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

            $('#showModal').modal('show');
        });
    </script>
    @if (session()->has('success'))
    <script>
        swal({title: "{{ session()->get('success') }}", text: "", type: "success"});
    </script>
    @endif
    @endsection
</x-app-layout>