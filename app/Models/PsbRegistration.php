<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsbRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'jalur_pendaftaran',
        'nama_santri',
        'nisn',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'anak_ke',
        'jumlah_saudara',
        'asal_sekolah',
        'pilihan_pendidikan',
        'pilihan_asrama',
        'nama_wali',
        'nama_ayah',
        'pekerjaan_ayah',
        'no_hp_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_hp_ibu',
        'penghasilan_ortu',
        'no_hp',
        'alamat_asal',
        'infaq_sukarela',
        'total_biaya',
        'sumber_info',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'infaq_sukarela' => 'integer',
        'total_biaya' => 'integer',
        'anak_ke' => 'integer',
        'jumlah_saudara' => 'integer',
    ];
}
