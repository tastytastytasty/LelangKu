<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function updateMas(Request $request)
    {
        $user = Auth::guard('masyarakat')->user();

        $request->validate([
            'nama_lengkap' => 'required|max:25',
            'username' => 'required|unique:masyarakat,username,' . $user->id_user . ',id_user',
            'telp' => 'required|unique:masyarakat,telp,' . $user->id_user . ',id_user',
            'alamat' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($user->gambar) {
                Storage::disk('public')->delete($user->gambar);
            }
            $gambar = $request->file('gambar')->store('img', 'public');
        } else {
            $gambar = $user->gambar;
        }

        $data = $request->only(['nama_lengkap', 'username', 'telp', 'alamat']);
        $data['gambar'] = $gambar;
        if ($request->password) {
            if ($request->password !== $request->password_confirmation) {
                return back()->with('error', 'Password dan konfirmasi tidak sama!');
            }
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
    public function updatePet(Request $request)
    {
        $user = Auth::guard('petugas')->user();

        $request->validate([
            'nama_petugas' => 'required|max:25',
            'username' => 'required|unique:petugas,username,' . $user->id_petugas . ',id_petugas',
            'password' => 'nullable|min:6',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($user->gambar) {
                Storage::disk('public')->delete($user->gambar);
            }
            $gambar = $request->file('gambar')->store('img', 'public');
        } else {
            $gambar = $user->gambar;
        }

        $data = $request->only(['nama_petugas', 'username']);
        $data['gambar'] = $gambar;
        if ($request->password) {
            if ($request->password !== $request->password_confirmation) {
                return back()->with('error', 'Password dan konfirmasi tidak sama!');
            }
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
    public function edit()
    {
        $userm = auth()->guard('masyarakat')->user();
        $userp = auth()->guard('petugas')->user();
        return view('masyarakat.user', compact('userm', 'userp'));
    }
}
