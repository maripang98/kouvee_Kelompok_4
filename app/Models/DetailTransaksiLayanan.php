<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksiLayanan extends Model
{
    use SoftDeletes;

    protected $table = 'detail_transaksi_penjualan_lay';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_LAYANAN',
        'ID_TRANSAKSI_LAYANAN',
        'JUMLAH_ORDER_LAYANAN'
    ];

    // ✅ Relasi balik ke transaksi
    public function transaksi()
    {
        return $this->belongsTo(TransaksiLayanan::class, 'ID_TRANSAKSI_LAYANAN', 'ID_TRANSAKSI_LAYANAN');
    }

    // ✅ Relasi ke layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'ID_LAYANAN', 'ID_LAYANAN');
    }
}

