<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'ID_PRODUK';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_PRODUK',
        'DESKRIPSI_PRODUK',
        'GAMBAR_PRODUK',
        'STOK_PRODUK',
        'HARGA_PRODUK',
    ];
}
