<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakats = Masyarakat::all();
        return view('petugas.admin.masyarakat', compact('masyarakats'));
    }

    public function create()
    {
        return view('petugas.admin.formmas');
    }
    public function store(Request $request)
    {
        if (Masyarakat::where('username', $request->username)->exists()) {
            return redirect()->route('masyarakat')->with('error', 'NIK sudah dipakai!');
        }
        if (Masyarakat::where('telp', $request->telp)->exists()) {
            return redirect()->route('masyarakat')->with('error', 'No telpon sudah dipakai!');
        }
        $nama = $request->nama_lengkap;
        $username = $request->username;
        $password = bcrypt($request->password);
        $alamat = $request->alamat;
        $telp = $request->telp;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('img', 'public');
        } else {
            $gambar = 'img/no.jpg';
        }
        $status = $request->status;
        Masyarakat::create([
            'nama_lengkap' => $nama,
            'username' => $username,
            'password' => $password,
            'alamat' => $alamat,
            'telp' => $telp,
            'gambar' => $gambar,
            'status' => $status,
        ]);
        return redirect()->route('masyarakat')->with('success', 'Masyarakat berhasil ditambahkan!');
    }
    public function show(string $id)
    {

    }
    public function edit(string $id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('petugas.admin.formmas', compact('masyarakat'));
    }
    public function update(Request $request, $id)
    {
        if (Masyarakat::where('username', $request->username)->where('id_user', '!=', $id)->exists()) {
            return redirect()->route('masyarakat')->with('error', 'NIK sudah dipakai!');
        }
        if (Masyarakat::where('telp', $request->telp)->where('id_user', '!=', $id)->exists()) {
            return redirect()->route('masyarakat')->with('error', 'No telpon sudah dipakai!');
        }
        $masyarakat = Masyarakat::findOrFail($id);
        if ($request->hasFile('gambar')) {
            if ($masyarakat->gambar) {
                Storage::disk('public')->delete($masyarakat->gambar);
            }
            $gambarBaru = $request->file('gambar')->store('img', 'public');
            $gambar = $gambarBaru;
        } else {
            $gambar = $masyarakat->gambar;
        }
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'gambar' => $gambar,
            'status' => $request->status,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $masyarakat->update($data);

        return redirect()->route('masyarakat')->with('success', 'Masyarakat berhasil dirubah!');
    }
    public function destroy(string $id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        if ($masyarakat->gambar && $masyarakat->gambar != 'img/no.jpg') {
            Storage::disk('public')->delete($masyarakat->gambar);
        }
        $masyarakat->delete();

        return redirect()->route('masyarakat')->with('success', 'Masyarakat berhasil dihapus!');
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $masyarakats = Masyarakat::where('nama_lengkap', 'like', "%" . $cari . "%")->get();
        return view('petugas.admin.masyarakat', compact('masyarakats'));
    }
}
