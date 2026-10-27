<?php

namespace Database\Seeders;

use App\Models\Asrama;
use App\Models\Santri;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsramaAndSantriSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Refresh & Seed Asramas
        $asramasData = [
            [
                'tipe' => 'putra',
                'nama' => 'Asrama Selamet',
                'kapasitas' => '350 Santri',
                'jumlah_kamar' => '20 Kamar Asrama',
                'pembina' => 'Ustadz Lukman Hakim, S.Sos & Mudabbir Putra',
                'foto' => 'assets/images/hero-pesantren.jpg',
                'deskripsi' => 'Kompleks asrama putra utama Miftahul Ulum Gunung Bubut yang membina santri dengan nilai kedisiplinan sholat berjamaah, sorogan kitab kuning, dan pembiasaan adab salaf.',
                'fasilitas' => [
                    'Kamar santri asri & berventilasi baik',
                    'Dekat dengan Masjid Jami\' Pesantren',
                    'Kamar mandi & sanitasi modern air pegunungan',
                    'Ruang kajian & mudzakarah santri',
                    'Area jemuran terpadu & cuci pakaian',
                    'Keamanan 24 jam terpantau pengurus'
                ]
            ],
            [
                'tipe' => 'putra',
                'nama' => 'Asrama Rahayu',
                'kapasitas' => '300 Santri',
                'jumlah_kamar' => '16 Kamar Asrama',
                'pembina' => 'Ustadz Ahmad Fauzi, S.Pd.I & Mudabbir Putra',
                'foto' => 'assets/images/hero-pesantren.jpg',
                'deskripsi' => 'Kompleks asrama putra yang didesain untuk kenyamanan istirahat santri, kegiatan pembinaan bahasa Arab dan Inggris, serta kegiatan halaqah tahfidz.',
                'fasilitas' => [
                    'Kamar hunian berlantai keramik rapi',
                    'Ruang halaqah tahfidz & pengajian malam',
                    'Kantin & koperasi santri terdekat',
                    'Fasilitas olahraga & kebugaran santri',
                    'Tempat wudhu & sanitasi representatif',
                    'Akses jaringan literasi digital terjadwal'
                ]
            ],
            [
                'tipe' => 'putri',
                'nama' => 'Asrama Al-Hidayah Lama',
                'kapasitas' => '300 Santriwati',
                'jumlah_kamar' => '16 Kamar Asrama',
                'pembina' => 'Ustadzah Nurul Inayah, S.Ag & Mudabbirah Putri',
                'foto' => 'https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Kompleks asrama putri bersejarah yang berpagar tertutup, menjaga privasi santriwati, dan menjadi pusat kegiatan kajian fiqih nisa serta hafalan al-Qur\'an.',
                'fasilitas' => [
                    'Kompleks tertutup khusus berpagar mandiri',
                    'Musholla putri untuk sholat berjamaah & wirid',
                    'Ruang belajar & bimbingan sorogan kitab',
                    'Dapur bersih santriwati & ruang makan',
                    'Pos kesehatan santriwati (Poskestren)',
                    'Kamar mandi bersih dengan pasokan air melimpah'
                ]
            ],
            [
                'tipe' => 'putri',
                'nama' => 'Asrama Al-Hidayah Baru',
                'kapasitas' => '350 Santriwati',
                'jumlah_kamar' => '18 Kamar Asrama',
                'pembina' => 'Ustadzah Siti Maryam, S.Pd & Mudabbirah Putri',
                'foto' => 'https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Gedung asrama putri modern terpadu yang dilengkapi sarana pendukung literasi, ketrampilan keputrian (tata boga, kaligrafi, menjahit), serta bimbingan intensif akhlaqul karimah.',
                'fasilitas' => [
                    'Kamar asrama modern & ventilasi lapang',
                    'Aula pertemuan & ketrampilan keputrian',
                    'Ruang baca & perpustakaan mini santriwati',
                    'Koperasi keputrian santriwati mandiri',
                    'Area cuci & jemuran tertutup aman',
                    'Pengawasan ketat ustadzah pembina 24 jam'
                ]
            ],
        ];

        // Delete old asramas and insert new
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Santri::truncate();
        Asrama::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $insertedAsramas = [];
        foreach ($asramasData as $data) {
            $insertedAsramas[$data['nama']] = Asrama::create($data);
        }

        // 2. Seed Initial Santri Samples
        $santriSamples = [
            // Asrama Selamet (Putra)
            [
                'asrama_id' => $insertedAsramas['Asrama Selamet']->id,
                'nis' => 'MU-2026-001',
                'nama' => 'Muhammad Faiz Ramadhan',
                'jenis_kelamin' => 'Laki-laki',
                'kamar' => 'Kamar 03 (Abu Bakar)',
                'jenjang' => 'MTs Miftahul Ulum',
                'kelas' => 'VIII-A',
                'tempat_lahir' => 'Tasikmalaya',
                'tanggal_lahir' => '2011-04-12',
                'alamat' => 'Kp. Babakan RT 02/04 Sodonghilir, Kab. Tasikmalaya',
                'nama_wali' => 'H. Dedi Supriadi',
                'telepon_wali' => '081234567890',
                'status' => 'Aktif',
            ],
            [
                'asrama_id' => $insertedAsramas['Asrama Selamet']->id,
                'nis' => 'MU-2026-002',
                'nama' => 'Ahmad Rifa\'i Al-Ghifari',
                'jenis_kelamin' => 'Laki-laki',
                'kamar' => 'Kamar 05 (Umar bin Khattab)',
                'jenjang' => 'SMK Miftahul Ulum',
                'kelas' => 'XI TKJ 1',
                'tempat_lahir' => 'Ciamis',
                'tanggal_lahir' => '2008-08-20',
                'alamat' => 'Desa Panjalu, Kab. Ciamis',
                'nama_wali' => 'Drs. Ridwan Hakim',
                'telepon_wali' => '082198765432',
                'status' => 'Aktif',
            ],

            // Asrama Rahayu (Putra)
            [
                'asrama_id' => $insertedAsramas['Asrama Rahayu']->id,
                'nis' => 'MU-2026-003',
                'nama' => 'Rizki Maulana Pratama',
                'jenis_kelamin' => 'Laki-laki',
                'kamar' => 'Kamar 02 (Utsman bin Affan)',
                'jenjang' => 'MTs Miftahul Ulum',
                'kelas' => 'VII-B',
                'tempat_lahir' => 'Garut',
                'tanggal_lahir' => '2012-01-15',
                'alamat' => 'Kec. Singajaya, Kab. Garut',
                'nama_wali' => 'Asep Saepuloh',
                'telepon_wali' => '085311223344',
                'status' => 'Aktif',
            ],
            [
                'asrama_id' => $insertedAsramas['Asrama Rahayu']->id,
                'nis' => 'MU-2026-004',
                'nama' => 'Fajar Shodiq Al-Hafidz',
                'jenis_kelamin' => 'Laki-laki',
                'kamar' => 'Kamar 07 (Ali bin Abi Thalib)',
                'jenjang' => 'Pesantren Salafiyah',
                'kelas' => 'Wustho',
                'tempat_lahir' => 'Tasikmalaya',
                'tanggal_lahir' => '2009-10-05',
                'alamat' => 'Taraju, Kab. Tasikmalaya',
                'nama_wali' => 'K.H. Mansur Syahid',
                'telepon_wali' => '081399887766',
                'status' => 'Aktif',
            ],

            // Asrama Al-Hidayah Lama (Putri)
            [
                'asrama_id' => $insertedAsramas['Asrama Al-Hidayah Lama']->id,
                'nis' => 'MU-2026-005',
                'nama' => 'Siti Aisyah Nurfadilah',
                'jenis_kelamin' => 'Perempuan',
                'kamar' => 'Kamar 01 (Khadijah)',
                'jenjang' => 'MTs Miftahul Ulum',
                'kelas' => 'IX-A',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2010-06-18',
                'alamat' => 'Rancaekek, Kab. Bandung',
                'nama_wali' => 'Ustadz Burhanudin',
                'telepon_wali' => '087755667788',
                'status' => 'Aktif',
            ],
            [
                'asrama_id' => $insertedAsramas['Asrama Al-Hidayah Lama']->id,
                'nis' => 'MU-2026-006',
                'nama' => 'Nabila Putri Azzahra',
                'jenis_kelamin' => 'Perempuan',
                'kamar' => 'Kamar 04 (Fatimah)',
                'jenjang' => 'Pesantren Salafiyah',
                'kelas' => 'Ula',
                'tempat_lahir' => 'Tasikmalaya',
                'tanggal_lahir' => '2011-11-25',
                'alamat' => 'Bojonggambir, Kab. Tasikmalaya',
                'nama_wali' => 'Hj. Elis Rohayati',
                'telepon_wali' => '082233445566',
                'status' => 'Aktif',
            ],

            // Asrama Al-Hidayah Baru (Putri)
            [
                'asrama_id' => $insertedAsramas['Asrama Al-Hidayah Baru']->id,
                'nis' => 'MU-2026-007',
                'nama' => 'Zahra Amelia Sholihat',
                'jenis_kelamin' => 'Perempuan',
                'kamar' => 'Kamar 03 (Maryam)',
                'jenjang' => 'SMK Miftahul Ulum',
                'kelas' => 'X RPL 1',
                'tempat_lahir' => 'Ciamis',
                'tanggal_lahir' => '2009-03-30',
                'alamat' => 'Kawali, Kab. Ciamis',
                'nama_wali' => 'Endang Suherman, S.E.',
                'telepon_wali' => '081987654321',
                'status' => 'Aktif',
            ],
            [
                'asrama_id' => $insertedAsramas['Asrama Al-Hidayah Baru']->id,
                'nis' => 'MU-2026-008',
                'nama' => 'Hilya Nidaul Khoir',
                'jenis_kelamin' => 'Perempuan',
                'kamar' => 'Kamar 06 (Aisyah)',
                'jenjang' => 'SMK Miftahul Ulum',
                'kelas' => 'XII Tata Busana',
                'tempat_lahir' => 'Tasikmalaya',
                'tanggal_lahir' => '2007-07-07',
                'alamat' => 'Sodonghilir, Kab. Tasikmalaya',
                'nama_wali' => 'Maman Abdurrahman',
                'telepon_wali' => '085222333444',
                'status' => 'Aktif',
            ],
        ];

        foreach ($santriSamples as $santri) {
            Santri::create($santri);
        }
    }
}
