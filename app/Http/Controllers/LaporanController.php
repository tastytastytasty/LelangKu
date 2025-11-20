<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\Lelang;

class LaporanController extends Controller
{
    public function index()
    {
        $user = auth()->guard('petugas')->user();
        $petugasList = Petugas::where('id_level', 2)->get();
        if ($user->id_level == '2') {

            $laporans = Lelang::with(['history', 'masyarakat', 'barang','petugas'])
                ->where('id_petugas',$user->id_petugas)
                ->get();
        } else {
            $laporans = Lelang::with(['history', 'masyarakat', 'barang','petugas'])
                ->get();
        }
        $grandTotal = $laporans
            ->where('status', 'ditutup')
            ->whereNotNull('id_user')
            ->sum('harga_akhir');
        return view('petugas.laporan.laporan', [
            'laporans' => $laporans,
            'petugasList' => $petugasList,
            'selectedPetugas' => null,
            'grandTotal' => $grandTotal
        ]);
    }

    public function cari(Request $request)
    {
        $user = auth()->guard('petugas')->user();
        $selectedPetugas = $request->petugas;
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $petugasList = Petugas::where('id_level', 2)->get();
        $query = $laporans = Lelang::with(['history', 'masyarakat', 'barang','petugas']);
        if ($user->id_level == 2) {
            $query->where('id_petugas', $user->id_petugas);
        }
        if ($selectedPetugas && $user->id_level != 2) {
            $query->where('id_petugas', $selectedPetugas);
        }

        if ($tgl_awal && $tgl_akhir) {
            $query->whereBetween('tgl_lelang', [$tgl_awal, $tgl_akhir]);
        }
        $laporans = $query->get();
        $grandTotal = $laporans
            ->where('status', 'ditutup')
            ->whereNotNull('id_user')
            ->sum('harga_akhir');
        return view('petugas.laporan.laporan', [
            'laporans' => $laporans,
            'petugasList' => $petugasList,
            'selectedPetugas' => $selectedPetugas,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'grandTotal' => $grandTotal
        ]);
    }
    public function cetak(Request $request)
    {
        $user = auth()->guard('petugas')->user();
        if ($user->id_level == 2) {
            $selectedPetugas = $user->id_petugas;
        } else {
            $selectedPetugas = $request->petugas ?? null;
        }
        $query = Lelang::with(['history', 'masyarakat', 'barang','petugas']);
        if (!empty($selectedPetugas)) {
            $query->where('id_petugas', $selectedPetugas);
        }
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $tglAwal = $request->tgl_awal;
            $tglAkhir = $request->tgl_akhir;

            $query->whereBetween('tgl_lelang', [$tglAwal, $tglAkhir]);
        }
        $laporans = $query->get();
        $jumlahLelang = $laporans->unique('id_lelang')->count();
        $grandTotal = $laporans
            ->where('status', 'ditutup')
            ->whereNotNull('id_user')
            ->sum('harga_akhir');
        return view('petugas.laporan.cetak', compact(
            'laporans',
            'grandTotal',
            'jumlahLelang',
            'user'
        ))->with([
                    'tgl_awal' => $request->tgl_awal,
                    'tgl_akhir' => $request->tgl_akhir,
                    'selectedPetugas' => $selectedPetugas
                ]);
    }
}
