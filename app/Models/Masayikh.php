<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masayikh extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'gelar',
        'peran',
        'deskripsi',
        'foto',
        'urutan',
    ];
}
