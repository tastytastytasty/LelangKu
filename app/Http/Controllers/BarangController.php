<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('petugas.barang.barang', compact('barangs'));
    }

    public function create()
    {
        return view('petugas.barang.form');
    }

    public function store(Request $request)
    {
        $nama = $request->nama_barang;
        $tanggal = Carbon::now()->toDateString();
        $harga_awal = $request->harga_awal;
        $deskripsi = $request->deskripsi;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('img', 'public');
        } else {
            $gambar = 'img/box.jpg';
        }
        Barang::create([
            'nama_barang' => $nama,
            'tgl' => $tanggal,
            'harga_awal' => $harga_awal,
            'deskripsi' => $deskripsi,
            'gambar' => $gambar,
        ]);
        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('petugas.barang.form', compact('barang'));
    }

    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);
        if ($request->hasFile('gambar')) {
            if ($barang->gambar && $barang->gambar != 'img/box.jpg') {
                Storage::disk('public')->delete($barang->gambar);
            }
            $gambarBaru = $request->file('gambar')->store('img', 'public');
            $gambar = $gambarBaru;
        } else {
            $gambar = $barang->gambar;
        }
        $data = [
            'nama_barang' => $request->nama_barang,
            'harga_awal' => $request->harga_awal,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ];
        $barang->update($data);
        return redirect()->route('barang')->with('success', 'Barang berhasil dirubah!');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->gambar && $barang->gambar != 'img/box.jpg') {
            Storage::disk('public')->delete($barang->gambar);
        }
        $barang->delete();

        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus!');
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $barangs = Barang::where('nama_barang', 'like', "%" . $cari . "%")->get();
        return view('petugas.barang.barang', compact('barangs'));
    }
}
