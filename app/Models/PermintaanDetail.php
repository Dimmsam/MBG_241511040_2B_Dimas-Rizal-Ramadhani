<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanDetail extends Model
{
    protected $table = 'permintaan_detail';
    
    protected $fillable = [
        'permintaan_id',
        'bahan_id',
        'jumlah_diminta'
    ];

    public $timestamps = false;

    // Relasi ke permintaan
    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'permintaan_id');
    }

    // Relasi ke bahan baku
    public function bahan()
    {
        return $this->belongsTo(BahanBaku::class, 'bahan_id');
    }
}