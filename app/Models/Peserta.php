<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';

    // ← TAMBAHKAN INI — paksa route parameter jadi "peserta"
    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'kegiatan_id',
        'user_id',   
        'nama',
        'nis',
        'nisn',
        'kelas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class);
    }

    // ← TAMBAHKAN INI — paksa route model binding pakai "peserta"
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}