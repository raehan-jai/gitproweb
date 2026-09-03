<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertifikat extends Model
{
    use HasFactory;
    
    protected $table = 'sertifikat'; // ← TAMBAHKAN BARIS INI

    protected $fillable = [
        'peserta_id',
        'kegiatan_id',
        'template_id',
        'nomor_sertifikat',
        'file_path',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function template()
    {
        return $this->belongsTo(TemplateSertifikat::class, 'template_id');
    }
}
