@extends('dashboard.layout')
@section('content')
    <h1 class="h3 d-inline align-middle">Profile</h1>
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Photo Profile</h5>
                </div>
                @if (auth()->guard('masyarakat')->user())
                    <div class="card-body text-center">
                        <img src="{{asset('storage/' . auth()->guard('masyarakat')->user()->gambar)}}" alt="orang"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        <h5 class="card-title mb-0">{{auth()->guard('masyarakat')->user()->nama_lengkap}}</h5>
                        <div class="text-muted mb-2">Pengguna</div>
                    </div>
                @else
                    <div class="card-body text-center">
                        <img src="{{asset('storage/' . auth()->guard('petugas')->user()->gambar)}}" alt="orang"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                        <h5 class="card-title mb-0">{{auth()->guard('petugas')->user()->nama_petugas}}</h5>
                        @if (auth()->guard('petugas')->user()->id_level == '1')
                            <div class="text-muted mb-2">Admin</div>
                        @else
                            <div class="text-muted mb-2">Petugas</div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title mb-0">Uba data diri</h5>
                </div>
                <div class="card-body h-100 w-80">
                    @if (auth()->guard('masyarakat')->user())
                        <form action="{{ route('profile.updmas') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" value="{{$userm->nama_lengkap}}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No.Telpon</label>
                                <input type="text" class="form-control" name="telp" value="{{$userm->telp}}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIK</label>
                                <input class="form-control form-control-lg" type="text" name="username"
                                    placeholder="Masukkan NIK Anda (16 Digit)" minlength="16" maxlength="16" inputmode="numeric"
                                    pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g,'')" required
                                    value="{{$userm->username}}" />
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" minlength="6"
                                        placeholder="Ganti password">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" minlength="6"
                                        placeholder="Konfirmasi password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" value="{{$userm->gambar}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" required>{{$userm->alamat}}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="align-middle mx-2"
                                    data-feather="save"></i>Simpan</button>
                        </form>
                    @else
                        <form action="{{ route('profile.updpet') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_petugas" value="{{$userp->nama_petugas}}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{$userp->username}}">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" minlength="6"
                                        placeholder="Ganti password">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" minlength="6"
                                        placeholder="Konfirmasi password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" value="{{$userp->gambar}}">
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="align-middle mx-2"
                                    data-feather="save"></i>Simpan</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
@endsection