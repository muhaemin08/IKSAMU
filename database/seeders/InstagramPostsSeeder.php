<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class InstagramPostsSeeder extends Seeder
{
    public function run(): void
    {
        $catArtikel = Category::firstOrCreate(['slug' => 'artikel'], ['nama' => 'Artikel', 'badge_class' => 'bg-emerald-100 text-emerald-800']);
        $catEven = Category::firstOrCreate(['slug' => 'even'], ['nama' => 'Even', 'badge_class' => 'bg-amber-100 text-amber-800']);
        $catKegiatan = Category::firstOrCreate(['slug' => 'kegiatan-santri'], ['nama' => 'Kegiatan Santri', 'badge_class' => 'bg-blue-100 text-blue-800']);

        $posts = [
            [
                'category_id' => $catEven->id,
                'user_id' => 1,
                'judul' => 'Gema Hari Santri Nasional: Menyambung Juang Merengkuh Masa Depan Bersama Santri Miftahul Ulum',
                'slug' => 'gema-hari-santri-nasional-mediaiksamu',
                'ringkasan' => 'Dokumentasi perayaan Hari Santri Nasional bersama Pondok Pesantren Miftahul Ulum Gunungbubut (@mediaiksamu). Meneguhkan peran santri menjaga moral dan peradaban bangsa.',
                'konten' => '<p><strong>GUNUNGBUBUT, SODONGHILIR</strong> &mdash; <em>Bismillahirrohmanirrohim.</em> Memperingati momentum bersejarah <strong>Hari Santri Nasional</strong>, segenap keluarga besar Pondok Pesantren Miftahul Ulum Gunungbubut (MU GNB) menggelar rangkaian acara khidmat mulai dari apel santri bersarung, pembacaan naskah Resolusi Jihad, hingga doa bersama untuk keselamatan bangsa.</p><p>Santri masa kini tidak hanya tekun mengkaji kutubut turats (kitab kuning), melainkan juga berdiri di garis depan penguasaan sains dan teknologi melalui kurikulum terpadu MTs dan SMK Miftahul Ulum.</p><blockquote class="border-l-4 border-amber-500 pl-4 italic text-slate-700 bg-amber-50 p-3 rounded-r-xl">"Santri Siaga Jiwa Raga, Mengawal Moral Bangsa, dan Merengkuh Masa Depan Peradaban Dunia." &mdash; @mediaiksamu</blockquote><p>Dokumentasi foto dan video lengkap perayaan ini dapat disimak melalui akun resmi Instagram kami di <strong>@mediaiksamu</strong>.</p>',
                'thumbnail' => 'assets/images/hero-pesantren.jpg',
                'penulis' => 'Media IKSAMU (@mediaiksamu)',
                'tanggal_publikasi' => '2026-10-22',
                'tag' => 'HariSantri2026',
                'status' => 'published',
            ],
            [
                'category_id' => $catKegiatan->id,
                'user_id' => 1,
                'judul' => 'Wisata Ruhani: Ziarah Auliya Santri & Asatidz ke Makam Syekh Ja\'far Shadiq Garut',
                'slug' => 'wisata-ruhani-ziarah-auliya-syekh-jafar-shadiq-garut',
                'ringkasan' => 'Rombongan santri mukim Miftahul Ulum Gunungbubut menggelar ziarah makam waliyullah Syekh Ja\'far Shadiq guna bertabarruk dan napak tilas dakwah ulama salaf.',
                'konten' => '<p>Tradisi ziarah kubur para kekasih Allah SWT merupakan agenda rutin yang terus dijaga oleh Pondok Pesantren Miftahul Ulum Gunungbubut. Rombongan santri putra dan dewan asatidz melangsungkan ziarah ke makam <strong>Syekh Ja\'far Shadiq (Cibiuk, Garut)</strong>.</p><p>Kegiatan diawali dengan pembacaan Surat Yasin, Tahlil Akbar, serta Istighotsah bersama yang dipimpin langsung oleh asatidz pengasuh pondok. Suasana haru dan khusyuk menyelimuti seluruh santri saat melantunkan dzikir dan shalawat.</p><blockquote class="border-l-4 border-emerald-500 pl-4 italic text-slate-700 bg-emerald-50 p-3 rounded-r-xl">"Ziarah makam auliya bukan sekadar wisata, melainkan madrasah keteladanan agar hati kita senantiasa ingat akhirat dan meneladani ketulusan dakwah para ulama pendahulu." &mdash; Catatan Dokumentasi @mediaiksamu</blockquote><p>Semoga seluruh santri mendapatkan keberkahan ilmu dan keteguhan iman dalam menempuh tholabul \'ilmi di pondok pesantren.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Media IKSAMU (@mediaiksamu)',
                'tanggal_publikasi' => '2026-10-15',
                'tag' => 'ZiarahAuliya',
                'status' => 'published',
            ],
            [
                'category_id' => $catArtikel->id,
                'user_id' => 1,
                'judul' => 'Kajian Rutin Kitab Hidayatus Shibyan & Fasholatan: Menanamkan Pondasi Ibadah Santri',
                'slug' => 'kajian-rutin-kitab-hidayatus-shibyan-fasholatan-santri',
                'ringkasan' => 'Pengajian kitab tajwid Hidayatus Shibyan dan fiqih ibadah dasar yang diikuti santri MTs Miftahul Ulum setiap ba\'da shubuh di Masjid Jami\'.',
                'konten' => '<p>Di tengah sejuknya kabut pagi Gunungbubut, lantunan bait-bait <strong>Nadzom Hidayatus Shibyan</strong> berkumandang syahdu dari Masjid Jami\' Pesantren Miftahul Ulum. Kitab karya Syaikh Ahmad Al-Marzuqi ini menjadi rujukan utama santri pemula dalam memahami hukum-hukum tajwid Al-Qur\'an.</p><p>Metode sorogan dan bandongan yang diterapkan memungkinkan setiap santri dibimbing secara teliti dalam melafalkan makharijul huruf, hukum nun mati/tanwin, mim mati, hingga waqaf dan ibtida\'.</p><blockquote class="border-l-4 border-blue-500 pl-4 italic text-slate-700 bg-blue-50 p-3 rounded-r-xl">"Membaca Al-Qur\'an dengan tartil dan tajwid yang benar adalah kewajiban dasar setiap mukmin. Dari bait nadzom yang dihafal, terbitlah kefasihan membaca kalam ilahi." &mdash; Kajian Shubuh @mediaiksamu</blockquote>',
                'thumbnail' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3edd4?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Media IKSAMU (@mediaiksamu)',
                'tanggal_publikasi' => '2026-10-08',
                'tag' => 'KajianKitab',
                'status' => 'published',
            ],
            [
                'category_id' => $catKegiatan->id,
                'user_id' => 1,
                'judul' => 'Malam Mahabbah: Festival Hadroh Al-Banjari & Khitobah Santri Miftahul Ulum GNB',
                'slug' => 'malam-mahabbah-festival-hadroh-al-banjari-khitobah-mu-gnb',
                'ringkasan' => 'Semarak panggung kreasi santri setiap malam Jumat menampilkan lantunan sholawat rebana hadroh dan pidato da\'i cilik tiga bahasa.',
                'konten' => '<p>Malam Jumat di Pondok Pesantren Miftahul Ulum Gunungbubut selalu diwarnai kemeriahan spiritual. Grup hadroh santri putra melantunkan qashidah-qashidah pujian kepada Baginda Nabi Muhammad SAW dengan ketukan terbang khas Al-Banjari.</p><p>Selain hadroh, panggung muhadhoroh menampilkan da\'i-da\'i santri yang berpidato dalam bahasa Sunda, Indonesia, Arab, dan Inggris. Program ini melatih keberanian tampil di depan publik dan retorika dakwah sejak dini.</p><blockquote class="border-l-4 border-purple-500 pl-4 italic text-slate-700 bg-purple-50 p-3 rounded-r-xl">"Sholawat adalah penyejuk kalbu santri di perantauan, sedangkan muhadhoroh adalah kawah candradimuka calon da\'i penerang umat." &mdash; @mediaiksamu</blockquote>',
                'thumbnail' => 'https://images.unsplash.com/photo-1519817650390-64a93db51149?auto=format&fit=crop&w=800&q=80',
                'penulis' => 'Media IKSAMU (@mediaiksamu)',
                'tanggal_publikasi' => '2026-10-01',
                'tag' => 'HadrohSantri',
                'status' => 'published',
            ]
        ];

        foreach ($posts as $p) {
            Article::updateOrCreate(['slug' => $p['slug']], $p);
        }
    }
}
