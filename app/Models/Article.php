<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'pendidikan_formal_id',
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'thumbnail',
        'penulis',
        'tanggal_publikasi',
        'tag',
        'status',
        'views',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendidikanFormal()
    {
        return $this->belongsTo(PendidikanFormal::class, 'pendidikan_formal_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->judul) . '-' . Str::random(5);
            }
        });
    }
}
