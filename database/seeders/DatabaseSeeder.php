<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Asrama;
use App\Models\Category;
use App\Models\JadwalHarian;
use App\Models\Masayikh;
use App\Models\PendidikanFormal;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@miftahululum.sch.id'],
            [
                'name' => 'Administrator Pesantren',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ]
        );

        $penulis = User::firstOrCreate(
            ['email' => 'penulis@miftahululum.sch.id'],
            [
                'name' => 'Ustadz Humas & Media',
                'password' => Hash::make('password'),
                'role' => 'penulis',
            ]
        );

        // 2. Settings (Setting dasar Aplikasi)
        $settings = [
            // Identitas
            ['key' => 'site_name', 'value' => 'Pondok Pesantren Miftahul Ulum', 'group' => 'identitas'],
            ['key' => 'site_subname', 'value' => 'GUNUNG BUBUT - TASIKMALAYA', 'group' => 'identitas'],
            ['key' => 'site_motto', 'value' => 'Berakhlakul Karimah, Unggul dalam Ilmu Agama, Terdepan dalam Teknologi', 'group' => 'identitas'],
            ['key' => 'bismillah_text', 'value' => 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ', 'group' => 'identitas'],
            ['key' => 'logo_url', 'value' => 'assets/images/logo-pesantren.jpg', 'group' => 'identitas'],
            
            // Kontak & Lokasi
            ['key' => 'phone', 'value' => '+62 821-2345-6789', 'group' => 'kontak'],
            ['key' => 'whatsapp_psb', 'value' => '6282123456789', 'group' => 'kontak'],
            ['key' => 'email', 'value' => 'info@miftahululumgunungbubut.sch.id', 'group' => 'kontak'],
            ['key' => 'address', 'value' => 'Jl. KHZ Abidin, Kp. Gunungbubut, Desa Pakalongan, Kec. Sodonghilir, Kab. Tasikmalaya, Jawa Barat 46473', 'group' => 'kontak'],
            ['key' => 'maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15822.46327008779!2d108.06941164999999!3d-7.4878434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e66016e78cb65bb%3A0xe54d6fa7c64bb93b!2sPakalongan%2C%20Kec.%20Sodonghilir%2C%20Kabupaten%20Tasikmalaya%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid', 'group' => 'kontak'],

            // Media Sosial
            ['key' => 'facebook', 'value' => 'https://facebook.com', 'group' => 'medsos'],
            ['key' => 'instagram', 'value' => 'https://instagram.com', 'group' => 'medsos'],
            ['key' => 'youtube', 'value' => 'https://youtube.com', 'group' => 'medsos'],
            ['key' => 'tiktok', 'value' => 'https://tiktok.com', 'group' => 'medsos'],

            // Hero & Sambutan
            ['key' => 'hero_title', 'value' => 'Pondok Pesantren Miftahul Ulum Gunung Bubut', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Lembaga pendidikan Islam yang memadukan tradisi keilmuan kitab salafiyah ala Ahlussunnah wal Jama\'ah An-Nahdliyyah dengan pendidikan formal terpadu MTs & SMK Miftahul Ulum guna mencetak santri yang berakhlak mulia, cerdas, dan mandiri.', 'group' => 'hero'],
            ['key' => 'hero_image', 'value' => 'assets/images/hero-pesantren.jpg', 'group' => 'hero'],
            ['key' => 'stat_santri', 'value' => '1.250+', 'group' => 'statistik'],
            ['key' => 'stat_asatidz', 'value' => '68', 'group' => 'statistik'],
            ['key' => 'stat_alumni', 'value' => '4.800+', 'group' => 'statistik'],
            ['key' => 'stat_lembaga', 'value' => '4 Satuan', 'group' => 'statistik'],

            ['key' => 'sambutan_nama', 'value' => 'K.H. Ahmad Mubarok, M.Pd.I', 'group' => 'sambutan'],
            ['key' => 'sambutan_jabatan', 'value' => 'Pimpinan Pondok Pesantren', 'group' => 'sambutan'],
            ['key' => 'sambutan_foto', 'value' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80', 'group' => 'sambutan'],
            ['key' => 'sambutan_teks', 'value' => 'Assalamu’alaikum Warahmatullahi Wabarakatuh. Alhamdulillah, Pondok Pesantren Miftahul Ulum Gunung Bubut terus berikhtiar mendidik tunas-tunas bangsa agar memiliki kedalaman spiritual, keluasan wawasan agama (tafaqquh fiddin), serta kesiapan menghadapi tantangan zaman melalui integrasi pendidikan formal MTs dan SMK.', 'group' => 'sambutan'],

            // Visi Misi
            ['key' => 'visi', 'value' => 'Terwujudnya Generasi Santri yang Berakhlakul Karimah, Unggul dalam Ilmu Agama, Cerdas dalam Sains & Teknologi, serta Berdaya Saing Mandiri untuk Kemaslahatan Umat.', 'group' => 'profil'],
            ['key' => 'misi', 'value' => "1. Menyelenggarakan pengajian kitab kuning secara istiqomah dengan sanad keilmuan yang muktabar.\n2. Mendidik akhlak dan adab mulia melalui keteladanan Dewan Masayikh dan Asatidz.\n3. Mengembangkan pendidikan formal MTs & SMK dengan keunggulan vokasi dan literasi digital masa depan.\n4. Membina kemandirian ekonomi santri melalui ketrampilan wirausaha.", 'group' => 'profil'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // 3. Categories
        $catArtikel = Category::firstOrCreate(['slug' => 'artikel'], [
            'nama' => 'Artikel',
            'badge_class' => 'bg-emerald-100 text-emerald-800'
        ]);

        $catEven = Category::firstOrCreate(['slug' => 'even'], [
            'nama' => 'Even',
            'badge_class' => 'bg-amber-100 text-amber-800'
        ]);

        $catKegiatan = Category::firstOrCreate(['slug' => 'kegiatan-santri'], [
            'nama' => 'Kegiatan Santri',
            'badge_class' => 'bg-blue-100 text-blue-800'
        ]);

        // 4. Articles
        $articles = [
            [
                'category_id' => $catArtikel->id,
                'user_id' => $admin->id,
                'judul' => 'Menjaga Sanad Keilmuan dan Akhlak di Era Disrupsi Digital',
                'slug' => 'menjaga-sanad-keilmuan-dan-akhlak-di-era-disrupsi-digital',
                'ringkasan' => 'Kajian mendalam tentang pentingnya ketawadhu\'an santri dalam menuntut ilmu dan memegang teguh sanad para ulama salaf di tengah arus media sosial.',
                'konten' => '<p>Pendidikan pesantren sejak berabad-abad silam telah meletakkan pondasi bahwa <em>"Al-Ilmu Nurun"</em> (ilmu adalah cahaya) dan ilmu tidak akan didapat secara hakiki melainkan dengan adab, ketulusan niat, dan keterikatan sanad yang bersambung kepada Rasulullah SAW.</p><p>Di era kecerdasan buatan dan dunia serba cepat, santri Pondok Pesantren Miftahul Ulum Gunung Bubut dituntut cerdas memanfaatkan teknologi sebagai washilah dakwah amar ma\'ruf nahi munkar, tanpa pernah meninggalkan tradisi mulia ta\'dzim kepada guru dan ketekunan muthala\'ah kitab kuning.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3edd4?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'K.H. Ahmad Mubarok, M.Pd.I',
                'tanggal_publikasi' => '2026-10-18',
                'tag' => 'Tsaqofah Islamiyah',
                'status' => 'published',
            ],
            [
                'category_id' => $catArtikel->id,
                'user_id' => $admin->id,
                'judul' => 'Fiqih Muamalah: Keberkahan Transaksi Syariah dalam Wirausaha Santri',
                'slug' => 'fiqih-muamalah-keberkahan-transaksi-syariah-dalam-wirausaha-santri',
                'ringkasan' => 'Memahami prinsip dasar permodalan syirkah, mudharabah, dan kejujuran akad dalam membangun kemandirian ekonomi pesantren dan para alumni.',
                'konten' => '<p>Kemandirian pesantren adalah cita-cita luhur para masayikh. Dalam Fiqih Fathul Qorib dan Fathul Wahhab, bab jual beli (buyu\') mengajarkan etika tertinggi dalam berbisnis: tidak ada gharar, tidak ada riba, dan mengutamakan ridho antar pihak.</p><p>Melalui pembinaan SMK Kejuruan dan koperasi pondok, santri Miftahul Ulum dibekali keterampilan nyata agar mampu menjadi pelaku usaha yang amanah dan mandiri.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Ustadz Lukman Hakim, S.Sos',
                'tanggal_publikasi' => '2026-10-12',
                'tag' => 'Fiqih & Ekonomi Syariah',
                'status' => 'published',
            ],
            [
                'category_id' => $catEven->id,
                'user_id' => $admin->id,
                'judul' => 'Peringatan Hari Santri Nasional 2026 & Tabligh Akbar',
                'slug' => 'peringatan-hari-santri-nasional-2026-tabligh-akbar',
                'ringkasan' => 'Upacara bendera Hari Santri, kirab santri sejauh 5 km, festival hadroh antar pesantren se-Tasikmalaya Selatan, dan Tabligh Akbar bersama Dewan Masayikh.',
                'konten' => '<p>Rangkaian peringatan Hari Santri Nasional berlangsung khidmat di Lapangan Kompleks Ponpes Miftahul Ulum Gunung Bubut. Dihadiri ribuan santri putra dan putri, para wali santri, alumni, serta tokoh masyarakat Sodonghilir.</p><p>Momentum ini meneguhkan peran santri sebagai pilar keutuhan NKRI dan penjaga nilai-nilai moral kebangsaan.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1519817650390-64a93db51149?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Panitia HSN Gunung Bubut',
                'tanggal_publikasi' => '2026-10-22',
                'tag' => 'Agenda Akbar',
                'status' => 'published',
            ],
            [
                'category_id' => $catEven->id,
                'user_id' => $admin->id,
                'judul' => 'Haul Masyayikh & Silaturahmi Akbar Alumni (IKAMU) Ke-41',
                'slug' => 'haul-masyayikh-silaturahmi-akbar-alumni-ikamu-ke-41',
                'ringkasan' => 'Doa bersama mengenang jasa muassis KH. Zaenal Abidin dan temu akrab lintas angkatan santri Miftahul Ulum di Kompleks Pesantren.',
                'konten' => '<p>Haul Masyayikh merupakan agenda tahunan yang menyatukan ribuan alumni yang tersebar di berbagai pelosok Nusantara.</p><p>Dimulai dengan Khotmil Qur\'an 30 juz bil ghoib, tahlil akbar di makbaroh masyayikh, serta peluncuran program Beasiswa Santri Berprestasi dari Ikatan Alumni Miftahul Ulum (IKAMU).</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Sekretariat Ponpes',
                'tanggal_publikasi' => '2026-11-15',
                'tag' => 'Haul & Alumni',
                'status' => 'published',
            ],
            [
                'category_id' => $catKegiatan->id,
                'user_id' => $admin->id,
                'judul' => 'Lalaran Nadzom Alfiyah Ibnu Malik & Imrithi Setiap Malam Rabu',
                'slug' => 'lalaran-nadzom-alfiyah-ibnu-malik-imrithi-setiap-malam-rabu',
                'ringkasan' => 'Menghidupkan tradisi hafalan bait-bait nahwu sharaf dengan irama khas pesantren yang memperkaya pemahaman tata bahasa Arab santri.',
                'konten' => '<p>Gema ribuan suara santri melantunkan bait Alfiyah Ibnu Malik memecah keheningan malam di Gunung Bubut. Kegiatan lalaran ini bukan sekadar menghafal kaidah nahwu, melainkan sarana mengasah kecerdasan berpikir, daya ingat, serta kekompakan spiritual santri dalam mencintai bahasa Al-Qur\'an.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Pengurus Bahasa & Ta\'lim',
                'tanggal_publikasi' => '2026-10-05',
                'tag' => 'Tradisi Salaf',
                'status' => 'published',
            ],
            [
                'category_id' => $catKegiatan->id,
                'user_id' => $admin->id,
                'judul' => 'Latihan Rutin Khitobah (Muhadhoroh 3 Bahasa: Arab, Inggris, Indonesia)',
                'slug' => 'latihan-rutin-khitobah-muhadhoroh-3-bahasa',
                'ringkasan' => 'Santri digembleng menjadi dai penerang umat melalui panggung pidato mingguan di asrama putra dan putri.',
                'konten' => '<p>Mental tampil di muka umum dipupuk sejak dini di Pesantren Miftahul Ulum. Setiap malam Kamis, setiap kamar mengutus juru bicaranya untuk berpidato dalam bahasa Arab, Inggris, dan Indonesia.</p><p>Santri belajar teknik retorika, penyusunan materi dakwah, serta adab penyampaian yang santun dan memikat hati.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Lembaga Pengembangan Bahasa',
                'tanggal_publikasi' => '2026-09-28',
                'tag' => 'Pengembangan Diri',
                'status' => 'published',
            ],
        ];

        foreach ($articles as $a) {
            Article::updateOrCreate(['slug' => $a['slug']], $a);
        }

        // 5. Masayikh
        $masayikhData = [
            [
                'nama' => 'K.H. Zaenal Abidin (Alm.)',
                'gelar' => 'Muassis / Pendiri Pondok Pesantren',
                'peran' => 'Muassis (Pendiri)',
                'deskripsi' => 'Perintis dan peletak pondasi dasar dakwah, pendidikan salafiyah, dan pembinaan akhlak santri di Gunung Bubut Pakalongan Sodonghilir.',
                'foto' => 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=600&q=80',
                'urutan' => 1,
            ],
            [
                'nama' => 'K.H. Ahmad Mubarok, M.Pd.I',
                'gelar' => 'Pimpinan Umum Pondok Pesantren',
                'peran' => 'Pimpinan Utama',
                'deskripsi' => 'Mengasuh dan memimpin arah pengembangan keilmuan pesantren perpaduan kurikulum salaf dengan kemajuan pendidikan formal kejuruan.',
                'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
                'urutan' => 2,
            ],
            [
                'nama' => 'K.H. Syamsul Hidayat, Lc.',
                'gelar' => 'Dewan Pengasuh & Kajian Kitab Kuning',
                'peran' => 'Pengasuh Pengajian Kitab',
                'deskripsi' => 'Pakar ilmu Nahwu, Sharaf, Fiqh, dan Ushul Fiqh. Pengampu kajian kitab Fathul Qorib, Fathul Mu\'in, dan Ihya Ulumiddin.',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80',
                'urutan' => 3,
            ],
            [
                'nama' => 'Nyai Hj. Siti Fatimah, S.Pd.I',
                'gelar' => 'Ketua Pengasuh Asrama Putri',
                'peran' => 'Pengasuh Asrama Putri',
                'deskripsi' => 'Membina keteladanan santriwati, ketrampilan keputrian, pembinaan akhlak karimah, serta penanggung jawab tahfidz Al-Qur\'an santri putri.',
                'foto' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80',
                'urutan' => 4,
            ],
        ];

        foreach ($masayikhData as $m) {
            Masayikh::updateOrCreate(['nama' => $m['nama']], $m);
        }

        // 6. Asrama
        Asrama::updateOrCreate(
            ['tipe' => 'putra'],
            [
                'nama' => 'Kompleks Asrama Putra (Darul Muttaqin)',
                'kapasitas' => '650 Santri',
                'jumlah_kamar' => '36 Kamar Asrama Terbagi dalam 4 Blok',
                'pembina' => 'Ustadz Lukman Hakim, S.Sos & Tim Mudabbir Santri',
                'foto' => 'https://images.unsplash.com/photo-1584697964190-705b893683f1?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Kompleks hunian santri putra didesain untuk menumbuhkan solidaritas, kedisiplinan sholat berjamaah, kemandirian, serta memfasilitasi mudzakarah kitab kuning.',
                'fasilitas' => [
                    'Kamar hunian berlantai keramik bersih dan ventilasi asri',
                    'Masjid Jami\' pusat ibadah sholat berjamaah & pengajian bandongan',
                    'Kamar mandi terpadu dengan sanitasi modern dan air pegunungan alami',
                    'Perpustakaan kitab kuning dan buku literasi umum',
                    'Kantin santri higienis dan koperasi pesantren',
                    'Lapangan olahraga (Futsal, Badminton, Tenis Meja, Voli)',
                    'Area jemuran representatif & tempat cuci pakaian',
                    'Pengawasan keamanan 24 jam dengan sistem kepengurusan santri senior',
                ],
            ]
        );

        Asrama::updateOrCreate(
            ['tipe' => 'putri'],
            [
                'nama' => 'Kompleks Asrama Putri (Darul Khadijah)',
                'kapasitas' => '600 Santriwati',
                'jumlah_kamar' => '32 Kamar Asrama dalam Kompleks Khusus Berpagar',
                'pembina' => 'Ustadzah Nurul Inayah, S.Ag & Tim Mudabbirah Santriwati',
                'foto' => 'https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=800&q=80',
                'deskripsi' => 'Kompleks asrama putri terpisah secara mandiri dalam pagar khusus yang menjaga ketat privasi santriwati dengan bimbingan tahfidz dan keputrian.',
                'fasilitas' => [
                    'Kompleks asrama tertutup yang terjaga privasi dan keamanannya',
                    'Musholla putri untuk sholat berjamaah, sorogan & rotibul haddad',
                    'Dapur santriwati dan ruang makan bersih',
                    'Ruang belajar dan diskusi kelompok santriwati',
                    'Layanan kesehatan santriwati (Poskestren Putri)',
                    'Koperasi keputrian santriwati',
                    'Kamar mandi memadai dengan pasokan air bersih melimpah',
                    'Aktivitas bimbingan tata boga, menjahit, kaligrafi & hadroh putri',
                ],
            ]
        );

        // 7. Jadwal Harian
        $jadwals = [
            ['waktu' => '03.30 - 04.30', 'kegiatan' => 'Qiyamul Lail, Dzikir Pagi & Sholat Shubuh Berjamaah', 'urutan' => 1],
            ['waktu' => '04.45 - 06.00', 'kegiatan' => 'Pengajian Kitab Kuning Ba\'da Shubuh (Sorogan/Bandongan)', 'urutan' => 2],
            ['waktu' => '06.00 - 06.45', 'kegiatan' => 'Makan Pagi, Mandi, & Persiapan Menuju Sekolah Formal', 'urutan' => 3],
            ['waktu' => '07.00 - 13.30', 'kegiatan' => 'Pendidikan Formal di MTs & SMK Miftahul Ulum', 'urutan' => 4],
            ['waktu' => '13.30 - 14.30', 'kegiatan' => 'Sholat Dzuhur Berjamaah, Makan Siang & Istirahat', 'urutan' => 5],
            ['waktu' => '14.30 - 15.15', 'kegiatan' => 'Istirahat Siang / Mengulang Pelajaran (Muthala\'ah)', 'urutan' => 6],
            ['waktu' => '15.15 - 16.30', 'kegiatan' => 'Sholat Ashar Berjamaah dilanjutkan Setoran Hafalan Al-Qur\'an', 'urutan' => 7],
            ['waktu' => '16.30 - 17.30', 'kegiatan' => 'Olahraga Sore, Kebersihan Lingkungan (Ro\'an), Mandi', 'urutan' => 8],
            ['waktu' => '17.45 - 19.30', 'kegiatan' => 'Sholat Maghrib Berjamaah, Dzikir & Pembacaan Nadzom / Mujahadah', 'urutan' => 9],
            ['waktu' => '19.30 - 20.30', 'kegiatan' => 'Sholat Isya Berjamaah dilanjutkan Pengajian Ba\'da Isya', 'urutan' => 10],
            ['waktu' => '20.30 - 22.00', 'kegiatan' => 'Belajar Mandiri, Lalaran Kitab / Muhadhoroh & Absensi Malam', 'urutan' => 11],
            ['waktu' => '22.00 - 03.30', 'kegiatan' => 'Istirahat Malam (Jam Wajib Tidur)', 'urutan' => 12],
        ];

        foreach ($jadwals as $j) {
            JadwalHarian::updateOrCreate(['urutan' => $j['urutan']], $j);
        }

        // 8. Pendidikan Formal
        PendidikanFormal::updateOrCreate(
            ['kode' => 'mts'],
            [
                'nama' => 'MTs Miftahul Ulum Gunung Bubut',
                'npsn' => '20278561',
                'akreditasi' => 'Terakreditasi A (Unggul)',
                'jenjang' => 'Madrasah Tsanawiyah (Setingkat SMP)',
                'kepala_sekolah' => 'Drs. H. Mamat Rohimat, M.M.',
                'deskripsi' => 'Pendidikan tingkat menengah pertama berbasis kurikulum Kementerian Agama RI yang dipadukan secara harmonis dengan penguatan karakter salaf, tahfidz juz amma, dan literasi digital.',
                'foto' => 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=800&q=80',
                'keunggulan' => [
                    'Kurikulum terpadu Kemenag, Kemendikbud & Kepesantrenan',
                    'Program Pembiasaan Bahasa Arab dan Bahasa Inggris harian',
                    'Kelas Tahfidz Al-Qur\'an terbimbing',
                    'Laboratorium Komputer dan Laboratorium IPA terstandar',
                    'Bebas SPP bagi santri yatim dan dhuafa berprestasi',
                    'Bimbingan Olimpiade Sains Madrasah (KSM)',
                ],
                'ekskul' => [
                    'Pramuka Gugus Depan',
                    'PMR (Palang Merah Remaja)',
                    'Paskibra',
                    'Seni Rebana / Hadroh',
                    'Kaligrafi Islam',
                    'English & Arabic Club',
                    'Pencak Silat Pagar Nusa',
                ],
                'jurusan' => [],
            ]
        );

        PendidikanFormal::updateOrCreate(
            ['kode' => 'smk'],
            [
                'nama' => 'SMK Miftahul Ulum Gunung Bubut',
                'npsn' => '20278562',
                'akreditasi' => 'Terakreditasi B / Menuju A',
                'jenjang' => 'Sekolah Menengah Kejuruan (Setingkat SMA/MA)',
                'kepala_sekolah' => 'H. Cecep Wahyudin, S.T., M.Kom.',
                'deskripsi' => 'Mencetak lulusan santri siap kerja, wirausahawan mandiri, dan berakhlak Qur\'ani yang menguasai keahlian teknologi dan vokasi masa depan.',
                'foto' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=800&q=80',
                'keunggulan' => [
                    'Sertifikasi Kompetensi BNSP & Kerjasama Industri (Link & Match)',
                    'Peluang magang di perusahaan teknologi & industri terkemuka',
                    'Inkubator Bisnis Santri Technopreneurship',
                    'Peluang beasiswa kuliah ke perguruan tinggi negeri & swasta',
                    'Pendidikan vokasi yang tetap berjiwa santri salaf',
                ],
                'ekskul' => [
                    'IT Club & Coding Squad',
                    'Robotika',
                    'Desain Grafis & Multimedia',
                    'Pramuka Penegak',
                    'Otomotif Workshop',
                    'Kewirausahaan Santri',
                ],
                'jurusan' => [
                    [
                        'kode' => 'TKJ',
                        'nama' => 'Teknik Komputer & Jaringan',
                        'deskripsi' => 'Fokus keahlian instalasi jaringan fiber optik, administrasi server Linux/Mikrotik, cloud computing, dan perakitan hardware komputer.',
                    ],
                    [
                        'kode' => 'RPL',
                        'nama' => 'Rekayasa Perangkat Lunak (Software Engineering)',
                        'deskripsi' => 'Fokus pengembangan aplikasi web, mobile Android, basis data SQL, dan perancangan UI/UX berbasis teknologi modern.',
                    ],
                    [
                        'kode' => 'TBSM',
                        'nama' => 'Teknik Bisnis Sepeda Motor',
                        'deskripsi' => 'Fokus keahlian mekanik mesin otomotif roda dua, sistem injeksi digital, kelistrikan kendaraan, dan manajemen bengkel.',
                    ],
                ],
            ]
        );
    }
}
