<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Petugas;

class LaporanController extends Controller
{
    public function index()
    {
        $user = auth()->guard('petugas')->user();
        $petugasList = Petugas::where('id_level', 2)->get();
        if ($user->id_level == '2') {

            $laporans = History::with(['lelang', 'masyarakat', 'barang'])
                ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
                ->whereHas('lelang', function ($query) use ($user) {
                    $query->where('id_petugas', $user->id_petugas);
                })
                ->groupBy('id_lelang', 'id_barang', 'id_user')
                ->get();

        } else {
            $laporans = History::with(['lelang', 'masyarakat', 'barang'])
                ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
                ->groupBy('id_lelang', 'id_barang', 'id_user')
                ->get();
        }
        $grandTotal = $laporans
            ->where('lelang.status', 'ditutup')
            ->whereNotNull('lelang.id_user')
            ->sum('lelang.harga_akhir');
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
        $query = History::with(['lelang', 'masyarakat', 'barang'])
            ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user');
        if ($user->id_level == 2) {
            $query->whereHas(
                'lelang',
                fn($q) =>
                $q->where('id_petugas', $user->id_petugas)
            );
        }
        if ($selectedPetugas && $user->id_level != 2) {
            $query->whereHas('lelang', function ($q) use ($selectedPetugas) {
                $q->where('id_petugas', $selectedPetugas);
            });
        }

        if ($tgl_awal && $tgl_akhir) {
            $query->whereHas('lelang', function ($q) use ($tgl_awal, $tgl_akhir) {
                $q->whereBetween('tgl_lelang', [$tgl_awal, $tgl_akhir]);
            });
        }
        $laporans = $query->groupBy('id_lelang', 'id_barang', 'id_user')->get();
        $grandTotal = $laporans
            ->where('lelang.status', 'ditutup')
            ->whereNotNull('lelang.id_user')
            ->sum('lelang.harga_akhir');
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
        $query = History::with(['lelang', 'barang', 'masyarakat'])
            ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
            ->groupBy('id_lelang', 'id_barang', 'id_user');
        if (!empty($selectedPetugas)) {
            $query->whereHas('lelang', function ($q) use ($selectedPetugas) {
                $q->where('id_petugas', $selectedPetugas);
            });
        }
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $tglAwal = $request->tgl_awal;
            $tglAkhir = $request->tgl_akhir;

            $query->whereHas('lelang', function ($q) use ($tglAwal, $tglAkhir) {
                $q->whereBetween('tgl_lelang', [$tglAwal, $tglAkhir]);
            });
        }
        $laporans = $query->get();

        $jumlahLelang = $laporans->unique('id_lelang')->count();

        $grandTotal = $laporans
            ->where('lelang.status', 'ditutup')
            ->whereNotNull('lelang.id_user')
            ->sum('lelang.harga_akhir');

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
