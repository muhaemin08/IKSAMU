<?php

// Pastikan direktori writable di /tmp Vercel sudah tersedia
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

// Teruskan request ke public/index.php Laravel
require __DIR__ . '/../public/index.php';
