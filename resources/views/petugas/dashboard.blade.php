@extends('dashboard.layout')
@section('content')
    <h1 class="mb-3"><strong>Selamat datang,</strong> {{ auth()->guard('petugas')->user()->nama_petugas }}</h1>
    <hr class="text-primary">
    @php
        use App\Models\Lelang;
        $user = auth()->guard('petugas')->user();
        if ($user->id_level == '2') {
            $buka = Lelang::where('status', 'dibuka')->where('id_user', null)->where('id_petugas', $user->id_petugas)->count();
            $proses = Lelang::where('status', 'dibuka')->where('id_user', '!=', null)->where('id_petugas', $user->id_petugas)->count();
            $selesai = Lelang::where('status', 'ditutup')->where('id_user', '!=', null)->where('id_petugas', $user->id_petugas)->count();
            $pendapatan = Lelang::where('status', 'ditutup')->where('id_user', '!=', null)->where('id_petugas', $user->id_petugas)->sum('harga_akhir');
            $harga_awal = Lelang::where('status', 'ditutup')->where('id_user', '!=', null)->where('id_petugas', $user->id_petugas)->sum('harga_awal');
            $laba = $pendapatan - $harga_awal;
        } else {
            $buka = Lelang::where('status', 'dibuka')->where('id_user', null)->count();
            $proses = Lelang::where('status', 'dibuka')->where('id_user', '!=', null)->count();
            $selesai = Lelang::where('status', 'ditutup')->where('id_user', '!=', null)->count();
            $pendapatan = Lelang::where('status', 'ditutup')->where('id_user', '!=', null)->sum('harga_akhir');
            $harga_awal = Lelang::where('status', 'ditutup')->where('id_user', '!=', null)->sum('harga_awal');
            $laba = $pendapatan - $harga_awal;
        }
    @endphp
    <div class=" d-flex mx-2">
        <h1 class="mb-3 text-primary"><strong>Informasi</strong> umum</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h4 class="mb-0 text-primary"><strong>Transaksi Lelang</strong></h4>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td><strong>Dibuka</strong></td>
                                    <td class="text-end">{{ $buka }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Proses Lelang</strong></td>
                                    <td class="text-end">{{ $proses }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Selesai</strong></td>
                                    <td class="text-end">{{ $selesai }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h4 class="mb-0 text-primary"><strong>Total Laba</strong></h4>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td><strong>Pendapatan</strong></td>
                                    <td class="text-end">Rp. {{number_format($pendapatan,0,',','.')}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Harga Barang</strong></td>
                                    <td class="text-end">Rp. {{number_format($harga_awal,0,',','.')}}</td>
                                </tr>
                                <tr>
                                    @if ($laba > 0)
                                    <td><strong>Laba</strong></td>
                                    <td class="text-end text-success"><strong>Rp. {{number_format($laba,0,',','.')}}</strong></td>
                                    @else
                                    <td><strong>Laba</strong></td>
                                    <td class="text-end text-danger"><strong>Rp. {{number_format($laba,0,',','.')}}</strong></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
        @if (auth()->guard('petugas')->user()->id_level == '2')
            <div class=" d-flex justify-content-between mx-2">
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
                                    <div class="mb-2 d-flex align-items-center">
                                        @if($lelang->barang->gambar)
                                            <img src="{{ asset('storage/' . $lelang->barang->gambar) }}"
                                                style="width: 100%; height: 200px; object-fit: cover; object-position: center;">
                                        @else
                                            <span>Gambar tidak tersedia</span>
                                        @endif
                                    </div>
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
                                                    <td><strong>{{$lelang->masyarakat->nama_lengkap}}</strong></td>
                                                    <td></td>
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
        @else

        @endif
@endsection