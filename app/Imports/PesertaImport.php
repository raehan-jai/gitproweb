<?php

namespace App\Imports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PesertaImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $kegiatan_id;

    public function __construct($kegiatan_id)
    {
        $this->kegiatan_id = $kegiatan_id;
    }

    // Setiap baris Excel diubah menjadi record Peserta
    public function model(array $row)
    {
        return new Peserta([
            'kegiatan_id' => $this->kegiatan_id,
            'nama'        => $row['nama'],          // Header kolom Excel harus: nama
            'nis'         => $row['nis'] ?? null,
            'nisn'        => $row['nisn'] ?? null,
            'kelas'       => $row['kelas'] ?? null,
        ]);
    }

    // Validasi tiap baris
    public function rules(): array
    {
        return [
            'nama' => 'required|string',
        ];
    }
}