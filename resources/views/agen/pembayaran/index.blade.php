<x-app-layout title="Pembayaran">
    @section('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
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
            <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between">
        <div>
            <h4 class="h4 text-dark">Pembayaran</h4>
        </div>
        <div>
            <a class="btn btn-primary btn-icon-split" href="{{ route('agen.pembayaran.create') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="d-none d-md-block text">Pembayaran</span>
            </a>
        </div>
    </div>

    <div class="card shadow mb-3 mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Pembayaran</h6>
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
                            <th>Bukti Pembayaran</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembayarans as $idx => $hasil)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ date('Y/m/d', strtotime($hasil->tanggal_pesanan)) }}</td>
                            <td>{{ $hasil->jumlah_pesanan }}</td>
                            <td>{{ $hasil->harga_pesanan }}</td>
                            <td>
                                <a href="javascript:;" class="addAttr" title="Klik untuk memperbesar"
                                    data-url="{{ asset('storage/posts/'. $hasil->bukti_pembayaran) }}">
                                    <img src="{{ asset('storage/posts/'. $hasil->bukti_pembayaran) }}" width="100px" />
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('agen.pembayaran.edit', $hasil->id) }}"
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
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.addAttr').click(function() {
            var url = $(this).attr('data-url');
            $('#url').attr('src', url);
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