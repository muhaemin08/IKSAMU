<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom wilayah pada tabel santris
        Schema::table('santris', function (Blueprint $table) {
            $table->string('desa', 100)->nullable()->after('alamat');
            $table->string('kecamatan', 100)->nullable()->after('desa');
            $table->string('kabupaten', 100)->nullable()->after('kecamatan');
            $table->string('provinsi', 100)->nullable()->default('Jawa Barat')->after('kabupaten');
        });

        // 2. Buat tabel cerita_alumnis
        Schema::create('cerita_alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tahun_lulus', 50); // Contoh: Angkatan 2018 / Lulus 2020
            $table->string('jenjang', 100)->nullable(); // Contoh: MTs & SMK Miftahul Ulum
            $table->string('profesi'); // Contoh: Mahasiswa Al-Azhar Kairo / Software Engineer / Pengusaha
            $table->string('judul'); // Judul cerita / testimoni
            $table->text('isi_cerita'); // Kisah lengkap & kenangan
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // 3. Update sample santri jika ada agar memiliki wilayah awal
        $sampleKabupaten = ['Kab. Tasikmalaya', 'Kota Tasikmalaya', 'Kab. Garut', 'Kab. Ciamis', 'Kota Bandung', 'Kab. Pangandaran'];
        $sampleKecamatan = [
            'Kab. Tasikmalaya' => ['Sodonghilir', 'Taraju', 'Bojonggambir', 'Salawu', 'Singaparna'],
            'Kota Tasikmalaya' => ['Cihideung', 'Tawang', 'Kawalu', 'Tamansari'],
            'Kab. Garut' => ['Singajaya', 'Banjarwangi', 'Cikajang', 'Tarogong'],
            'Kab. Ciamis' => ['Kawali', 'Panjalu', 'Cikoneng'],
            'Kota Bandung' => ['Buahbatu', 'Coblong', 'Cibeunying'],
            'Kab. Pangandaran' => ['Parigi', 'Padaherang', 'Kalipucang'],
        ];
        $sampleDesa = [
            'Sodonghilir' => ['Pakalongan', 'Cukangkawung', 'Sodonghilir', 'Sepatnunggal'],
            'Taraju' => ['Taraju', 'Purwaraharja', 'Deudeul'],
            'Bojonggambir' => ['Bojonggambir', 'Campakasari'],
            'Salawu' => ['Salawu', 'Tanjungsari'],
            'Singaparna' => ['Singaparna', 'Sukarame'],
        ];

        $santris = DB::table('santris')->get();
        foreach ($santris as $i => $s) {
            $kab = $sampleKabupaten[$i % count($sampleKabupaten)];
            $kecList = $sampleKecamatan[$kab] ?? ['Sodonghilir'];
            $kec = $kecList[$i % count($kecList)];
            $desaList = $sampleDesa[$kec] ?? ['Pakalongan', 'Cukangkawung', 'Sukamaju'];
            $desa = $desaList[$i % count($desaList)];

            DB::table('santris')->where('id', $s->id)->update([
                'desa' => $desa,
                'kecamatan' => $kec,
                'kabupaten' => $kab,
                'provinsi' => 'Jawa Barat',
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cerita_alumnis');

        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn(['desa', 'kecamatan', 'kabupaten', 'provinsi']);
        });
    }
};
