<x-app-layout title="Profile">
    @section('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Agen</li>
        </ol>
    </nav>

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
    @endif

    <!-- Page Heading -->
    <div class="d-flex justify-content-between mb-2">
        <div>
            <h3 class="h3 text-dark">Daftar Agen</h3>
        </div>
        <div>
            <a class="btn btn-primary btn-icon-split" href="{{ route('agen.create') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="d-none d-md-block text">Agen</span>
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Agen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agens as $agen)
                        <tr>
                            <td>{{ $agen->name }}</td>
                            <td>{{ $agen->email }}</td>
                            <td>{{ $agen->nohp }}</td>
                            <td>
                                <a href="{{ route('agen.show', $agen->id) }}" class="btn btn-success btn-circle m-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('agen.edit', $agen->id) }}" class="btn btn-warning btn-circle m-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-danger btn-circle m-1 addAttr"
                                    data-nama="{{ $agen->name }}" data-url="{{ route('agen.destroy', $agen->id) }}"><i
                                        class="fas fa-trash"></i></button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Apakah anda yakin ingin manghapus ?</div>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" value="" id="nama" disabled>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form method="POST" action="" id="deleteform">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.addAttr').click(function() {
            var nama = $(this).attr('data-nama');
            var url = $(this).attr('data-url');
            $('#nama').val(nama);
            $('#deleteform').attr('action', url);
            $('#hapusModal').modal('show');
        });
    </script>
    @endsection
</x-app-layout>