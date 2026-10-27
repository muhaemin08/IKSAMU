<?php

// 0. Deteksi HTTPS dari Reverse Proxy (Vercel)
if ((isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') || isset($_SERVER['VERCEL'])) {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

// 1. Pastikan direktori writable di /tmp Vercel sudah tersedia
$dirs = [
    '/tmp/views',
    '/tmp/cache',
    '/tmp/sessions',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// 2. SQLite Auto-Fallback: jika belum ada DB MySQL eksternal yang diset,
// gunakan database.sqlite yang sudah terisi data lengkap pesantren
$isMysql = (getenv('DB_CONNECTION') === 'mysql') || (!empty(getenv('DB_HOST')) && getenv('DB_HOST') !== '127.0.0.1');

if (!$isMysql) {
    $sqliteSource = __DIR__ . '/../database/database.sqlite';
    $sqliteTmp = '/tmp/database.sqlite';

    // Salin jika belum ada atau ukuran tidak valid
    if (file_exists($sqliteSource) && (!file_exists($sqliteTmp) || filesize($sqliteTmp) < 1000)) {
        @copy($sqliteSource, $sqliteTmp);
    }

    // Pastikan hak akses baca & tulis (read-write) untuk SQLite
    if (file_exists($sqliteTmp)) {
        @chmod($sqliteTmp, 0666);
    }

    $activeDb = file_exists($sqliteTmp) ? $sqliteTmp : $sqliteSource;

    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=' . $activeDb);
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = $activeDb;
}

// 3. Teruskan request ke public/index.php Laravel
require __DIR__ . '/../public/index.php';
