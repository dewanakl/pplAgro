<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HalamanUtamaController extends Controller
{
    public function __invoke()
    {
        return view('halamanUtama', ['data' => User::find(Auth::user()->id)]);
    }
}
