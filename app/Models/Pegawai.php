<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'ID_PEGAWAI';
    public $timestamps = false;

    protected $fillable = [
        'ID_JABATAN',
        'NAMA_PEGAWAI',
        'ALAMAT_PEGAWAI',
        'TGL_LAHIR_PEGAWAI',
        'NOMOR_TELEPON_PEGAWAI',
        'USERNAME',
        'PASSWORD',
    ];
}
