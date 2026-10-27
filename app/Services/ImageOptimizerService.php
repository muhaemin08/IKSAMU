<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageOptimizerService
{
    /**
     * Konversi dan kompres otomatis file gambar ke format WebP teroptimasi.
     * Ukuran dimensi gambar akan otomatis disesuaikan secara proporsional jika melebihi batas maksimal.
     *
     * @param UploadedFile $file
     * @param string $subDir Direktori tujuan relatif dari public_path() (misal: 'assets/images/articles')
     * @param string $prefix Awalan nama file (misal: 'art_')
     * @param int $maxWidth Lebar maksimal gambar dalam pixel (default 1280px)
     * @param int $maxHeight Tinggi maksimal gambar dalam pixel (default 1280px)
     * @param int $quality Kualitas WebP 1-100 (default 82)
     * @return string Path relatif untuk disimpan ke database (misal: 'assets/images/articles/art_1729600000_abc.webp')
     */
    public static function convertAndSave(
        UploadedFile $file,
        string $subDir = 'assets/images',
        string $prefix = 'img_',
        int $maxWidth = 1280,
        int $maxHeight = 1280,
        int $quality = 82
    ): string {
        $destPath = public_path($subDir);
        $isReadOnly = false;

        // Cek apakah sistem file read-only (misal: Vercel serverless)
        try {
            if (!File::isDirectory($destPath)) {
                if (!@File::makeDirectory($destPath, 0755, true, true)) {
                    $isReadOnly = true;
                }
            } elseif (!is_writable($destPath)) {
                $isReadOnly = true;
            }
        } catch (\Throwable $e) {
            $isReadOnly = true;
        }

        $filename = $prefix . time() . '_' . Str::lower(Str::random(6)) . '.webp';
        $fullPath = $destPath . DIRECTORY_SEPARATOR . $filename;
        $relativeResult = trim($subDir, '/\\') . '/' . $filename;

        // Cek ketersediaan fungsi GD
        if (!extension_loaded('gd') || !function_exists('imagewebp')) {
            if ($isReadOnly) {
                return 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            }
            $fallbackName = $prefix . time() . '_' . Str::lower(Str::random(6)) . '.' . $file->getClientOriginalExtension();
            $file->move($destPath, $fallbackName);
            return trim($subDir, '/\\') . '/' . $fallbackName;
        }

        $realPath = $file->getRealPath();
        $mime = $file->getMimeType();
        $source = null;

        // Buat GD image resource berdasarkan tipe mime
        try {
            switch ($mime) {
                case 'image/jpeg':
                case 'image/pjpeg':
                    if (function_exists('imagecreatefromjpeg')) {
                        $source = @imagecreatefromjpeg($realPath);
                    }
                    break;
                case 'image/png':
                case 'image/x-png':
                    if (function_exists('imagecreatefrompng')) {
                        $source = @imagecreatefrompng($realPath);
                    }
                    break;
                case 'image/webp':
                    if (function_exists('imagecreatefromwebp')) {
                        $source = @imagecreatefromwebp($realPath);
                    }
                    break;
                case 'image/gif':
                    if (function_exists('imagecreatefromgif')) {
                        $source = @imagecreatefromgif($realPath);
                    }
                    break;
                case 'image/bmp':
                case 'image/x-ms-bmp':
                    if (function_exists('imagecreatefrombmp')) {
                        $source = @imagecreatefrombmp($realPath);
                    }
                    break;
            }
        } catch (\Throwable $e) {
            $source = null;
        }

        // Jika gagal membaca gambar dengan GD, fallback ke pemindahan standar
        if (!$source) {
            if ($isReadOnly) {
                return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($realPath));
            }
            $fallbackName = $prefix . time() . '_' . Str::lower(Str::random(6)) . '.' . $file->getClientOriginalExtension();
            $file->move($destPath, $fallbackName);
            return trim($subDir, '/\\') . '/' . $fallbackName;
        }

        // Perbaiki rotasi orientasi EXIF (biasa terjadi pada foto HP)
        if (function_exists('exif_read_data') && ($mime === 'image/jpeg' || $mime === 'image/pjpeg')) {
            try {
                $exif = @exif_read_data($realPath);
                if (!empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $source = imagerotate($source, 180, 0);
                            break;
                        case 6:
                            $source = imagerotate($source, -90, 0);
                            break;
                        case 8:
                            $source = imagerotate($source, 90, 0);
                            break;
                    }
                }
            } catch (\Throwable $e) {
                // Abaikan kesalahan EXIF
            }
        }

        // Ambil dimensi asli
        $origWidth = imagesx($source);
        $origHeight = imagesy($source);

        // Hitung skala rasio agar tidak melebihi maxWidth dan maxHeight
        $scale = 1.0;
        if ($origWidth > $maxWidth || $origHeight > $maxHeight) {
            $scale = min($maxWidth / $origWidth, $maxHeight / $origHeight);
        }

        $newWidth = (int) max(1, round($origWidth * $scale));
        $newHeight = (int) max(1, round($origHeight * $scale));

        // Buat canvas gambar baru
        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        // Pertahankan transparansi (untuk PNG/WebP transparan)
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);
        $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $transparent);

        // Resample dengan kualitas tinggi
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        // Simpan langsung ke format WebP
        if ($isReadOnly) {
            ob_start();
            imagewebp($canvas, null, $quality);
            $rawWebp = ob_get_clean();
            imagedestroy($source);
            imagedestroy($canvas);
            return 'data:image/webp;base64,' . base64_encode($rawWebp);
        }

        imagewebp($canvas, $fullPath, $quality);

        // Bebaskan memori
        imagedestroy($source);
        imagedestroy($canvas);

        return $relativeResult;
    }
}
