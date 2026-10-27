<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanFormal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'npsn',
        'akreditasi',
        'jenjang',
        'kepala_sekolah',
        'foto_kepala_sekolah',
        'sambutan_kepala_sekolah',
        'nip_kepala_sekolah',
        'deskripsi',
        'foto',
        'keunggulan',
        'ekskul',
        'jurusan',
    ];

    protected $casts = [
        'keunggulan' => 'array',
        'ekskul' => 'array',
        'jurusan' => 'array',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'pendidikan_formal_id')->latest();
    }
}
