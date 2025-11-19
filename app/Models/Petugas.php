<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $fillable = ['nama_petugas', 'username', 'password', 'id_level','gambar'];
    protected $hidden = ['password'];
    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }
}
