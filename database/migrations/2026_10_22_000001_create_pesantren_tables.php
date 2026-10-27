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
        // Add role column to users table if not exists
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('penulis')->after('email');
            });
        }

        // 1. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // 2. Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('badge_class')->default('bg-emerald-100 text-emerald-800');
            $table->timestamps();
        });

        // 3. Articles Table (Publikasi: Artikel, Even, Kegiatan Santri)
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('konten');
            $table->string('thumbnail')->nullable();
            $table->string('penulis')->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->string('tag')->nullable();
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });

        // 4. Dewan Masayikh Table
        Schema::create('masayikhs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gelar')->nullable();
            $table->string('peran')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 5. Asrama Table
        Schema::create('asramas', function (Blueprint $table) {
            $table->id();
            $table->string('tipe'); // 'putra', 'putri'
            $table->string('nama');
            $table->string('kapasitas')->nullable();
            $table->string('jumlah_kamar')->nullable();
            $table->string('pembina')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->json('fasilitas')->nullable();
            $table->timestamps();
        });

        // 6. Jadwal Harian Table
        Schema::create('jadwal_harians', function (Blueprint $table) {
            $table->id();
            $table->string('waktu');
            $table->string('kegiatan');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 7. Pendidikan Formal Table (MTs & SMK)
        Schema::create('pendidikan_formals', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // 'mts', 'smk'
            $table->string('nama');
            $table->string('npsn')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('kepala_sekolah')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->json('keunggulan')->nullable();
            $table->json('ekskul')->nullable();
            $table->json('jurusan')->nullable();
            $table->timestamps();
        });

        // 8. PSB Registrations Table
        Schema::create('psb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_santri');
            $table->string('jenis_kelamin');
            $table->string('pilihan_pendidikan');
            $table->string('pilihan_asrama');
            $table->string('nama_wali');
            $table->string('no_hp');
            $table->text('alamat_asal');
            $table->enum('status', ['pending', 'diverifikasi', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psb_registrations');
        Schema::dropIfExists('pendidikan_formals');
        Schema::dropIfExists('jadwal_harians');
        Schema::dropIfExists('asramas');
        Schema::dropIfExists('masayikhs');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('settings');

        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
