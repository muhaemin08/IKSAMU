<?php

// 1. Pastikan direktori writable di /tmp Vercel sudah tersedia
$dirs = [
    '/tmp/views',
    '/tmp/cache',
    '/tmp/sessions',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// 2. SQLite Auto-Fallback: jika belum ada DB MySQL yang diset,
// gunakan database.sqlite yang sudah terisi data lengkap pesantren
$sqliteSource = __DIR__ . '/../database/database.sqlite';
$sqliteTmp = '/tmp/database.sqlite';
if (!file_exists($sqliteTmp) && file_exists($sqliteSource)) {
    @copy($sqliteSource, $sqliteTmp);
}

if (!getenv('DB_CONNECTION')) {
    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=/tmp/database.sqlite');
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = '/tmp/database.sqlite';
}

// 3. Teruskan request ke public/index.php Laravel
require __DIR__ . '/../public/index.php';
