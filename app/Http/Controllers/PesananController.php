<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        return view('agen.pesanan.index', ['data' => User::find(Auth::user()->id)->pesanans]);
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

    public function semuaPesanan()
    {
        return view('owner.pesanan.index', [
            'data' => User::join('pesanans', 'users.id', '=', 'pesanans.user_id')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['required', 'string', 'min:3'],
        ]);

        Pesanan::create([
            'user_id' => Auth::user()->id,
            'tanggal_pesanan' => now(),
            'jumlah_pesanan' => $request->jumlah,
            'harga_pesanan' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('agen.pesanan')->with('success', 'Berhasil menambahkan pesanan');
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

        return redirect()->route('agen.pesanan')->with('success', 'Berhasil mengupdate pesanan');
    }
}
