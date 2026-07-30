<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateSertifikat extends Model
{
    use HasFactory;

    protected $table = 'template_sertifikat';

    protected $fillable = [
        'nama_template',
        'background_path',
        'logo_sekolah_path',
        'ttd_kepsek_path',
        'nama_kepsek',
        'nip_kepsek',
        'ttd_panitia_path',
        'nama_panitia',
        'nip_panitia',
        'font_size_nama',
        'font_size_detail',
    ];

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'template_id');
    }
}
