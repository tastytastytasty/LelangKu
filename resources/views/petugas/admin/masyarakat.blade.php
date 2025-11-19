@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Masyarakat</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <h5 class="card-title mb-0">Data Masyarakat</h5>
                </div>
                <div class=" d-flex justify-content-between mx-2 gap-2">
                    <a href="{{ route('masyarakat.create') }}" class="btn btn-primary"><i class="align-middle"
                            data-feather="plus"></i>Tambah</a>
                    <form action="{{ route('masyarakat.cari') }}" method="GET" class="d-flex">
                        @csrf
                        <input type="text" name="cari" class="form-control" placeholder="Cari user...">
                        <button type="submit" class="btn btn-success ms-2"><i class="align-middle"
                                data-feather="search"></i></button>
                    </form>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="d-none d-xl-table-cell">Nama Lengkap</th>
                            <th class="d-none d-xl-table-cell">NIK</th>
                            <th class="d-none d-xl-table-cell">No.Telpon</th>
                            <th class="d-none d-xl-table-cell">Alamat</th>
                            <th class="d-none d-md-table-cell">Gambar</th>
                            <th class="d-none d-md-table-cell">Status</th>
                            <th class="d-none d-md-table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masyarakats as $masyarakat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="d-none d-xl-table-cell">{{ $masyarakat->nama_lengkap }}</td>
                                <td class="d-none d-xl-table-cell">{{ $masyarakat->username }}</td>
                                <td><span>{{$masyarakat->telp}}</span></td>
                                <td class="d-none d-md-table-cell">{{$masyarakat->alamat}}</td>
                                <td class="d-none d-xl-table-cell">
                                    @if($masyarakat->gambar)
                                        <img src="{{ asset('storage/' . $masyarakat->gambar) }}" width="100" class="mx-auto">
                                    @else
                                        <span>------</span>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">
                                    @if ($masyarakat->status == 'aktif')
                                        <span class="text-success">{{$masyarakat->status}}</span>
                                    @else
                                        <span class="text-danger">{{$masyarakat->status}}</span>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="{{ route('masyarakat.edit', $masyarakat->id_user) }}"
                                        class="btn btn-sm btn-warning"><i class="align-middle mx-2"
                                            data-feather="edit-3"></i>Edit</a>
                                    <form action="{{ route('masyarakat.destroy', $masyarakat->id_user) }}" method="POST"
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