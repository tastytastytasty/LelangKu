@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Laporan</h1>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between mx-2 gap-2">
                    <h5 class="card-title mb-0">Laporan Lelang Barang</h5>
                    <h3 class="mb-0 text-primary">Total : <strong>Rp. {{ number_format($grandTotal,0,',','.') }}</strong></h3>
                    </div>
                </div>
                <div class="d-flex justify-content-between mx-2 gap-2">
                <form action="{{ route('laporan.cari') }}" method="GET" class="d-flex">
                    @csrf
                    <div class="d-flex mx-2 gap-2">
                        @if (auth()->guard('petugas')->user()->id_level != '2')
                            <select class="form-control" name="petugas">
                                <option value="">Petugas</option>
                                @foreach ($petugasList as $p)
                                    <option value="{{ $p->id_petugas }}" {{ $selectedPetugas == $p->id_petugas ? 'selected' : '' }}>
                                        {{ $p->nama_petugas }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                        <label class="form-label mt-2">Dari:</label>
                        <input type="date" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
                        <label class="form-label mt-2">Sampai:</label>
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
                        <button type="submit" class="btn btn-success ms-2"><i class="align-middle"
                                data-feather="search"></i></button>
                    </div>
                </form>
                <form action="{{ route('laporan.cetak') }}" target="_blank" method="GET" class="d-flex">
                    @csrf
                    <input type="hidden" name="tgl_awal" value="{{ request('tgl_awal') }}">
                    <input type="hidden" name="tgl_akhir" value="{{ request('tgl_akhir') }}">
                    <input type="hidden" name="petugas" value="{{ $selectedPetugas }}">
                    <button type="submit" class="btn btn-primary ms-2"><i class="align-middle mx-2 "
                            data-feather="printer"></i>Cetak</button>
                </form>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="d-none d-xl-table-cell">ID lelang</th>
                            @if (auth()->guard('petugas')->user()->id_level == '1')
                                <th class="d-none d-xl-table-cell">Nama Petugas</th>
                            @endif
                            <th class="d-none d-xl-table-cell">Tanggal lelang</th>
                            <th class="d-none d-xl-table-cell">Nama Barang</th>
                            <th class="d-none d-xl-table-cell">Gambar</th>
                            <th class="d-none d-xl-table-cell">Harga barang</th>
                            <th class="d-none d-xl-table-cell">Nama Bid</th>
                            <th class="d-none d-xl-table-cell">Harga bid</th>
                            <th class="d-none d-xl-table-cell">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="d-none d-xl-table-cell">{{ $laporan->id_lelang }}</td>
                                @if (auth()->guard('petugas')->user()->id_level == '1')
                                    <td class="d-none d-xl-table-cell">{{ $laporan->petugas->nama_petugas }}</td>
                                @endif
                                <td class="d-none d-xl-table-cell">{{ $laporan->tgl_lelang }}</td>
                                <td class="d-none d-xl-table-cell">{{ $laporan->barang->nama_barang }}</td>
                                <td class="d-none d-xl-table-cell">
                                    @if($laporan->barang->gambar)
                                    <img src="{{ asset('storage/' . $laporan->barang->gambar) }}" width="100" class="mx-auto">
                                    @else
                                    <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell">Rp.
                                    {{number_format($laporan->harga_awal, 0, ',', '.')}}
                                </td>
                                @if ($laporan->status == 'dibuka')
                                    @if ($laporan->id_user == null)
                                    <td></td>
                                    <td></td>
                                    <td class="d-none d-xl-table-cell text-success"><strong>Dibuka</strong></td>
                                    @else
                                    <td></td>
                                    <td></td>
                                    <td class="d-none d-xl-table-cell text-warning"><strong>Proses Lelang</strong></td>
                                    @endif
                                @else
                                    @if ($laporan->id_user == null)
                                    <td></td>
                                    <td></td>
                                    <td class="d-none d-xl-table-cell text-danger"><strong>Ditutup</strong></td>
                                    @else
                                    <td class="d-none d-xl-table-cell">{{ $laporan->masyarakat->nama_lengkap }}</td>
                                    <td class="d-none d-xl-table-cell">Rp.
                                        {{number_format($laporan->harga_akhir, 0, ',', '.')}}
                                    </td>
                                    <td class="d-none d-xl-table-cell text-primary"><strong>Selesai</strong></td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection