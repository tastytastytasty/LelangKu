@extends('dashboard.layout')
@section('content')
    <h1 class="mb-3"><strong>Selamat datang,</strong> {{ auth()->guard('masyarakat')->user()->nama_lengkap }}</h1>
    <hr class="text-primary">
    @php
        use App\Models\History;
        $user = auth()->guard('masyarakat')->user();
        $histories = History::with(['lelang', 'masyarakat', 'barang'])
            ->selectRaw('MAX(id_history) as id_history, id_lelang, id_barang, id_user')
            ->where('id_user', $user->id_user)
            ->groupBy('id_lelang', 'id_barang', 'id_user')
            ->orderBy('created_at', 'DESC')
            ->limit(3)->get();
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
    @endphp
    <div class="d-flex justify-content-between mx-2">
        <h1 class="mb-3 text-primary"><strong>History</strong> lelang terkini</h1>
        <a href="/history" class="btn btn-none text-primary">Selengkapnya<i class="align-middle mx-2"
                data-feather="arrow-right"></i></a>
    </div>
    <table class="table table-hover my-0">
        <thead>
            <tr>
                <th>No</th>
                <th class="d-none d-xl-table-cell">Tanggal lelang</th>
                <th class="d-none d-xl-table-cell">Nama Barang</th>
                <th class="d-none d-xl-table-cell">Gambar</th>
                <th class="d-none d-xl-table-cell">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $histori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="d-none d-xl-table-cell">{{ $histori->lelang->tgl_lelang }}</td>
                    <td class="d-none d-xl-table-cell">{{ $histori->barang->nama_barang }}</td>
                    <td class="d-none d-xl-table-cell">
                        @if($histori->barang->gambar)
                            <img src="{{ asset('storage/' . $histori->barang->gambar) }}" width="100" class="mx-auto">
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>
                        @if ($histori->lelang->status == 'dibuka')
                            <span class="text-warning">Proses Lelang</span>
                        @else
                            @if ($histori->is_menang)
                                <span class="text-success">Menang</span>
                            @else
                                <span class="text-danger">Kalah</span>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr class="text-primary">
    <div class=" d-flex mx-2">
        <h1 class="mb-3 text-primary"><strong>Lelang</strong> yang akan datang</h1>
    </div>
    <div class="row mt-2">
        @if ($lelangis->count() > 0)
            @foreach ($lelangis as $lelangi)
                <div class="col-12 col-md-6 col-xxl-3 d-flex mb-3">
                    <div class="card w-100">
                        <div class="card-body d-flex">
                            <div class="align-self-center h-100 w-100">
                                <div class="mb-2 d-flex align-items-center">
                                    @if($lelangi->barang->gambar)
                                        <img src="{{ asset('storage/' . $lelangi->barang->gambar) }}"
                                            style="width: 100%; height: 200px; object-fit: cover; object-position: center;">
                                    @else
                                        <span>Gambar tidak tersedia</span>
                                    @endif
                                </div>
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h4><strong>{{$lelangi->barang->nama_barang}}</strong></h4>
                                            </td>
                                            <td class="text-end"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Pembuka</td>
                                            <td class="text-end text-danger"><strong>Rp.
                                                    {{ number_format($lelangi->harga_awal, 0, ',', '.') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal lelang</td>
                                            <td class="text-end">{{ $lelangi->tgl_lelang }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3 class="text-center mt-4 mb-4">Tidak ada</h3>
        @endif
    </div>
    <hr class="text-primary">
    <div class="d-flex justify-content-between mx-2">
        <h1 class="mb-3 text-primary"><strong>Lelang</strong> terkini</h1>
        <a href="/lelang" class="btn btn-none text-primary">Selengkapnya<i class="align-middle mx-2"
                data-feather="arrow-right"></i></a>
    </div>
    <div class="row mt-2">
        @foreach ($lelangs as $lelang)
            <div class="col-12 col-md-6 col-xxl-3 d-flex mb-3">
                <div class="card w-100">
                    <div class="card-body d-flex">
                        <div class="align-self-center h-100 w-100">
                            <a href="{{ route('lelang.edit', $lelang->id_lelang) }}" class="btn">
                                <div class="mb-2 d-flex align-items-center">
                                    @if($lelang->barang->gambar)
                                        <img src="{{ asset('storage/' . $lelang->barang->gambar) }}"
                                            style="width: 100%; height: 200px; object-fit: cover; object-position: center;">
                                    @else
                                        <span>Gambar tidak tersedia</span>
                                    @endif
                                </div>
                            </a>
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h4><strong>{{$lelang->barang->nama_barang}}</strong></h4>
                                        </td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Pembuka</td>
                                        <td class="text-end text-danger"><strong>Rp.
                                                {{ number_format($lelang->harga_awal, 0, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Bet tertinggi</td>
                                        @if ($lelang->harga_awal == $lelang->harga_akhir)
                                            <td class="text-end"><strong>Belum ada yang bet</strong></td>
                                        @else
                                            <td class="text-end">Rp.
                                                {{ number_format($lelang->harga_akhir, 0, ',', '.') }}
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        @if ($lelang->id_user != null)
                                            @if ($lelang->id_user == auth()->guard('masyarakat')->user()->id_user)
                                                <td class="text-success"><strong>{{$lelang->masyarakat->nama_lengkap}}</strong></td>
                                                <td></td>
                                            @else
                                                <td><strong>{{$lelang->masyarakat->nama_lengkap}}</strong></td>
                                                <td></td>
                                            @endif
                                        @else
                                            <td><strong>Belum ada yang bet</strong></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection