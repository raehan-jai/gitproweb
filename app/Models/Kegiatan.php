<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory;

    // Nama tabel (kalau berbeda dari nama model jamak)
    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'deskripsi',
        'penyelenggara',
        'user_id',
    ];

    // Format tanggal otomatis
    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi: kegiatan dimiliki oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 kegiatan punya banyak peserta
    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    // Relasi: 1 kegiatan punya banyak sertifikat
    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class);
    }
}