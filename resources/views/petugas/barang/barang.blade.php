@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Barang</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title mb-0">Data Barang</h5>
                </div>
                <div class=" d-flex justify-content-between mx-2 gap-2">
                    <a href="{{ route('barang.create') }}" class="btn btn-primary"><i class="align-middle"
                            data-feather="plus"></i>Tambah</a>
                    <form action="{{ route('barang.cari') }}" method="GET" class="d-flex">
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
                            <th class="d-none d-xl-table-cell">Tanggal Pengiriman</th>
                            <th>Harga</th>
                            <th class="d-none d-md-table-cell">Deskripsi</th>
                            <th class="d-none d-md-table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="d-none d-xl-table-cell">{{ $barang->nama_barang }}</td>
                                <td class="d-none d-xl-table-cell">
                                    @if($barang->gambar)
                                        <img src="{{ asset('storage/' . $barang->gambar) }}" width="100" class="mx-auto">
                                    @else
                                        <i class="align-middle text-danger" data-feather=" x-circle"></i>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">{{$barang->tgl}}</td>
                                <td class="d-none d-md-table-cell">Rp. {{ number_format($barang->harga_awal, 0, ',', '.') }}</td>
                                <td class="d-none d-md-table-cell">{{$barang->deskripsi}}</td>
                                <td class="d-none d-md-table-cell">
                                    <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-sm btn-warning"><i
                                            class="align-middle mx-2" data-feather="edit-3"></i>Edit</a>
                                    <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah anda yakin?')"><i class="align-middle  mx-2"
                                                data-feather="trash"></i>Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection