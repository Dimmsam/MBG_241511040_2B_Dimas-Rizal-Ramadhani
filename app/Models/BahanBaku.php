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

    // Method untuk menghitung status otomatis
    public function getStatusOtomatisAttribute()
    {
        $now = Carbon::now();
        $tanggalKadaluarsa = Carbon::parse($this->tanggal_kadaluarsa);
        $selisihHari = $now->diffInDays($tanggalKadaluarsa, false);

        // Habis: jika jumlah = 0
        if ($this->jumlah == 0) {
            return 'habis';
        }

        // Kadaluarsa: jika hari_ini >= tanggal_kadaluarsa
        if ($selisihHari < 0 || $now->isSameDay($tanggalKadaluarsa)) {
            return 'kadaluarsa';
        }

        // Segera Kadaluarsa: jika tanggal_kadaluarsa - hari_ini <= 3 dan stok > 0
        if ($selisihHari <= 3 && $this->jumlah > 0) {
            return 'segera_kadaluarsa';
        }

        // Tersedia: jika stok > 0 dan tidak masuk kondisi di atas
        return 'tersedia';
    }

    // Method untuk mendapatkan badge class berdasarkan status
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'tersedia' => 'success',
            'segera_kadaluarsa' => 'warning',
            'kadaluarsa' => 'danger',
            'habis' => 'secondary'
        ];

        return $badges[$this->status_otomatis] ?? 'secondary';
    }

    // Method untuk mendapatkan label status dalam bahasa Indonesia
    public function getStatusLabelAttribute()
    {
        $labels = [
            'tersedia' => 'Tersedia',
            'segera_kadaluarsa' => 'Segera Kadaluarsa',
            'kadaluarsa' => 'Kadaluarsa',
            'habis' => 'Habis'
        ];

        return $labels[$this->status_otomatis] ?? 'Tidak Diketahui';
    }

    // Relasi ke permintaan detail
    public function permintaanDetail()
    {
        return $this->hasMany(PermintaanDetail::class, 'bahan_id');
    }
}
