<?php

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
        'created_at'
    ];

    public $timestamps = false;

    protected $casts = [
        'tgl_masak' => 'date',
    ];

    // Relasi ke user (pemohon)
    public function pemohon()
    {
        return $this->belongsTo(User::class, 'pemohon_id');
    }

    // Relasi ke permintaan detail
    public function details()
    {
        return $this->hasMany(PermintaanDetail::class, 'permintaan_id');
    }

    // Method untuk mendapatkan badge class berdasarkan status
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'menunggu' => 'warning',
            'disetujui' => 'success',
            'ditolak' => 'danger'
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    // Method untuk mendapatkan label status
    public function getStatusLabelAttribute()
    {
        $labels = [
            'menunggu' => 'Menunggu',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak'
        ];

        return $labels[$this->status] ?? 'Tidak Diketahui';
    }
}