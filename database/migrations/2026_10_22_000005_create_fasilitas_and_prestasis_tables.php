<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Fasilitas Pesantren
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori')->default('Fasilitas Utama');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->string('icon')->nullable()->default('fa-building-columns');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel Prestasi Santri & Lembaga
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->default('Keagamaan');
            $table->string('tingkat')->default('Kabupaten');
            $table->string('tahun', 10)->default('2026');
            $table->string('peraih');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
        Schema::dropIfExists('fasilitas');
    }
};
