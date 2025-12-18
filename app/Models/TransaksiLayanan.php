<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiLayanan extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi_penjualan_layanan';
    protected $primaryKey = 'ID_TRANSAKSI_LAYANAN';
    public $timestamps = true;

    protected $fillable = [
        'ID_PEGAWAI',
        'PEG_ID_PEGAWAI',
        'ID_CUSTOMER',
        'ID_HEWAN',
        'KODE_TRANSAKSI_PENJUALAN_LAYANAN',
        'TGL_TRANSAKSI_PENJUALAN_LAYANAN',
        'SUB_TOTAL_PENJUALAN_LAYANAN',
        'DISKON_PENJUALAN_LAYANAN',
        'TOTAL_HARGA_PENJUALAN_LAYANAN',
        'STATUS_LAYANAN',
        'STATUS_PEMBAYARAN_LAYANAN'
    ];

    // Detail transaksi
    public function details()
    {
        return $this->hasMany(DetailTransaksiLayanan::class, 'ID_TRANSAKSI_LAYANAN', 'ID_TRANSAKSI_LAYANAN');
    }

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_CUSTOMER', 'ID_CUSTOMER');
    }

    // Hewan
    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'ID_HEWAN', 'ID_HEWAN');
    }

    // Pegawai CS (yang input layanan)
    public function pegawai_cs()
    {
        return $this->belongsTo(Pegawai::class, 'PEG_ID_PEGAWAI', 'ID_PEGAWAI');
    }

    public function pegawai_kasir()
    {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI', 'ID_PEGAWAI');
    }
}
