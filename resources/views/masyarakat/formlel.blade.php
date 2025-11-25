@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Lelang</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (auth()->guard('petugas')->user())
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ isset($lelang) ? "Ubah Data Lelang" : "Tambah Data Lelang" }}</h5>
                    </div>
                    <div class=" d-flex justify-content-start mx-2 mt-3">
                        <a href="/lelang" class="btn btn-secondary"><i class="align-middle mx-2"
                                data-feather="corner-down-left"></i>Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($lelang) ? route('lelang.update', $lelang->id_lelang) : route('lelang.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($lelang))
                                @method('PATCH')
                            @endif
                            @if(isset($lelang))
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id_barang" value="{{ $lelang->id_barang }}">
                                        <label class="form-label">Status</label>

                                        @if ($lelang->tgl_lelang > date('Y-m-d'))
                                            <input type="hidden" name="status" value="{{ $lelang->status }}">
                                            <select class="form-control mb-3" disabled>
                                        @else
                                            <select class="form-control mb-3" name="status">
                                        @endif
                                                <option value="dibuka" {{ $lelang->status == 'dibuka' ? 'selected' : '' }}>Dibuka
                                                </option>
                                                <option value="ditutup" {{ $lelang->status == 'ditutup' ? 'selected' : '' }}>Ditutup
                                                </option>
                                            </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="tgl_lelang"
                                            value="{{ isset($lelang) ? $lelang->tgl_lelang : '' }}" min="{{isset($lelang) ? $lelang->tgl_lelang : date('Y-m-d')}}">
                                    </div>
                                </div>
                            @else
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Barang</label>
                                        <select class="form-control select2" name="id_barang">
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach($barangs as $barang)
                                                <option value="{{ $barang->id_barang }}">
                                                    {{ $barang->nama_barang }} -- Rp.{{ number_format($barang->harga_awal,0,',','.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="tgl_lelang" value="{{date('Y-m-d')}}" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary"><i class="align-middle mx-2"
                                    data-feather="save"></i>Simpan</button>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        <h5 class="card-title mb-0">Bet barang lelang ini</h5>
                    </div>
                    <div class=" d-flex justify-content-start mx-2 mt-3">
                        <a href="/lelang" class="btn btn-primary"><i class="align-middle mx-2"
                                data-feather="corner-down-left"></i>Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="align-self-center w-100">
                                    <div class="chart m-0">
                                        @if($lelang->barang->gambar)
                                            <img src="{{ asset('storage/' . $lelang->barang->gambar) }}"
                                                class="w-100 object-fit-cover mx-auto d-block">
                                        @else
                                            <span>Gambar tidak tersedia</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form action="{{route('lelang.update', $lelang->id_lelang)}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <h1 class="mb-3 text-primary"><strong>{{ $lelang->barang->nama_barang }}</strong></h1>
                                    <hr class="text-primary">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Harga awal</label><br>
                                            <label class="form-label">Harga bet terbesar</label>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="mb-3 text-danger"><strong>Rp.
                                                    {{ number_format($lelang->harga_awal, 0, ',', '.') }}</strong></h4>
                                            <h4 class="mb-3 text-primary">
                                                @if($lelang->harga_awal == $lelang->harga_akhir)
                                                    <span>Belum ada yang bet</span>
                                                @else
                                                        <strong>Rp.{{ number_format($lelang->harga_akhir, 0, ',', '.') }}</strong>
                                                    </h4>
                                                @endif
                                        </div>
                                    </div>
                                    <label class="form-label">Deskripsi</label><br>
                                    <textarea class="form-control" name="deskripsi" rows="5"
                                        readonly>{{ $lelang->barang->deskripsi }}</textarea><br>
                                    <input type="hidden" name="id_barang" value="{{ $lelang->id_barang }}">
                                    <input type="hidden" name="id_user"
                                        value="{{ auth()->guard('masyarakat')->user()->id_user }}">
                                    <input type="hidden" name="status" value="{{ $lelang->status }}">
                                    <input type="hidden" name="tgl_lelang" value="{{ $lelang->tgl_lelang }}">
                                    @if ($lelang->harga_akhir != $lelang->harga_awal)
                                        <label class="form-label">Tawar Harga</label>
                                        <input type="number" class="form-control mb-3" name="harga_akhir"
                                            min="{{ $lelang->harga_akhir + 1 }}"
                                            placeholder="Rp. {{ number_format($lelang->harga_akhir, 0, ',', '.') }}">
                                    @else
                                        <label class="form-label">Tawar Harga</label>
                                        <input type="number" class="form-control mb-3" name="harga_akhir"
                                            min="{{ $lelang->harga_awal + 1 }}"
                                            placeholder="Rp. {{ number_format($lelang->harga_awal, 0, ',', '.') }}">
                                    @endif
                                    <button type="submit" class="btn btn-success"><i class="align-middle mx-2"
                                            data-feather="shopping-cart"></i>Bet</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection