<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Agen
     */

    public function agen()
    {
        $id = Auth::user()->id;

        $pesanans = User::join('pesanans', 'users.id', '=', 'pesanans.user_id')
            ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->where('users.id', '=', $id)
            ->where('status_pesanans.status_pesanan', '!=', 'selesai')
            ->orderBy('pesanans.id', 'asc')
            ->get(['pesanans.*']);

        // $statuspesanans = DB::table('pesanans')
        //     ->join('users', 'pesanans.user_id', '=', 'users.id')
        //     ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
        //     ->where('users.id', $id)
        //     ->where('status_pesanans.status_pesanan', '=', 'diproses')
        //     ->select(['status_pesanans.*'])
        //     ->get();

        $riwayatpesanans = DB::table('pesanans')
            ->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('riwayat_pesanans', 'pesanans.id', '=', 'riwayat_pesanans.pesanan_id')
            ->where('users.id', $id)
            ->select(['riwayat_pesanans.*', 'pesanans.keterangan'])
            ->get();

        return view('agen.pesanan.index', [
            'pesanans' => $pesanans,
            'riwayatpesanans' => $riwayatpesanans,
        ]);
    }

    public function create()
    {
        return view('agen.pesanan.create');
    }

    public function edit($id)
    {
        return view('agen.pesanan.edit', [
            'data' => Pesanan::join('users', 'pesanans.user_id', '=', 'users.id')
                ->where('pesanans.id', $id)
                ->select(['pesanans.*'])
                ->first()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $data = Pesanan::create([
            'user_id' => Auth::user()->id,
            'tanggal_pesanan' => now(),
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'keterangan' => $request->keterangan ?? '',
            'dibuat' => now()
        ]);

        DB::table('status_pesanans')->insert([
            'tanggal_pesanan' => now(),
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'status_pesanan' => 'dibuat',
            'pesanan_id' => $data->id
        ]);

        return redirect()->route('agen.pesanan')->with('success', 'Pesanan berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Pesanan::find($id)->update([
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'keterangan' => $request->keterangan ?? '',
        ]);

        DB::table('status_pesanans')->where('pesanan_id', $id)->update([
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
        ]);

        return redirect()->route('agen.pesanan')->with('success', 'Berhasil mengupdate pesanan');
    }

    public function selesai($id)
    {
        Pesanan::where('id', $id)->update([
            'selesai' => now()
        ]);

        DB::table('status_pesanans')->where('pesanan_id', $id)->update([
            'status_pesanan' => 'selesai'
        ]);

        $data = Pesanan::where('id', $id)->first();

        DB::table('riwayat_pesanans')->insert([
            'tanggal_pesanan' => now(),
            'nama_agen' => Auth::user()->name,
            'jumlah_pesanan' => $data->jumlah_pesanan,
            'harga_pesanan' => $data->harga_pesanan,
            'pesanan_id' => $id
        ]);
        return redirect()->route('agen.pesanan')->with('success', 'Pesanan Selesai');
    }

    /**
     * All role can access
     */

    public function apiPesanan($id)
    {
        $data = Pesanan::where('id', $id)->first();

        return response()->json([
            ['dibuat' => $data->dibuat ?? null],
            ['terbayar' => $data->dibayar ?? null],
            ['diproses' => $data->diproses ?? null],
            ['terkirim' => $data->dikirim ?? null],
            ['selesai' => $data->selesai ?? null],
        ]);
    }

    /**
     * owner
     */

    public function owner()
    {
        $pesanan = User::join('pesanans', 'users.id', '=', 'pesanans.user_id')
            ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->where('status_pesanans.status_pesanan', '!=', 'selesai')
            ->orderBy('pesanans.id', 'asc')
            ->get();

        // $statuspesanan = DB::table('pesanans')
        //     ->join('users', 'pesanans.user_id', '=', 'users.id')
        //     ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
        //     ->where('status_pesanans.status_pesanan', '=', 'diproses')
        //     ->select(['status_pesanans.*'])
        //     ->get();

        $riwayatpesanan = DB::table('pesanans')
            ->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('riwayat_pesanans', 'pesanans.id', '=', 'riwayat_pesanans.pesanan_id')
            ->select(['riwayat_pesanans.*', 'pesanans.keterangan'])
            ->get();

        return view('owner.pesanan.index', [
            'pesanan' => $pesanan,
            'statuspesanan' => [],
            'riwayatpesanan' => $riwayatpesanan
        ]);
    }

    public function ownerEdit($id)
    {
        return view('owner.pesanan.edit', [
            'data' => Pesanan::join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
                ->join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id', 'left')
                ->where('pesanans.id', $id)
                ->select(['status_pesanans.*', 'pembayarans.bukti_pembayaran'])
                ->first()
        ]);
    }

    public function ownerDetail($id)
    {
        return view('owner.pesanan.detail', [
            'data' => Pesanan::join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id', 'left')
                ->join('users', 'pesanans.user_id', '=', 'users.id')
                ->where('pesanans.id', $id)
                ->select([
                    'pesanans.*',
                    'users.name as namaagen',
                    'users.alamat as alamatagen',
                    'pembayarans.bukti_pembayaran'
                ])
                ->first()
        ]);
    }

    public function ownerUpdate(Request $request, $id)
    {
        $request->validate([
            // 'jumlah' => ['required', 'numeric', 'min:1'],
            // 'harga' => ['required', 'numeric', 'min:1'],
            'pemesanan' => ['required', 'string', 'min:3'],
        ]);

        DB::table('status_pesanans')->where('id', $id)->update([
            // 'jumlah_pesanan' => $request->jumlah,
            // 'harga_pesanan' => $request->harga,
            'status_pesanan' => $request->pemesanan,
        ]);

        $data = DB::table('status_pesanans')->where('id', $id)->latest()->first();

        // DB::table('pesanans')->where('id', $data->pesanan_id)->update([
        //     'jumlah_pesanan' => $request->jumlah,
        //     'harga_pesanan' => $request->harga,
        // ]);

        if ($request->pemesanan == 'diproses') {
            DB::table('pesanans')->where('id', $data->pesanan_id)->update([
                'diproses' => now(),
                'dikirim' => null
            ]);
        }

        if ($request->pemesanan == 'dikirim') {
            // DB::table('riwayat_pesanans')->insert([
            //     'tanggal_pesanan' => $agen->tanggal_pesanan,
            //     'nama_agen' => $agen->name,
            //     'jumlah_pesanan' => $request->jumlah,
            //     'harga_pesanan' => $request->harga,
            //     'pesanan_id' => $data->pesanan_id
            // ]);
            $pesanan = DB::table('pesanans')->where('pesanans.id', $data->pesanan_id)->first();

            if (is_null($pesanan->diproses)) {
                $status = [
                    'diproses' => now(),
                    'dikirim' => now(),
                ];
            } else {
                $status = [
                    'dikirim' => now()
                ];
            }

            DB::table('pesanans')->where('id', $data->pesanan_id)->update($status);
        }

        return redirect()->route('owner.pesanan')->with('success', 'Status pesanan berhasil diubah');
    }
}
