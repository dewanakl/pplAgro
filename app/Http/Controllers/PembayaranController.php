<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = DB::table('pembayarans')
            ->join('pesanans', 'pembayarans.pesanan_id', '=', 'pesanans.id')
            ->join('users', 'pesanans.user_id', '=', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->whereNull('pesanans.selesai')
            ->select(['pembayarans.*', 'pesanans.tanggal_pesanan'])
            ->get();
        return view('agen.pembayaran.index', ['pembayarans' => $pembayarans]);
    }

    public function create()
    {
        $pemesanan = DB::table('pesanans')
            ->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->join('pembayarans', 'pesanans.id', '=', 'pembayarans.pesanan_id', 'left')
            ->where('users.id', Auth::user()->id)
            ->where('status_pesanans.status_pesanan', '=', 'dibuat')
            ->whereNull('pembayarans.bukti_pembayaran')
            ->select(['pesanans.*'])
            ->get();
        return view('agen.pembayaran.create', ['pemesanan' => $pemesanan]);
    }

    public function edit($id)
    {
        return view('agen.pembayaran.edit', [
            'pembayaran' => DB::table('pembayarans')
                ->join('pesanans', 'pembayarans.pesanan_id', '=', 'pesanans.id')
                ->where('pembayarans.id', $id)
                ->first(),
            // 'pembayarans' => DB::table('pembayarans')
            //     ->join('pesanans', 'pembayarans.pesanan_id', '=', 'pesanans.id')
            //     ->join('users', 'users.id', '=', 'pesanans.user_id')
            //     ->where('users.id', Auth::user()->id)
            //     ->where('pembayarans.id', $id)
            //     ->get(['pesanans.*'])
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pemesanan' => ['required', 'numeric', 'min:1'],
            'bukti_pembayaran' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
        ]);

        $image = $request->file('bukti_pembayaran');
        $data = DB::table('pesanans')->where('id', $request->pemesanan)->first();

        $list = [
            'jumlah_pesanan' => $data->jumlah_pesanan,
            'harga_pesanan' => $data->harga_pesanan,
            'pesanan_id' => $request->pemesanan
        ];

        if (isset($image)) {
            $dbimg = DB::table('pembayarans')->where('pesanan_id', $data->id)->first();
            $image->storeAs('public/posts', $image->hashName());
            $list['bukti_pembayaran'] = $image->hashName();


            @unlink(__DIR__ . '/../../../public/storage/posts/' . $dbimg->bukti_pembayaran);
            @Storage::delete('public/posts' . $dbimg->bukti_pembayaran);
        }

        DB::table('pembayarans')->where('pesanan_id', $id)->update($list);

        return redirect()->route('agen.pembayaran')->with('success', 'Berhasil mengupdate pembayaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesanan' => ['required', 'numeric', 'min:1'],
            'bukti_pembayaran' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:1024'],
        ]);

        $image = $request->file('bukti_pembayaran');
        $image->storeAs('public/posts', $image->hashName());

        $data = DB::table('pesanans')->where('id', $request->pemesanan)->first();

        DB::table('pembayarans')->insert([
            'jumlah_pesanan' => $data->jumlah_pesanan,
            'harga_pesanan' => $data->harga_pesanan,
            'bukti_pembayaran' => $image->hashName(),
            'pesanan_id' => $request->pemesanan
        ]);

        DB::table('status_pesanans')->where('pesanan_id', $data->id)->update([
            'status_pesanan' => 'dibayar'
        ]);

        DB::table('pesanans')->join('users', 'pesanans.user_id', '=', 'users.id')
            ->where('users.id', Auth::user()->id)
            ->where('pesanans.id', $data->id)
            ->update([
                'dibayar' => now()
            ]);

        return redirect()->route('agen.pembayaran')->with('success', 'Pembayaran berhasil dibuat');
    }
}
