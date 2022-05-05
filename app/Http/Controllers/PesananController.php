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
            ->where('status_pesanans.status_pesanan', '=', 'diproses')
            ->orderBy('pesanans.id', 'asc')->get();

        $statuspesanans = DB::table('pesanans')->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->where('users.id', $id)->where('status_pesanans.status_pesanan', '=', 'diproses')
            ->select(['status_pesanans.*'])->get();

        $riwayatpesanans = DB::table('pesanans')->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('riwayat_pesanans', 'pesanans.id', '=', 'riwayat_pesanans.pesanan_id')
            ->where('users.id', $id)
            ->select(['riwayat_pesanans.*', 'pesanans.keterangan'])->get();

        return view('agen.pesanan.index', [
            'pesanans' => $pesanans,
            'statuspesanans' => $statuspesanans,
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
                ->where('pesanans.id', $id)->select(['pesanans.*'])->first()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['required', 'string', 'min:3'],
        ]);

        $data = Pesanan::create([
            'user_id' => Auth::user()->id,
            'tanggal_pesanan' => now(),
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);

        DB::table('status_pesanans')->insert([
            'tanggal_pesanan' => now(),
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'status_pesanan' => 'diproses',
            'pesanan_id' => $data->id
        ]);

        return redirect()->route('agen.pesanan')->with('success', 'Pesanan berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['required', 'string', 'min:3'],
        ]);

        Pesanan::find($id)->update([
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);

        DB::table('status_pesanans')->where('pesanan_id', $id)->update([
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
        ]);

        return redirect()->route('agen.pesanan')->with('success', 'Berhasil mengupdate pesanan');
    }

    /**
     * owner
     */

    public function owner()
    {
        $pesanan = User::join('pesanans', 'users.id', '=', 'pesanans.user_id')
            ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->where('status_pesanans.status_pesanan', '=', 'diproses')
            ->orderBy('pesanans.id', 'asc')->get();

        $statuspesanan = DB::table('pesanans')->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->where('status_pesanans.status_pesanan', '=', 'diproses')
            ->select(['status_pesanans.*'])->get();

        $riwayatpesanan = DB::table('pesanans')->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('riwayat_pesanans', 'pesanans.id', '=', 'riwayat_pesanans.pesanan_id')
            ->select(['riwayat_pesanans.*', 'pesanans.keterangan'])->get();

        return view('owner.pesanan.index', [
            'pesanan' => $pesanan,
            'statuspesanan' => $statuspesanan,
            'riwayatpesanan' => $riwayatpesanan
        ]);
    }

    public function ownerEdit($id)
    {
        return view('owner.pesanan.edit', [
            'data' => Pesanan::join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
                ->where('pesanans.id', $id)->select(['status_pesanans.*'])->first()
        ]);
    }

    public function ownerUpdate(Request $request, $id)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'pemesanan' => ['required', 'string', 'min:3'],
        ]);

        DB::table('status_pesanans')->where('id', $id)->update([
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'status_pesanan' => $request->pemesanan,
        ]);

        $data = DB::table('status_pesanans')->where('id', $id)->latest()->first();

        DB::table('pesanans')->where('id', $data->pesanan_id)->update([
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
        ]);

        $agen = DB::table('pesanans')->join('users', 'users.id', '=', 'pesanans.user_id')
            ->where('pesanans.id', $data->pesanan_id)->select(['pesanans.tanggal_pesanan', 'users.name'])->first();

        if ($request->pemesanan == 'dikirim') {
            DB::table('riwayat_pesanans')->insert([
                'tanggal_pesanan' => $agen->tanggal_pesanan,
                'nama_agen' => $agen->name,
                'jumlah_pesanan' => $request->jumlah,
                'harga_pesanan' => $request->harga,
                'pesanan_id' => $data->pesanan_id
            ]);
        }

        return redirect()->route('owner.pesanan')->with('success', 'Status pesanan berhasil diubah');
    }

    public function ownerDetail($id)
    {
        return view('owner.pesanan.detail', [
            'data' => Pesanan::join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id', 'left')
                ->join('users', 'pesanans.user_id', '=', 'users.id')
                ->where('pesanans.id', $id)->select(['pesanans.*', 'users.name as namaagen', 'pembayarans.bukti_pembayaran'])->first()
        ]);
    }
}
