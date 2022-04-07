<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgenController extends Controller
{
    public function index()
    {
        return view('owner.index', ['agens' => User::role('agen')->get()]);
    }

    public function create()
    {
        return view('owner.create');
    }

    public function store(Request $request)
    {
        $result = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        User::create($result)->assignRole('agen');

        return redirect('/agen');
    }
}
