<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        if (auth()->guard('masyarakat')->check()) {
            $user = auth()->guard('masyarakat')->user();
            $histories = History::with(['lelang', 'masyarakat', 'barang'])
                ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
                ->where('id_user', $user->id_user)
                ->groupBy('id_lelang', 'id_barang', 'id_user')
                ->get();
        } else {
            $user = auth()->guard('petugas')->user();
            $histories = History::with(['lelang', 'masyarakat', 'barang'])
                ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
                ->whereHas('lelang', function ($query) use ($user) {
                    $query->where('id_petugas', $user->id_petugas);
                })->whereHas('lelang', function ($query) {
                    $query->where('status', 'ditutup')->whereNot('id_user', null);
                })
                ->groupBy('id_lelang', 'id_barang', 'id_user')
                ->get();
        }
        foreach ($histories as $h) {
            $highest = History::where('id_lelang', $h->id_lelang)
                ->orderBy('penawaran_harga', 'DESC')
                ->first();

            $h->is_menang = $highest && $highest->id_user == $h->id_user;
        }
        return view('masyarakat.history', compact('histories'));
    }
    public function cari(Request $request)
    {
        $cari = $request->input('cari');
        if (auth()->guard('masyarakat')->check()) {
            $user = auth()->guard('masyarakat')->user();
            $histories = History::with(['lelang', 'masyarakat', 'barang'])
                ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
                ->whereHas('barang', function ($query) use ($cari) {
                    $query->where('nama_barang', 'like', '%' . $cari . '%');
                })->where('id_user', $user->id_user)
                ->groupBy('id_lelang', 'id_barang', 'id_user')
                ->get();
        } else {
            $user = auth()->guard('petugas')->user();
            $histories = History::with(['lelang', 'masyarakat', 'barang'])
                ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
                ->whereHas('barang', function ($query) use ($cari) {
                    $query->where('nama_barang', 'like', '%' . $cari . '%');
                })->whereHas('lelang', function ($query) use ($user) {
                    $query->where('id_petugas', $user->id_petugas);
                })->whereHas('lelang', function ($query) {
                    $query->where('status', 'ditutup')->whereNot('id_user', null);
                })
                ->groupBy('id_lelang', 'id_barang', 'id_user')
                ->get();
        }
        foreach ($histories as $h) {
            $highest = History::where('id_lelang', $h->id_lelang)
                ->orderBy('penawaran_harga', 'DESC')
                ->first();

            $h->is_menang = $highest && $highest->id_user == $h->id_user;
        }
        return view('masyarakat.history', compact('histories'));
    }
    public function status(Request $request)
    {
        $filter = $request->input('filter');
            $user = auth()->guard('masyarakat')->user();
            $histories = History::with(['lelang', 'masyarakat', 'barang'])
                ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
                ->where('id_user', $user->id_user)
                ->groupBy('id_lelang', 'id_barang', 'id_user')
                ->get();
        foreach ($histories as $h) {
            $highest = History::where('id_lelang', $h->id_lelang)
                ->orderBy('penawaran_harga', 'DESC')
                ->first();
            if ($h->lelang->status == 'ditutup') {
                $h->is_menang = $highest && $highest->id_user == $h->id_user;
                $h->is_kalah = $highest && $highest->id_user != $h->id_user;
            }
            $h->is_proses = $h->lelang->status == 'dibuka';
        }
        if ($filter == 'menang') {
            $histories = $histories->filter(fn($h) => $h->is_menang);
        } elseif ($filter == 'kalah') {
            $histories = $histories->filter(fn($h) => $h->is_kalah);
        } elseif ($filter == 'proses') {
            $histories = $histories->filter(fn($h) => $h->is_proses);
        }

        return view('masyarakat.history', compact('histories'));
    }

    public function detail(string $id)
    {
        $history = History::findOrFail($id);
        $id_lelang = $history->id_lelang;
        $id_barang = $history->id_barang;
        $id_user = $history->id_user;
        $details = History::where('id_lelang', $id_lelang)
            ->where('id_barang', $id_barang)
            ->where('id_user', $id_user)->orderBy('penawaran_harga', 'DESC')->get();
        $first = $details->first();
        return view('masyarakat.detail', compact('details', 'history', 'first'));
    }
    public function tanggal(Request $request)
    {
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');
        $user = auth()->guard('petugas')->user();
        $histories = History::with(['lelang', 'masyarakat', 'barang'])
            ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
            ->whereHas('lelang', function ($query) use ($user) {
                $query->where('id_petugas', $user->id_petugas);
            })
            ->whereHas('lelang', function ($query) {
                $query->where('status', 'ditutup')->whereNotNull('id_user');
            })
            ->when($tanggal_awal && $tanggal_akhir, function ($query) use ($tanggal_awal, $tanggal_akhir) {
                $query->whereHas('lelang', function ($q) use ($tanggal_awal, $tanggal_akhir) {
                    $q->whereBetween('tgl_lelang', [$tanggal_awal, $tanggal_akhir]);
                });
            })
            ->groupBy('id_lelang', 'id_barang', 'id_user')
            ->get();
        return view('masyarakat.history', compact('histories', 'tanggal_awal', 'tanggal_akhir'));
    }

}
