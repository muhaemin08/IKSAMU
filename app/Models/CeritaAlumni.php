<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeritaAlumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tahun_lulus',
        'jenjang',
        'profesi',
        'judul',
        'isi_cerita',
        'foto',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];
}
