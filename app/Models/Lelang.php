<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    protected $table = 'lelang';
    protected $primaryKey = 'id_lelang';
    protected $fillable = ['id_barang','tgl_lelang','harga_awal','harga_akhir','id_user','id_petugas','status'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang','id_barang');
    }
    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'id_user','id_user');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas','id_petugas');
    }
}
