<?php
// app/Models/Permintaan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';

    protected $fillable = [
        'pemohon_id',
        'tgl_masak',
        'menu_makan',
        'jumlah_porsi',
        'status',
        'alasan_tolak',
    ];

    protected $casts = [
        'tgl_masak' => 'date',
    ];

    // Relationships
    public function pemohon()
    {
        return $this->belongsTo(User::class, 'pemohon_id');
    }

    public function details()
    {
        return $this->hasMany(PermintaanDetail::class, 'permintaan_id');
    }

    // Scope
    public function scopeMenunggu($query)
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status', 'disetujui');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }
}