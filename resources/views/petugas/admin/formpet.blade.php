@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Petugas</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ isset($petugas) ? "Ubah Data Petugas" : "Tambah Data Petugas" }}</h5>
                </div>
                <div class=" d-flex justify-content-start mx-2 mt-3">
                    <a href="/petugas" class="btn btn-secondary"><i class="align-middle mx-2"
                            data-feather="corner-down-left"></i>Kembali</a>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($petugas) ? route('petugas.update', $petugas->id_petugas) : route('petugas.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($petugas))
                            @method('PATCH')
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Petugas</label>
                                <input type="text" class="form-control" name="nama_petugas"
                                    value="{{ isset($petugas) ? $petugas->nama_petugas : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Level</label>
                                <select class="form-control" name="level">
                                    <option value="">-- Pilih Level --</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id_level }}"
                                            {{ isset($petugas) && $petugas->id_level == $level->id_level ? 'selected' : '' }}>
                                            {{ $level->level }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ isset($petugas) ? $petugas->username : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" name="password" minlength="6" placeholder="{{ isset($petugas) ? 'Kosongkan jika tidak diubah' : '' }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="gambar"
                                value="{{ isset($petugas) ? $petugas->gambar : '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="align-middle mx-2"
                                data-feather="save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection