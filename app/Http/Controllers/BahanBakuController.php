<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanBakuController extends Controller
{
    public function index()
    {
        return view('owner.bahanbaku.index', [
            'data' => DB::table('bahan_baku')->orderBy('id')->get()
        ]);
    }

    public function create()
    {
        return view('owner.bahanbaku.create', [
            'namabahanbaku' => DB::table('bahan_baku')->get()
        ]);
    }

    public function edit($id)
    {
        return view('owner.bahanbaku.edit', [
            'data' => DB::table('bahan_baku')->where('id', $id)->first()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'jumlah' => ['required', 'integer'],
            'sisa' => ['required', 'integer']
        ]);

        DB::table('bahan_baku')->insert([
            'namaBahanBaku' => $request->nama,
            'jumlahStok' => $request->jumlah,
            'sisaStok' => $request->sisa
        ]);

        return redirect()->route('bahanbaku')->with('success', 'Berhasil menambahankan bahan baku');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'jumlah' => ['required', 'integer'],
            'sisa' => ['required', 'integer']
        ]);

        DB::table('bahan_baku')->where('id', $id)->update([
            'namaBahanBaku' => $request->nama,
            'jumlahStok' => $request->jumlah,
            'sisaStok' => $request->sisa
        ]);

        return redirect()->route('bahanbaku')->with('success', 'Berhasil mengedit bahan baku');
    }
}
