<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsbBiaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_biaya',
        'kategori',
        'nominal_mts',
        'nominal_smk',
        'keterangan',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'nominal_mts' => 'integer',
        'nominal_smk' => 'integer',
        'urutan' => 'integer',
        'is_active' => 'boolean',
    ];
}
