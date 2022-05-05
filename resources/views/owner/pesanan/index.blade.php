<x-app-layout title="Pesanan">
    @section('styles')
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
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status"
                aria-selected="false"><strong>Status</strong></a>
        </li>
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
                                    <td>Rp. {{ $hasil->harga_pesanan }}</td>
                                    <td>
                                        <a href="{{ route('owner.pesanan.detail', $hasil->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-info-circle"></i> Detail
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
        <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
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
                                        <td>{{ $pesanan->keterangan }}</td>
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
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    @if (count($riwayatpesanan) == 0)
                    <div class="col alert alert-danger mt-4">Belum ada riwayat</div>
                    @endif
                    @foreach ($riwayatpesanan as $pesanan)
                    <div class="col-xl-6 col-md-6 mt-4">
                        <div class="card border-left-success shadow">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success mb-1">
                                            {{ date('Y/m/d', strtotime($pesanan->tanggal_pesanan)) }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-dark">
                                            Rp. {{ $pesanan->harga_pesanan }}
                                        </div>
                                        <div class="h6 mb-1 font-weight-bold text-dark">
                                            Jumlah : {{ $pesanan->jumlah_pesanan }}
                                        </div>

                                        <div class="text-xs mb-0 mt-1 font-weight-bold text-dark">
                                            {{ $pesanan->nama_agen }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $('#dataTable1').DataTable();
        });
    </script>
    @if (session()->has('success'))
    <script>
        swal({title: "{{ session()->get('success') }}", text: "", type: "success"});
    </script>
    @endif
    @endsection
</x-app-layout>