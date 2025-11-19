@extends('dashboard.layout')
@section('content')
    <h1 class="h3 mb-3">Histori</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail</h5>
                </div>
                <div class=" d-flex justify-content-start mx-2 mt-3">
                    <a href="/history" class="btn btn-primary"><i class="align-middle mx-2"
                            data-feather="corner-down-left"></i>Kembali</a>
                </div>
<div class="card-body">
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="align-self-center w-100">
                <div class="chart m-0">
                    @if($first->barang->gambar)
                        <img src="{{ asset('storage/' . $first->barang->gambar) }}"
                            class="w-100 object-fit-cover mx-auto d-block">
                    @else
                        <span>Gambar tidak tersedia</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h1 class="mb-3 text-primary">
                <strong>{{ $first->barang->nama_barang }}</strong>
            </h1>
            <hr class="text-primary">

            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="d-none d-xl-table-cell">Penawaran harga</th>
                        <th class="d-none d-xl-table-cell">Menang / Kalah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="d-none d-md-table-cell">
                                Rp. {{ number_format($detail->penawaran_harga, 0, ',', '.') }}
                            </td>
                            <td>
                            @if ($detail->lelang->status == 'dibuka')
                                <span class="text-warning">Proses Lelang</span>
                            @else
                                @if ($detail->penawaran_harga == $detail->lelang->harga_akhir)
                                    <span class="text-success">Menang</span>
                                @else
                                    <span class="text-danger">Kalah</span>
                                @endif
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

            </div>
        </div>
    </div>
@endsection