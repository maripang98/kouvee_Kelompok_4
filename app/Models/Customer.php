<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'ID_CUSTOMER';
    public $timestamps = false;

    protected $fillable = [
        'ID_PEGAWAI',
        'NAMA_CUSTOMER',
        'ALAMAT_CUSTOMER',
        'TGL_LAHIR_CUSTOMER',
        'NOMOR_TELEPON_CUSTOMER',
    ];

    public function hewan()
{
    return $this->hasMany(Hewan::class, 'ID_CUSTOMER', 'ID_CUSTOMER');
}
}
