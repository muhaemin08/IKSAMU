# Website & Sistem Manajemen Pondok Pesantren Miftahul Ulum Gunung Bubut (IKSAMU)

Aplikasi Web Dinamis berbasis **Laravel 12 & MySQL** dengan arsitektur visual elegan bernuansa Islami terinspirasi dari portal pesantren legendaris ([ppcipasung.com](https://ppcipasung.com/)).

Aplikasi telah dipindahkan dan dikonfigurasi penuh di:
```
C:\xampp\htdocs\IKSAMU
```

---

## 🌐 Cara Mengakses Aplikasi di Browser

Pastikan module **Apache** dan **MySQL** di XAMPP Control Panel dalam status **Running (Aktif)**.

1. **Halaman Publik / Landing Page:**
   - [http://localhost/IKSAMU](http://localhost/IKSAMU) atau [http://localhost/IKSAMU/public](http://localhost/IKSAMU/public)
   
2. **Halaman Login Admin & Penulis:**
   - [http://localhost/IKSAMU/public/login](http://localhost/IKSAMU/public/login)
   - (Atau klik ikon masuk di bar atas website)

---

## 🔑 Akun Login Bawaan (Default Credentials)

| Role | Alamat Email | Kata Sandi (Password) | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Super Admin** | `admin@miftahululum.sch.id` | `password` | Akses penuh: Setting Dasar, Kelola Artikel, Dewan Masayikh, Pendaftar PSB |
| **Penulis / Asatidz** | `penulis@miftahululum.sch.id` | `password` | Khusus mengelola, menulis, dan mengedit Artikel, Even, & Kegiatan Santri |

---

## 🛠️ Fitur-Fitur Aplikasi yang Telah Berfungsi

### 1. Landing Page Dinamis
- **Beranda:** Banner Hero Islami, Kaligrafi Bismillah, Statistik dinamis, Sambutan Pimpinan Pesantren, 4 Pilar, Dewan Masayikh, MTs & SMK MU, Warta terkini, dan Form Cepat PSB.
- **Tentang:** Profil, Visi & Misi, Sejarah perjalanan muassis (1985–sekarang), dan Dewan Masayikh.
- **Asrama:** Kompleks Asrama Putra (Darul Muttaqin) & Asrama Putri (Darul Khadijah), Fasilitas MCK air pegunungan, Jadwal 24 jam santri, dan Tata tertib.
- **Pendidikan Formal:** MTs Miftahul Ulum (Akreditasi A, Tahfidz) & SMK Miftahul Ulum (TKJ, RPL, TBSM), sinergi 3 kurikulum, dan ekstrakurikuler.
- **Publikasi:** Filter kategori (Artikel, Even, Kegiatan Santri), pencarian live, dan halaman baca artikel lengkap beserta hitungan pembaca (*views counter*).
- **PSB Online:** Alur 4 langkah, form pendaftaran santri baru yang tersimpan ke MySQL dan otomatis menghubungkan data ke WhatsApp panitia.
- **Kontak & Lokasi:** Alamat lengkap di Sodonghilir Tasikmalaya, Google Maps embed, form kirim pesan, dan floating WhatsApp.

### 2. Panel Admin (Backend Dashboard)
- **Ringkasan Statistik:** Total artikel, jumlah pembaca, pendaftar PSB baru, dan daftar publikasi terkini.
- **Setting Dasar Aplikasi:** Mengubah Nama Lembaga, Slogan, Logo, Teks Kaligrafi, Kontak (Telepon, WhatsApp, Email, Alamat), Link Google Maps, Media Sosial, Hero Banner, Statistik, Sambutan Pimpinan, serta Visi & Misi secara dinamis tanpa menyentuh kode.
- **Pengelolaan Artikel (WYSIWYG Visual Editor):** 
  - Rich text editor Quill (bold, italic, heading, bullet, list, quote, insert gambar).
  - Upload thumbnail gambar artikel.
  - Pilihan kategori dan status (Draft vs Published).
- **Pengelolaan Dewan Masayikh:** Tambah, edit, dan hapus foto serta profil asatidz/sesepuh.
- **Pengelolaan Pendaftar PSB:** Pantau pendaftar santri baru, update status (*Pending, Diverifikasi, Diterima, Ditolak*), dan tombol langsung chat WhatsApp ke wali santri.

---

## 🗄️ Basis Data MySQL

- **Nama Database:** `db_ponpes_gunungbubut`
- **Host / Port:** `127.0.0.1` : `3306`
- **User:** `root`
- **Password:** *(kosong)*
- File konfigurasi lingkungan berada di: `C:\xampp\htdocs\IKSAMU\.env`
