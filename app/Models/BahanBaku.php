<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    
    protected $fillable = [
        'nama',
        'kategori',
        'jumlah',
        'satuan',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'status',
        'created_at'
    ];

    public $timestamps = false;

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];
}
