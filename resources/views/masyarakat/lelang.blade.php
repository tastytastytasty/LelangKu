@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Lelang</h1>
    <div class="row">
        @if (auth()->guard('petugas')->user())
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Data Lelang</h5>
                    </div>
                    <div class=" d-flex justify-content-between mx-2 gap-2">
                        <a href="{{ route('lelang.create') }}" class="btn btn-primary"><i class="align-middle"
                                data-feather="plus"></i>Tambah</a>
                        <form action="{{ route('lelang.cari') }}" method="GET" class="d-flex">
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
                                <th class="d-none d-xl-table-cell">Nama Barang</th>
                                <th class="d-none d-xl-table-cell">Gambar</th>
                                <th class="d-none d-xl-table-cell">Tanggal Lelang</th>
                                <th class="d-none d-xl-table-cell">Harga awal</th>
                                <th class="d-none d-md-table-cell">Harga akhir</th>
                                <th class="d-none d-md-table-cell">Pemesan</th>
                                <th class="d-none d-md-table-cell">Status</th>
                                <th class="d-none d-md-table-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lelangs as $lelang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $lelang->barang->nama_barang }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        @if($lelang->barang->gambar)
                                            <img src="{{ asset('storage/' . $lelang->barang->gambar) }}" width="100" class="mx-auto">
                                        @else
                                            <span>Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">{{$lelang->tgl_lelang}}</td>
                                    <td class="d-none d-md-table-cell">Rp. {{ number_format($lelang->harga_awal, 0, ',', '.') }}
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        @if($lelang->harga_awal == $lelang->harga_akhir)
                                            <span>Belum ada yang bet</span>
                                        @else
                                            Rp. {{ number_format($lelang->harga_akhir, 0, ',', '.') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($lelang->id_user))
                                            <span>Belum ada yang bet</span>
                                        @else
                                            {{$lelang->masyarakat->nama_lengkap}}
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        @if ($lelang->status == 'dibuka')
                                            @if ($lelang->id_user != null)
                                                <span class="text-warning">Proses Lelang</span>
                                            @else
                                                <span class="text-success">Dibuka</span>
                                            @endif
                                        @else
                                            @if ($lelang->id_user != null)
                                                <span class="text-primary">Selesai</span>
                                            @else
                                                <span class="text-danger">Ditutup</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a href="{{ route('lelang.edit', $lelang->id_lelang) }}" class="btn btn-sm btn-warning"><i
                                                class="align-middle mx-2" data-feather="edit-3"></i>Edit</a>
                                        @if ($lelang->id_user == null || $lelang->id_user != null && $lelang->status == 'dibuka')
                                            <form action="{{ route('lelang.destroy', $lelang->id_lelang) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah anda yakin?')"><i class="align-middle  mx-2"
                                                        data-feather="trash"></i>Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="card" style="background: transparent; border: none; box-shadow: none;">
                    <div class=" d-flex justify-content-end mx-2 gap-2">
                        <form action="{{ route('lelang.cari') }}" method="GET" class="d-flex">
                            @csrf
                            <input type="text" name="cari" class="form-control" placeholder="Cari barang...">
                            <button type="submit" class="btn btn-success ms-2"><i class="align-middle"
                                    data-feather="search"></i></button>
                        </form>
                    </div>
                    <div class="row mt-3">
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
                                                                <td class="text-success">
                                                                    <strong>{{$lelang->masyarakat->nama_lengkap}}</strong></td>
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
                </div>
            </div>
        @endif
    </div>
@endsection