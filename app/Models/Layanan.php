<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'layanan';
    protected $primaryKey = 'ID_LAYANAN';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_LAYANAN',
        'DESKRIPSI_LAYANAN',
        'GAMBAR_LAYANAN',
        'HARGA_LAYANAN',
    ];
}
