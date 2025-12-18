<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiProduk extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi_penjualan_produk';
    protected $primaryKey = 'ID_TRANSAKSI_PENJUALAN_PRODUK';
    public $timestamps = true;

    protected $fillable = [
        'ID_PEGAWAI',
        'PEG_ID_PEGAWAI',
        'ID_CUSTOMER',
        'KODE_TRANSAKSI_PENJUALAN_PRODUK',
        'TGL_TRANSAKSI_PENJUALAN_PRODUK',
        'SUB_TOTAL_PENJUALAN_PRODUK',
        'DISKON_PENJUALAN_PRODUK',
        'TOTAL_HARGA_PENJUALAN_PRODUK',
        'STATUS_PEMBAYARAN_PRODUK'
    ];

    public function details()
    {
        return $this->hasMany(DetailTransaksiProduk::class, 'ID_TRANSAKSI_PENJUALAN_PRODUK', 'ID_TRANSAKSI_PENJUALAN_PRODUK');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_CUSTOMER', 'ID_CUSTOMER');
    }

    public function pegawai_cs() {
        return $this->belongsTo(Pegawai::class, 'ID_PEGAWAI', 'ID_PEGAWAI');
    }

    public function pegawai_kasir() {
        return $this->belongsTo(Pegawai::class, 'PEG_ID_PEGAWAI', 'ID_PEGAWAI');
    }


}
