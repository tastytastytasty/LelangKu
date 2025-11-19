@extends('dashboard.layout')
@section('content')
    <h1 class="mb-3"><strong>Selamat datang,</strong> {{ auth()->guard('masyarakat')->user()->nama_lengkap }}</h1>
    <hr class="text-primary">
    <div class=" d-flex mx-2">
        <h1 class="mb-3 text-primary"><strong>Lelang</strong> yang akan datang</h1>
    </div>
    <div class="row mt-2">
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
                                        <td>{{ $lelangi->tgl_lelang }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <hr class="text-primary">
    <div class=" d-flex justify-content-between mx-2">
        <h1 class="mb-3 text-primary"><strong>Lelang</strong> terkini</h1>
        <a href="/lelang" class="btn btn-none text-primary">Selengkapnya<i class="align-middle mx-2" data-feather="arrow-right"></i></a>
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