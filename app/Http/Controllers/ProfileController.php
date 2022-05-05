<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', ['user' => User::find(Auth::user()->id)]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => User::find(Auth::user()->id)]);
    }

    public function update(Request $request)
    {
        $result = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'nohp' => ['required', 'string', 'min:3'],
            'alamat' => ['nullable', 'string', 'min:3'],
            'email' => ['required', 'email'],
        ]);

        User::find(Auth::user()->id)->update($result);

        if (isset($request->password) && isset($request->konfirmasi_password)) {
            $request->validate([
                'password' => ['required', 'min:7', 'required_with:konfirmasi_password', 'same:konfirmasi_password'],
                'konfirmasi_password' => ['required', 'min:7']
            ]);
            User::find(Auth::user()->id)->update([
                'password' => $request->konfirmasi_password
            ]);
        }

        return redirect('/profile')->with('success', 'Profil berhasil diubah');
    }
}
