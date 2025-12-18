<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hewan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hewan';
    protected $primaryKey = 'ID_HEWAN';
    public $timestamps = false;

    protected $fillable = [
        'ID_CUSTOMER',
        'NAMA_HEWAN',
        'TGL_LAHIR_HEWAN',
        'JENIS_HEWAN',
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ID_CUSTOMER', 'ID_CUSTOMER');
    }
}
