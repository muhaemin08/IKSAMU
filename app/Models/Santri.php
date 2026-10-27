<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'asrama_id',
        'nis',
        'nama',
        'jenis_kelamin',
        'kamar',
        'jenjang',
        'kelas',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'nama_wali',
        'telepon_wali',
        'status',
        'foto',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function asrama()
    {
        return $this->belongsTo(Asrama::class);
    }

    /**
     * Dapatkan Statistik Asal Daerah Santri berdasarkan Kabupaten, Kecamatan, dan Desa
     */
    public static function getStatistikWilayah()
    {
        $totalSantri = self::count();
        if ($totalSantri === 0) {
            return [
                'total_kabupaten' => 0,
                'total_kecamatan' => 0,
                'total_desa' => 0,
                'kabupaten' => collect(),
                'kecamatan' => collect(),
                'desa' => collect(),
            ];
        }

        $kabupaten = self::selectRaw('COALESCE(NULLIF(kabupaten, ""), "Lainnya") as nama_wilayah, COUNT(*) as total')
            ->groupBy('nama_wilayah')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) use ($totalSantri) {
                $item->persentase = round(($item->total / $totalSantri) * 100, 1);
                return $item;
            });

        $kecamatan = self::selectRaw('COALESCE(NULLIF(kecamatan, ""), "Lainnya") as nama_wilayah, COALESCE(NULLIF(kabupaten, ""), "-") as nama_kabupaten, COUNT(*) as total')
            ->groupBy('nama_wilayah', 'nama_kabupaten')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) use ($totalSantri) {
                $item->persentase = round(($item->total / $totalSantri) * 100, 1);
                return $item;
            });

        $desa = self::selectRaw('COALESCE(NULLIF(desa, ""), "Lainnya") as nama_wilayah, COALESCE(NULLIF(kecamatan, ""), "-") as nama_kecamatan, COUNT(*) as total')
            ->groupBy('nama_wilayah', 'nama_kecamatan')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) use ($totalSantri) {
                $item->persentase = round(($item->total / $totalSantri) * 100, 1);
                return $item;
            });

        return [
            'total_santri' => $totalSantri,
            'total_kabupaten' => $kabupaten->where('nama_wilayah', '!=', 'Lainnya')->count(),
            'total_kecamatan' => $kecamatan->where('nama_wilayah', '!=', 'Lainnya')->count(),
            'total_desa' => $desa->where('nama_wilayah', '!=', 'Lainnya')->count(),
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
        ];
    }
}
