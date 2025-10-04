<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'created_at'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    // Helper method untuk cek role
    public function isGudang()
    {
        return $this->role === 'gudang';
    }

    public function isDapur()
    {
        return $this->role === 'dapur';
    }
}
