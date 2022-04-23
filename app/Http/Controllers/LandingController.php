<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function __invoke()
    {
        return view('landing', ['data' => DB::table('pabriks')->find(1)]);
    }
}
