<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HalamanUtamaController extends Controller
{
    public function __invoke()
    {
        return (Auth::user()->idRole == 1) ? $this->owner() : $this->agen(Auth::user()->id);
    }

    private function owner()
    {
        $data = fn ($status) => Pesanan::join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->where('status_pesanans.status_pesanan', $status)->get();

        $rekap = KeuanganController::getRekap();

        return view('owner.halamanUtama', [
            'dibuat' => count($data('dibuat')),
            'terbayar' => count($data('dibayar')),
            'diproses' => count($data('diproses')),
            'terkirim' => count($data('dikirim')),
            'agen' => count(User::where('idRole', 2)->get()),
            'pendapatan' => array_sum($rekap[1]) + $rekap[2],
            'pengeluaran' => $rekap[2],
            'bersih' => array_sum($rekap[1])
        ]);
    }

    private function agen($id)
    {
        $data = fn ($status) => User::join('pesanans', 'users.id', '=', 'pesanans.user_id')
            ->join('status_pesanans', 'pesanans.id', '=', 'status_pesanans.pesanan_id')
            ->where('users.id', '=', $id)
            ->where('status_pesanans.status_pesanan', $status)
            ->get();

        $riwayat = DB::table('pesanans')
            ->join('users', 'pesanans.user_id', '=', 'users.id')
            ->join('riwayat_pesanans', 'pesanans.id', '=', 'riwayat_pesanans.pesanan_id')
            ->where('users.id', $id)
            ->selectRaw('sum(CAST(riwayat_pesanans.jumlah_pesanan AS INTEGER)) as jumlah')
            ->selectRaw("sum(CAST(riwayat_pesanans.harga_pesanan AS INTEGER)) as harga")
            ->first();

        return view('agen.halamanUtama', [
            'diproses' => $data('diproses'),
            'dikirim' => $data('dikirim'),
            'pesanan' => $riwayat->jumlah,
            'harga' => $riwayat->harga,
        ]);
    }
}
