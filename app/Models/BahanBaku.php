<?php
// app/Models/BahanBaku.php

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
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];

    // Relationship
    public function permintaanDetail()
    {
        return $this->hasMany(PermintaanDetail::class, 'bahan_id');
    }

    // Auto-calculate status (Accessor)
    public function getStatusOtomatisAttribute()
    {
        $today = Carbon::now()->startOfDay();
        $kadaluarsa = Carbon::parse($this->tanggal_kadaluarsa)->startOfDay();
        $selisihHari = $today->diffInDays($kadaluarsa, false);

        // Prioritas pengecekan sesuai aturan bisnis
        if ($this->jumlah == 0) {
            return 'habis';
        }
        
        if ($kadaluarsa->lt($today)) {
            return 'kadaluarsa';
        }
        
        if ($selisihHari <= 3 && $selisihHari >= 0) {
            return 'segera_kadaluarsa';
        }
        
        return 'tersedia';
    }

    // Scope untuk filter bahan tersedia (untuk dropdown dapur)
    public function scopeTersedia($query)
    {
        $today = Carbon::now()->startOfDay();
        
        return $query->where('jumlah', '>', 0)
                     ->where('tanggal_kadaluarsa', '>=', $today);
    }

    // Method untuk update status
    public function updateStatus()
    {
        $this->status = $this->status_otomatis;
        $this->save();
    }
}