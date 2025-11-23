<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lelang;
use App\Models\Barang;
use App\Models\History;

class LelangController extends Controller
{
    public function index()
    {
        if (auth()->guard('masyarakat')->check()) {
            $lelangs = Lelang::with(['barang', 'masyarakat', 'petugas'])->where('status', 'dibuka')
            ->orderBy('created_at', 'DESC')->get();
        } else {
            $id = auth()->guard('petugas')->user()->id_petugas;
            $lelangs = Lelang::with(['barang', 'masyarakat', 'petugas'])->where('id_petugas', $id)->get();
        }
        return view('masyarakat.lelang', compact('lelangs'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('masyarakat.formlel', compact('barangs'));
    }

    public function store(Request $request)
    {
        $id_barang = $request->input('id_barang');
        $barang = Barang::findOrFail($id_barang);

        Lelang::create([
            'id_barang' => $id_barang,
            'tgl_lelang' => $request->input('tgl_lelang'),
            'harga_awal' => $barang->harga_awal,
            'harga_akhir' => $barang->harga_awal,
            'id_user' => null,
            'id_petugas' => auth()->guard('petugas')->user()->id_petugas,
            'status' => 'ditutup',
        ]);
        return redirect()->route('lelang')->with('success', 'Lelang berhasil ditambahkan!');

    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $lelang = Lelang::findOrFail($id);
        $barangs = Barang::all();
        return view('masyarakat.formlel', compact('lelang', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $lelang = Lelang::findOrFail($id);

        $data = [
            'id_barang' => $request->id_barang,
            'tgl_lelang' => $request->tgl_lelang,
            'harga_awal' => $lelang->harga_awal,
            'id_petugas' => $lelang->id_petugas,
        ];
        if (auth()->guard('petugas')->check()) {
            $data['status'] = $request->status;
            $data['harga_akhir'] = $lelang->harga_akhir;
            $data['id_user'] = $lelang->id_user;
        }
        if (auth()->guard('masyarakat')->check()) {
            $data['harga_akhir'] = $request->harga_akhir;
            $data['id_user'] = $request->id_user;
            $data['status'] = $lelang->status;
        }

        $lelang->update($data);
        if (auth()->guard('masyarakat')->check()) {
            History::create([
                'id_lelang' => $lelang->id_lelang,
                'id_barang' => $lelang->id_barang,
                'id_user' => $data['id_user'],
                'penawaran_harga' => $request->harga_akhir,
            ]);
        }

        return redirect()->route('lelang')->with('success', 'Lelang berhasil dirubah!');
    }

    public function destroy(string $id)
    {
        $lelang = Lelang::findOrFail($id);
        $lelang->delete();
        return redirect()->route('lelang')->with('success', 'Lelang berhasil dihapus!');
    }
    public function cari(Request $request)
    {
        $cari = $request->input('cari');
        if (auth()->guard('masyarakat')->check()) {
            $user = auth()->guard('masyarakat')->user();
            $lelangs = Lelang::whereHas('barang', function ($query) use ($cari) {
                $query->where('nama_barang', 'like', '%' . $cari . '%')->where('status', 'dibuka');
            })->with(['barang', 'masyarakat', 'petugas'])->get();
        } else {
            $user = auth()->guard('petugas')->user();
            $lelangs = Lelang::whereHas('barang', function ($query) use ($cari) {
                $query->where('nama_barang', 'like', '%' . $cari . '%');
            })->where('id_petugas', $user->id_petugas)
                ->with(['barang', 'masyarakat', 'petugas'])->get();
        }
        return view('masyarakat.lelang', compact('lelangs'));
    }
    public function dash()
    {
        $lelangs = Lelang::with(['barang', 'masyarakat', 'petugas'])
            ->where('status', 'dibuka')
            ->where('tgl_lelang', '<=', Carbon::today())
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
        $lelangis = Lelang::with(['barang', 'masyarakat', 'petugas'])
            ->where('tgl_lelang', '>', Carbon::today())
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
        return view('masyarakat.dashboard', compact('lelangs', 'lelangis'));
    }
    public function board()
    {
        $id = auth()->guard('petugas')->user()->id_petugas;
        $lelangs = Lelang::with(['barang', 'masyarakat', 'petugas'])
        ->where('id_petugas', $id)
        ->where('tgl_lelang', '<=', Carbon::today())
        ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
        $id = auth()->guard('petugas')->user()->id_petugas;
        $lelangis = Lelang::with(['barang', 'masyarakat', 'petugas'])
            ->where('tgl_lelang', '>', Carbon::today())
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
        return view('petugas.dashboard', compact('lelangs', 'lelangis'));
    }
}
