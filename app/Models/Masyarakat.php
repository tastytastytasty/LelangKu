<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;
    protected $table = 'masyarakat';
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama_lengkap','username','password','alamat','telp','gambar','status'];
    protected $hidden = ['password'];
}

