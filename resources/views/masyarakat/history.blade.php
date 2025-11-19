@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Histori</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title mb-0">Histori Lelang Barang</h5>
                </div>
                <div class=" d-flex justify-content-between mx-2 gap-2">
                    @if (auth()->guard('masyarakat')->user())
                        <form action="{{ route('history.status') }}" method="GET" class="d-flex">
                            @csrf
                            <select class="form-control" name="filter">
                                <option value="">Semua Status</option>
                                <option value="menang">Menang</option>
                                <option value="proses">Proses Lelang</option>  
                                <option value="kalah">Kalah</option>
                            </select>
                            <button type="submit" class="btn btn-success ms-2"><i class="align-middle"
                                    data-feather="search"></i></button>
                        </form>
                    @else
                        <form action="{{ route('history.tanggal') }}" method="GET" class="d-flex align-items-center gap-2">
                            @csrf
                            <label class="form-label">Dari:</label>
                            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">

                            <label class="form-label">Sampai:</label>
                            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                            <button type="submit" class="btn btn-success ms-2"><i class="align-middle"
                                    data-feather="search"></i></button>
                        </form>
                    @endif
                    <form action="{{ route('history.cari') }}" method="GET" class="d-flex">
                        @csrf
                        <input type="text" name="cari" class="form-control" placeholder="Cari barang...">
                        <button type="submit" class="btn btn-success ms-2"><i class="align-middle"
                                data-feather="search"></i></button>
                    </form>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            @if (auth()->guard('petugas')->user())
                                <th class="d-none d-xl-table-cell">Tanggal lelang</th>
                                <th class="d-none d-xl-table-cell">Nama Pemesan</th>
                            @endif
                            <th class="d-none d-xl-table-cell">Nama Barang</th>
                            <th class="d-none d-xl-table-cell">Gambar</th>
                            <th class="d-none d-xl-table-cell">Penawaran harga</th>
                            @if (auth()->guard('masyarakat')->user())
                                <th class="d-none d-xl-table-cell">Keterangan</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $histori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if (auth()->guard('petugas')->user())
                                    <td class="d-none d-xl-table-cell">{{ $histori->lelang->tgl_lelang }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $histori->masyarakat->nama_lengkap }}</td>
                                @endif
                                <td class="d-none d-xl-table-cell">{{ $histori->barang->nama_barang }}</td>
                                <td class="d-none d-xl-table-cell">
                                    @if($histori->barang->gambar)
                                        <img src="{{ asset('storage/' . $histori->barang->gambar) }}" width="100" class="mx-auto">
                                    @else
                                        <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <!-- <td class="d-none d-md-table-cell">Rp.
                                                                                                                    {{ number_format($histori->penawaran_harga, 0, ',', '.') }}</td> -->
                                <td class="d-none d-md-table-cell">
                                    <a href="{{ route('history.detail', $histori->id_history) }}" class="btn btn-success"><i
                                            class="align-middle" data-feather="file-text"></i>Detail</a>
                                </td>
                                @if (auth()->guard('masyarakat')->user())
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
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection