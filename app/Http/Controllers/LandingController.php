<?php

namespace App\Http\Controllers;

use App\Models\User;

class LandingController extends Controller
{
    public function __invoke()
    {
        return view('landing', ['data' => User::role('owner')->find(1)]);
    }
}
