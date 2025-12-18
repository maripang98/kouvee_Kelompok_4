<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Authenticatable
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

    protected $hidden = ['PASSWORD'];

    // ✅ USERNAME LOGIN
    public function getAuthIdentifierName()
    {
        return 'USERNAME';
    }

    // ✅ PASSWORD COLUMN NAME
    public function getAuthPasswordName()
    {
        return 'PASSWORD';
    }

    // OPTIONAL (aman)
    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }

    // ROLE HELPER
    public function isKasir()
    {
        return $this->ID_JABATAN == 1;
    }

    public function isCs()
    {
        return $this->ID_JABATAN == 2;
    }

    public function isOwner()
    {
        return $this->ID_JABATAN == 3;
    }
}

