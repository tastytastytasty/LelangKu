@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Barang</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ isset($barang) ? "Ubah Data Barang" : "Tambah Data Barang" }}</h5>
                </div>
                <div class=" d-flex justify-content-start mx-2 mt-3">
                    <a href="/barang" class="btn btn-secondary"><i class="align-middle mx-2"
                            data-feather="corner-down-left"></i>Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ isset($barang) ? route('barang.update', $barang->id_barang) : route('barang.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($barang))
                            @method('PATCH')
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang"
                                value="{{ isset($barang) ? $barang->nama_barang : '' }}">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar"
                                    value="{{ isset($barang) ? $barang->gambar : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <input type="number" min="0" class="form-control" name="harga_awal"
                                    value="{{ isset($barang) ? $barang->harga_awal : '' }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi"
                                rows="3">{{ isset($barang) ? $barang->deskripsi : '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="align-middle mx-2"
                                data-feather="save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection