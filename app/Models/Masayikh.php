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

    /**
     * Accessor cerdas untuk foto masayikh (mendukung URL, Data URI Base64, dan file lokal)
     */
    public function getFotoUrlAttribute(): string
    {
        if (empty($this->foto)) {
            return 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=600&q=80';
        }

        if (str_starts_with($this->foto, 'http') || str_starts_with($this->foto, 'data:')) {
            return $this->foto;
        }

        return asset($this->foto);
    }
}
