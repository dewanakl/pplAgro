<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        return view('owner.keuangan.index', [
            'rekapkeuangan' => DB::table('rekap_keuangan')->get()
        ]);
    }

    public function create()
    {
        return view('owner.keuangan.create');
    }

    public function store(Request $request)
    {
        //
    }
}
