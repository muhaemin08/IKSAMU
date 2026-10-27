<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe',
        'nama',
        'kapasitas',
        'jumlah_kamar',
        'pembina',
        'foto',
        'deskripsi',
        'fasilitas',
    ];

    protected $casts = [
        'fasilitas' => 'array',
    ];

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }
}
