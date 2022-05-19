<x-app-layout title="Bahan Baku">
    @section('styles')
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    @endsection

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bahan Baku</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between mb-2">
        <div>
            <h4 class="h4 text-dark">Bahan baku</h4>
        </div>
        <div>
            <a class="btn btn-primary btn-icon-split me-2" href="{{ route('bahanbaku.create') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="d-none d-md-block text">Bahan baku</span>
            </a>
        </div>
    </div>

    <div class="row">
        @foreach ($data as $hasil)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="h5 mb-1 font-weight-bold text-dark">
                        {{ $hasil->namaBahanBaku }}
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold text-gray-600 mb-0">
                            Jumlah : {{ $hasil->jumlahStok }} / {{ $hasil->sisaStok }}
                        </p>
                        <a href="{{ route('bahanbaku.edit', $hasil->id) }}" class="btn btn-warning btn-sm"><i
                                class="fas fa-edit"></i> Edit</a>
                    </div>


                    {{-- <div class="row no-gutters align-items-center">
                        <div class="col mr-2">


                            <p class="font-weight-bold text-dark mb-0">
                                Sisa :
                            </p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @section('scripts')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @if (session()->has('success'))
    <script>
        swal({title: "{{ session()->get('success') }}", text: "", type: "success"});
    </script>
    @endif
    @endsection
</x-app-layout>