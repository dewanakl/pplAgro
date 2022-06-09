<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public static function getRekap()
    {
        $month = [];
        $value = [];

        $pengeluaran = 0;

        collect(
            DB::table('rekap_keuangan')
                ->selectRaw("EXTRACT(MONTH FROM tanggal) AS tgl")
                ->selectRaw("COALESCE(SUM(pendapatan), 0) - COALESCE(SUM(pengeluaran), 0) AS rekap")
                ->groupBy('tgl')
                ->orderBy('tgl')
                ->get()
        )->each(function ($data) use (&$month, &$value) {
            $month[] = date('Y M', strtotime($data->tgl));
            $value[] = $data->rekap;
        });

        collect(
            DB::table('riwayat_pesanans')
                ->selectRaw("EXTRACT(MONTH FROM tanggal_pesanan) AS tgl")
                ->selectRaw("SUM(CAST(harga_pesanan AS INTEGER)) AS rekap")
                ->groupBy('tgl')
                ->orderBy('tgl')
                ->get()
        )->each(function ($data) use ($month, &$value) {
            collect($month)->each(function ($bulan, $idx) use ($data, &$value) {
                if ($bulan === date('Y M', strtotime($data->tgl))) {
                    $value[$idx] = $data->rekap + $value[$idx];
                }
            });
        });

        collect(
            DB::table('rekap_keuangan')
                ->selectRaw("COALESCE(SUM(pengeluaran), 0) AS rekap")
                ->get()
        )->each(function ($data) use (&$pengeluaran) {
            $pengeluaran += (int) $data->rekap;
        });

        return [$month, $value, $pengeluaran];
    }

    public function index()
    {
        $data = static::getRekap();
        return view('owner.keuangan.index', [
            'rekapkeuangan' => DB::table('rekap_keuangan')->orderBy('tanggal')->get(),
            'bulan' => $data[0],
            'rekap' => $data[1]
        ]);
    }

    public function create()
    {
        return view('owner.keuangan.create');
    }

    public function edit($id)
    {
        return view('owner.keuangan.edit', [
            'data' => DB::table('rekap_keuangan')->where('id', $id)->first()
        ]);
    }

    public function produk()
    {
        return view('owner.keuangan.produk', [
            'data' => DB::table('produk')->where('id', 1)->first()
        ]);
    }

    public function produkUpdate(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'harga' => ['required', 'numeric']
        ]);

        DB::table('produk')->where('id', 1)->update([
            'nama' => $request->nama,
            'harga' => $request->harga
        ]);

        return redirect()->route('keuangan')->with('success', 'Berhasil mengupdate produk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => ['required'],
            'tipe' => ['required'],
            'jumlah' => ['required', 'numeric'],
            'keterangan' => ['nullable'],
        ]);

        $data = [
            'tanggal' => Carbon::createFromTimestamp(strtotime($request->bulan))
        ];

        if ($request->tipe == 'Pendapatan') {
            $data['pendapatan'] = $request->jumlah;
        } else {
            $data['pengeluaran'] = $request->jumlah;
        }

        $data['keterangan'] = $request->keterangan ?? '';

        DB::table('rekap_keuangan')->insert($data);

        return redirect()->route('keuangan')->with('success', 'Data rekap keuangan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bulan' => ['required'],
            'tipe' => ['required'],
            'jumlah' => ['required', 'numeric'],
            'keterangan' => ['nullable'],
        ]);

        $data = [
            'tanggal' => Carbon::createFromTimestamp(strtotime($request->bulan))
        ];

        if ($request->tipe == 'Pendapatan') {
            $data['pendapatan'] = $request->jumlah;
            $data['pengeluaran'] = null;
        } else {
            $data['pendapatan'] = null;
            $data['pengeluaran'] = $request->jumlah;
        }

        $data['keterangan'] = $request->keterangan ?? '';

        DB::table('rekap_keuangan')->where('id', $id)->update($data);

        return redirect()->route('keuangan')->with('success', 'Data rekap keuangan berhasil diubah');
    }
}
