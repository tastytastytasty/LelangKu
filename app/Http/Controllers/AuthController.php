<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginMasyarakat(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('masyarakat')->attempt($credentials)) {
            $user = Auth::guard('masyarakat')->user();
            if ($user->status == 'blokir') {
                Auth::guard('masyarakat')->logout();
                return back()->with('error', 'Akun Anda diblokir. Silakan hubungi admin.');
            }
            $request->session()->regenerate();
            return redirect('/masyarakat/dashboard');
        }
        return back()->with('error', 'Username atau password salah');
    }

    public function loginPetugas(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('petugas')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/petugas/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('masyarakat')->check()) {
            Auth::guard('masyarakat')->logout();
        }

        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function showRegister()
    {
        return view('dashboard.register');
    }

    public function registerMasyarakat(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|max:25',
            'username' => 'required|digits:16|unique:masyarakat,username',
            'password' => 'required|min:6',
            'telp' => 'required|max:15',
            'alamat' => 'required'
        ], [
            'username.unique' => 'Username sudah digunakan!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);
        $masyarakat = Masyarakat::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'telp' => $request->telp,
            'alamat' => $request->alamat,
        ]);
        if (!$masyarakat) {
            return redirect()->back()->with('error', 'Akun gagal dibuat! Coba lagi nanti.');
        }
        Auth::guard('masyarakat')->login($masyarakat);
        return redirect('/masyarakat/dashboard')->with('success', 'Akun berhasil dibuat dan Anda telah login!');
    }
}
