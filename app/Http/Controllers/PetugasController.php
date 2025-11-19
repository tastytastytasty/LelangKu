<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    public function index()
    {
        $petugass = Petugas::with('level')->get();
        return view('petugas.admin.petugas', compact('petugass'));
    }
    public function create()
    {
        $levels = Level::all();
        return view('petugas.admin.formpet', compact('levels'));
    }
    public function store(Request $request)
    {
        if (Petugas::where('username', $request->username)->exists()) {
            return redirect()->route('petugas')->with('error', 'Username sudah dipakai!');
        }
        $nama = $request->nama_petugas;
        $username = $request->username;
        $password = bcrypt($request->password);
        $level = $request->level;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('img', 'public');
        } else {
            $gambar = '-----';
        }
        Petugas::create([
            'nama_petugas' => $nama,
            'username' => $username,
            'password' => $password,
            'id_level' => $level,
            'gambar' => $gambar,
        ]);
        return redirect()->route('petugas')->with('success', 'Petugas berhasil ditambahkan!');
    }
    public function show(string $id)
    {

    }
    public function edit(string $id)
    {
        $levels = Level::all();
        $petugas = Petugas::findOrFail($id);
        return view('petugas.admin.formpet', compact('petugas', 'levels'));
    }
    public function update(Request $request, $id)
    {
        if (Petugas::where('username', $request->username)->where('id_petugas', '!=', $id)->exists()) {
            return redirect()->route('petugas')->with('error', 'Username sudah dipakai!');
        }
        $petugas = Petugas::findOrFail($id);
        if ($request->hasFile('gambar')) {
            if ($petugas->gambar) {
                Storage::disk('public')->delete($petugas->gambar);
            }
            $gambarBaru = $request->file('gambar')->store('img', 'public');
            $gambar = $gambarBaru;
        } else {
            $gambar = $petugas->gambar;
        }
        $data = [
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'id_level' => $request->level,
            'gambar' => $gambar,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('petugas')->with('success', 'Petugas berhasil dirubah!');
    }
    public function destroy(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        if ($petugas->gambar) {
            Storage::disk('public')->delete($petugas->gambar);
        }
        $petugas->delete();

        return redirect()->route('petugas')->with('success', 'Petugas berhasil dihapus!');
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $petugass = Petugas::where('nama_petugas', 'like', "%" . $cari . "%")->get();
        return view('petugas.admin.petugas', compact('petugass'));
    }
}
