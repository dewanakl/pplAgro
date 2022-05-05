<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgenController extends Controller
{
    public function index()
    {
        return view('owner.agen.index', ['agens' => User::role('agen')->orderBy('id', 'ASC')->get()]);
    }

    public function create()
    {
        return view('owner.agen.create');
    }

    public function show($id)
    {
        return view('owner.agen.show', ['agen' => User::role('agen')->find($id)]);
    }

    public function edit($id)
    {
        return view('owner.agen.edit', ['agen' => User::role('agen')->find($id)]);
    }

    public function lokasi($id)
    {
        return view('owner.agen.lokasi', ['agen' => User::role('agen')->find($id)]);
    }

    public function update(Request $request, $id)
    {
        $result = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'nohp' => ['required', 'string', 'min:3'],
            'alamat' => ['nullable', 'string', 'min:3'],
            'email' => ['required', 'email'],
        ]);

        User::role('agen')->find($id)->update($result);

        if (isset($request->password) && isset($request->konfirmasi_password)) {
            $request->validate([
                'password' => ['min:7', 'required_with:konfirmasi_password', 'same:konfirmasi_password'],
                'konfirmasi_password' => ['min:7']
            ]);
            User::role('agen')->find($id)->update([
                'password' => $request->konfirmasi_password
            ]);
        }

        return redirect('/agen')->with('success', 'Berhasil mengupdate agen');
    }

    public function store(Request $request)
    {
        $result = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'nohp' => ['required', 'string', 'min:3'],
            'alamat' => ['nullable', 'string', 'min:3'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required', 'min:7', 'required_with:konfirmasi_password', 'same:konfirmasi_password'],
            'konfirmasi_password' => ['required', 'min:7']
        ]);

        $result['idRole'] = 2;

        User::create($result)->assignRole('agen');

        return redirect('/agen')->with('success', 'Berhasil menambahkan agen');
    }

    // public function destroy($id)
    // {
    //     User::role('agen')->find($id)->delete();
    //     return redirect('/agen')->with('success', 'Berhasil menghapus agen');
    // }
}
