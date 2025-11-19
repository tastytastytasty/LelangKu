@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Masyarakat</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ isset($masyarakat) ? "Ubah Data Masyarakat" : "Tambah Data Masyarakat" }}
                    </h5>
                </div>
                <div class=" d-flex justify-content-start mx-2 mt-3">
                    <a href="/masyarakat" class="btn btn-secondary"><i class="align-middle mx-2"
                            data-feather="corner-down-left"></i>Kembali</a>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($masyarakat) ? route('masyarakat.update', $masyarakat->id_user) : route('masyarakat.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($masyarakat))
                            @method('PATCH')
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap"
                                    value="{{ isset($masyarakat) ? $masyarakat->nama_lengkap : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No.Telpon</label>
                                <input type="text" class="form-control" name="telp"
                                    value="{{ isset($masyarakat) ? $masyarakat->telp : '' }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" name="username" minlength="16" maxlength="16"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    value="{{ isset($masyarakat) ? $masyarakat->username : '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" minlength="6"
                                    placeholder="{{ isset($masyarakat) ? 'Reset password?' : '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar"
                                    value="{{ isset($masyarakat) ? $masyarakat->gambar : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option value="aktif" {{ isset($masyarakat) && $masyarakat->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="blokir" {{ isset($masyarakat) && $masyarakat->status == 'blokir' ? 'selected' : '' }}>Blokir</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat"
                                rows="3" required>{{ isset($masyarakat) ? $masyarakat->alamat : '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="align-middle mx-2"
                                data-feather="save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection