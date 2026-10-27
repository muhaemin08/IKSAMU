<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Komponen Biaya Pendidikan PSB (Bisa diedit di Admin Panel)
        Schema::create('psb_biayas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_biaya');
            $table->string('kategori')->default('Daftar Ulang');
            $table->bigInteger('nominal_mts')->default(0);
            $table->bigInteger('nominal_smk')->default(0);
            $table->string('keterangan')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Expand Tabel Pendaftaran Calon Santri (Sesuai Form Sipenwaru Assalaam)
        Schema::table('psb_registrations', function (Blueprint $table) {
            $table->string('jalur_pendaftaran')->default('Reguler')->after('id');
            $table->string('nisn')->nullable()->after('nama_santri');
            $table->string('nik')->nullable()->after('nisn');
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->integer('anak_ke')->nullable()->after('tanggal_lahir');
            $table->integer('jumlah_saudara')->nullable()->after('anak_ke');
            $table->string('asal_sekolah')->nullable()->after('jumlah_saudara');
            $table->string('nama_ayah')->nullable()->after('nama_wali');
            $table->string('pekerjaan_ayah')->nullable()->after('nama_ayah');
            $table->string('no_hp_ayah')->nullable()->after('pekerjaan_ayah');
            $table->string('nama_ibu')->nullable()->after('no_hp_ayah');
            $table->string('pekerjaan_ibu')->nullable()->after('nama_ibu');
            $table->string('no_hp_ibu')->nullable()->after('pekerjaan_ibu');
            $table->string('penghasilan_ortu')->nullable()->after('no_hp_ibu');
            $table->bigInteger('infaq_sukarela')->default(0)->after('penghasilan_ortu');
            $table->bigInteger('total_biaya')->default(0)->after('infaq_sukarela');
            $table->string('sumber_info')->nullable()->after('total_biaya');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psb_biayas');
        Schema::table('psb_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'jalur_pendaftaran',
                'nisn',
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'anak_ke',
                'jumlah_saudara',
                'asal_sekolah',
                'nama_ayah',
                'pekerjaan_ayah',
                'no_hp_ayah',
                'nama_ibu',
                'pekerjaan_ibu',
                'no_hp_ibu',
                'penghasilan_ortu',
                'infaq_sukarela',
                'total_biaya',
                'sumber_info',
            ]);
        });
    }
};
