<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiLayanan extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi_penjualan_layanan';
    protected $primaryKey = 'ID_TRANSAKSI_LAYANAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_PEGAWAI',
        'PEG_ID_PEGAWAI',
        'KODE_TRANSAKSI_PENJUALAN_LAYANAN',
        'TGL_TRANSAKSI_PENJUALAN_LAYANAN',
        'SUB_TOTAL_PENJUALAN_LAYANAN',
        'DISKON_PENJUALAN_LAYANAN',
        'TOTAL_HARGA_PENJUALAN_LAYANAN',
        'STATUS_PEMBAYARAN_LAYANAN'
    ];

    // ✅ Relasi ke detail transaksi
    public function details()
    {
        return $this->hasMany(DetailTransaksiLayanan::class, 'ID_TRANSAKSI_LAYANAN', 'ID_TRANSAKSI_LAYANAN');
    }
}

