<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship
    public function permintaan()
    {
        return $this->hasMany(Permintaan::class, 'pemohon_id');
    }

    // Helper Methods
    public function isGudang()
    {
        return $this->role === 'gudang';
    }

    public function isDapur()
    {
        return $this->role === 'dapur';
    }
}