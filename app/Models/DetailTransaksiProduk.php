<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksiProduk extends Model
{
    use SoftDeletes;

    protected $table = 'detail_transaksi_penjualan_pro';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;

    protected $fillable = [
        'ID_PRODUK',
        'ID_TRANSAKSI_PENJUALAN_PRODUK',
        'JUMLAH_ORDER_PRODUK'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ID_PRODUK', 'ID_PRODUK');
    }

}
