<x-app-layout title="Keuangan">
    @section('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    @endsection

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('halamanutama') }}">Halaman Utama</a></li>
            <li class="breadcrumb-item active" aria-current="page">Keuangan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between mb-2">
        <div>
            <h4 class="h4 text-dark">Keuangan</h4>
        </div>
        <div>
            <a class="btn btn-success btn-icon-split me-2" href="{{ route('keuangan.produk') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="d-none d-md-block text">Produk</span>
            </a>
            <a class="btn btn-primary btn-icon-split me-2" href="{{ route('keuangan.create') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="d-none d-md-block text">Keuangan</span>
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Grafik Keuangan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Daftar Keuangan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Tipe</th>
                            {{-- <th>Pendapatan Bersih</th> --}}
                            <th>Keterangan</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekapkeuangan as $idx => $keuangan)
                        <tr>
                            <td>{{ $idx + 1 }}</td>
                            <td>{{ date('Y-M-d', strtotime($keuangan->tanggal)) }}</td>
                            <td>Rp. {{ number_format($keuangan->pendapatan ?? $keuangan->pengeluaran ,0,',','.') }}
                            </td>
                            <td>{!! $keuangan->pengeluaran ?
                                '<span class="badge badge-danger"><i class="fas fa-arrow-down"></i> Pengeluaran</span>'
                                : '<span class="badge badge-success"><i class="fas fa-arrow-up"></i>
                                    Pendapatan</span>' !!}</td>
                            {{-- <td>Rp. {{ ($keuangan->pendapatan ?? 0) - ($keuangan->pengeluaran ?? 0) }}</td> --}}
                            <td>{{ $keuangan->keterangan }}</td>
                            <td>
                                <a href="{{ route('keuangan.edit', $keuangan->id) }}" class="btn btn-primary btn-sm">
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

    @section('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @if (session()->has('success'))
    <script>
        swal({title: "{{ session()->get('success') }}", text: "", type: "success"});
    </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#dataTable1').DataTable();
        });
    </script>
    <script>
        function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($bulan) !!},
            datasets: [{
                data: {{ json_encode($rekap) }},
                label: "Pendapatan",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.1)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,         
            }],
        },
        options: {
            maintainAspectRatio: false,
            scales: {
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                callback: function(value, index, values) {
                    return 'Rp. ' + number_format(value);
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleFontColor: '#6e707e',
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
                }
            }
            }
        }
        });
    </script>
    @endsection
</x-app-layout>