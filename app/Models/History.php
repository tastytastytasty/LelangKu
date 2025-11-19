<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history_lelang';
    protected $primaryKey = 'id_history';
    protected $fillable = ['id_lelang','id_barang','id_user','penawaran_harga'];    
    public function lelang()
    {
        return $this->belongsTo(Lelang::class, 'id_lelang','id_lelang');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang','id_barang');
    }
    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'id_user','id_user');
    }
}
