<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',        // ← tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper: cek apakah user adalah admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Helper: cek apakah user adalah guru
    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    // Helper: cek apakah user adalah siswa
    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    // Relasi: 1 user bisa buat banyak kegiatan
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}