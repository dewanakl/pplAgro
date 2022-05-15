<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HalamanUtamaController extends Controller
{
    public function __invoke()
    {
        $id = Auth::user()->id;
        return (Auth::user()->idRole == 1) ? $this->owner($id) : $this->agen($id);
    }

    private function owner($id)
    {
        return view('owner.halamanUtama', ['data' => User::find($id)]);
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
            ->selectRaw(
                'sum(CAST(riwayat_pesanans.jumlah_pesanan AS INTEGER)) as jumlah, sum(CAST(riwayat_pesanans.harga_pesanan AS INTEGER)) as harga'
            )->first();

        return view('agen.halamanUtama', [
            'diproses' => $data('diproses'),
            'dikirim' => $data('dikirim'),
            'pesanan' => $riwayat->jumlah,
            'harga' => $riwayat->harga,
        ]);
    }
}
