/**
 * Data Store for Pondok Pesantren Miftahul Ulum Gunung Bubut
 */

const PesantrenData = {
  info: {
    nama: "Pondok Pesantren Miftahul Ulum",
    julukan: "Gunung Bubut",
    motto: "Berakhlakul Karimah, Unggul dalam Ilmu Agama, Terdepan dalam Teknologi",
    alamat: "Jl. KHZ Abidin, Kp. Gunungbubut, Desa Pakalongan, Kec. Sodonghilir, Kab. Tasikmalaya, Jawa Barat 46473",
    telepon: "+62 821-2345-6789",
    whatsapp: "6282123456789",
    email: "info@miftahululumgunungbubut.sch.id",
    mapsUrl: "https://maps.google.com/?q=Gunungbubut+Pakalongan+Sodonghilir+Tasikmalaya",
    tahunBerdiri: "1985",
    statistik: {
      santri: "1.250+",
      asatidz: "68",
      alumni: "4.800+",
      lembaga: "4 Satuan"
    }
  },

  masayikh: [
    {
      id: 1,
      nama: "K.H. Zaenal Abidin (Alm.)",
      gelar: "Muassis / Pendiri Pondok Pesantren",
      deskripsi: "Perintis dan peletak pondasi dasar dakwah, pendidikan salafiyah, dan pembinaan akhlak santri di Gunung Bubut Pakalongan Sodonghilir.",
      image: "https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=600&q=80",
      peran: "Muassis (Pendiri)"
    },
    {
      id: 2,
      nama: "K.H. Ahmad Mubarok, M.Pd.I",
      gelar: "Pimpinan Umum Pondok Pesantren",
      deskripsi: "Mengasuh dan memimpin arah pengembangan keilmuan pesantren perpaduan kurikulum salaf dengan kemajuan pendidikan formal kejuruan.",
      image: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80",
      peran: "Pimpinan Utama"
    },
    {
      id: 3,
      nama: "K.H. Syamsul Hidayat, Lc.",
      gelar: "Dewan Pengasuh & Kajian Kitab Kuning",
      deskripsi: "Pakar ilmu Nahwu, Sharaf, Fiqh, dan Ushul Fiqh. Pengampu kajian kitab Fathul Qorib, Fathul Mu'in, dan Ihya Ulumiddin.",
      image: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=600&q=80",
      peran: "Pengasuh Pengajian Kitab"
    },
    {
      id: 4,
      nama: "Nyai Hj. Siti Fatimah, S.Pd.I",
      gelar: "Ketua Pengasuh Asrama Putri",
      deskripsi: "Membina keteladanan santriwati, ketrampilan keputrian, pembinaan akhlak karimah, serta penanggung jawab tahfidz Al-Qur'an santri putri.",
      image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80",
      peran: "Pengasuh Asrama Putri"
    }
  ],

  asrama: {
    putra: {
      nama: "Kompleks Asrama Putra (Darul Muttaqin)",
      kapasitas: "650 Santri",
      kamar: "36 Kamar Asrama Terbagi dalam 4 Blok",
      fasilitas: [
        "Kamar hunian berlantai keramik bersih dan ventilasi asri",
        "Masjid Jami' pusat ibadah sholat berjamaah & pengajian bandongan",
        "Kamar mandi terpadu dengan sanitasi modern dan air pegunungan alami",
        "Perpustakaan kitab kuning dan buku literasi umum",
        "Kantin santri higienis dan koperasi pesantren",
        "Lapangan olahraga (Futsal, Badminton, Tenis Meja, Voli)",
        "Area jemuran representatif & tempat cuci pakaian",
        "Pengawasan keamanan 24 jam dengan sistem kepengurusan santri senior"
      ],
      pembina: "Ustadz Lukman Hakim, S.Sos & Tim Mudabbir Santri",
      image: "https://images.unsplash.com/photo-1584697964190-705b893683f1?auto=format&fit=crop&w=800&q=80"
    },
    putri: {
      nama: "Kompleks Asrama Putri (Darul Khadijah)",
      kapasitas: "600 Santriwati",
      kamar: "32 Kamar Asrama dalam Kompleks Khusus Berpagar",
      fasilitas: [
        "Kompleks asrama tertutup yang terjaga privasi dan keamanannya",
        "Musholla putri untuk sholat berjamaah, sorogan & rotibul haddad",
        "Dapur santriwati dan ruang makan bersih",
        "Ruang belajar dan diskusi kelompok santriwati",
        "Layanan kesehatan santriwati (Poskestren Putri)",
        "Koperasi keputrian santriwati",
        "Kamar mandi memadai dengan pasokan air bersih melimpah",
        "Aktivitas bimbingan tata boga, menjahit, kaligrafi & hadroh putri"
      ],
      pembina: "Ustadzah Nurul Inayah, S.Ag & Tim Mudabbirah Santriwati",
      image: "https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=800&q=80"
    },
    jadwalHarian: [
      { waktu: "03.30 - 04.30", kegiatan: "Qiyamul Lail, Dzikir Pagi & Sholat Shubuh Berjamaah" },
      { waktu: "04.45 - 06.00", kegiatan: "Pengajian Kitab Kuning Ba'da Shubuh (Sorogan/Bandongan)" },
      { waktu: "06.00 - 06.45", kegiatan: "Makan Pagi, Mandi, & Persiapan Menuju Sekolah Formal" },
      { waktu: "07.00 - 13.30", kegiatan: "Pendidikan Formal di MTs & SMK Miftahul Ulum" },
      { waktu: "13.30 - 14.30", kegiatan: "Sholat Dzuhur Berjamaah, Makan Siang & Istirahat" },
      { waktu: "14.30 - 15.15", kegiatan: "Istirahat Siang / Mengulang Pelajaran (Muthala'ah)" },
      { waktu: "15.15 - 16.30", kegiatan: "Sholat Ashar Berjamaah dilanjutkan Setoran Hafalan Al-Qur'an" },
      { waktu: "16.30 - 17.30", kegiatan: "Olahraga Sore, Kebersihan Lingkungan (Ro'an), Mandi" },
      { waktu: "17.45 - 19.30", kegiatan: "Sholat Maghrib Berjamaah, Dzikir & Pembacaan Nadzom / Mujahadah" },
      { waktu: "19.30 - 20.30", kegiatan: "Sholat Isya Berjamaah dilanjutkan Pengajian Ba'da Isya" },
      { waktu: "20.30 - 22.00", kegiatan: "Belajar Mandiri, Lalaran Kitab / Muhadhoroh & Absensi Malam" },
      { waktu: "22.00 - 03.30", kegiatan: "Istirahat Malam (Jam Wajib Tidur)" }
    ]
  },

  pendidikanFormal: {
    mts: {
      nama: "MTs Miftahul Ulum Gunung Bubut",
      npsn: "20278561",
      akreditasi: "Terakreditasi A (Unggul)",
      jenjang: "Madrasah Tsanawiyah (Setingkat SMP)",
      kepalaSekolah: "Drs. H. Mamat Rohimat, M.M.",
      deskripsi: "Pendidikan tingkat menengah pertama berbasis kurikulum Kementerian Agama RI yang dipadukan secara harmonis dengan penguatan karakter salaf, tahfidz juz amma, dan literasi digital.",
      keunggulan: [
        "Kurikulum terpadu Kemenag, Kemendikbud & Kepesantrenan",
        "Program Pembiasaan Bahasa Arab dan Bahasa Inggris harian",
        "Kelas Tahfidz Al-Qur'an terbimbing",
        "Laboratorium Komputer dan Laboratorium IPA terstandar",
        "Bebas SPP bagi santri yatim dan dhuafa berprestasi",
        "Bimbingan Olimpiade Sains Madrasah (KSM)"
      ],
      ekskul: ["Pramuka Gugus Depan", "PMR (Palang Merah Remaja)", "Paskibra", "Seni Rebana / Hadroh", "Kaligrafi Islam", "English & Arabic Club", "Pencak Silat Pagar Nusa"]
    },
    smk: {
      nama: "SMK Miftahul Ulum Gunung Bubut",
      npsn: "20278562",
      akreditasi: "Terakreditasi B / Menuju A",
      jenjang: "Sekolah Menengah Kejuruan (Setingkat SMA/MA)",
      kepalaSekolah: "H. Cecep Wahyudin, S.T., M.Kom.",
      deskripsi: "Mencetak lulusan santri siap kerja, wirausahawan mandiri, dan berakhlak Qur'ani yang menguasai keahlian teknologi dan vokasi masa depan.",
      jurusan: [
        {
          kode: "TKJ",
          nama: "Teknik Komputer & Jaringan",
          deskripsi: "Fokus keahlian instalasi jaringan fiber optik, administrasi server Linux/Mikrotik, cloud computing, dan perakitan hardware komputer."
        },
        {
          kode: "RPL",
          nama: "Rekayasa Perangkat Lunak (Software Engineering)",
          deskripsi: "Fokus pengembangan aplikasi web, mobile Android, basis data SQL, dan perancangan UI/UX berbasis teknologi modern."
        },
        {
          kode: "TBSM",
          nama: "Teknik Bisnis Sepeda Motor",
          deskripsi: "Fokus keahlian mekanik mesin otomotif roda dua, sistem injeksi digital, kelistrikan kendaraan, dan manajemen bengkel."
        }
      ],
      keunggulan: [
        "Sertifikasi Kompetensi BNSP & Kerjasama Industri (Link & Match)",
        "Peluang magang di perusahaan teknologi & industri terkemuka",
        "Inkubator Bisnis Santri Technopreneurship",
        "Peluang beasiswa kuliah ke perguruan tinggi negeri & swasta",
        "Pendidikan vokasi yang tetap berjiwa santri salaf"
      ],
      ekskul: ["IT Club & Coding Squad", "Robotika", "Desain Grafis & Multimedia", "Pramuka Penegak", "Otomotif Workshop", "Kewirausahaan Santri"]
    }
  },

  publikasi: [
    {
      id: "art-1",
      kategori: "Artikel",
      kategoriBadge: "bg-emerald-100 text-emerald-800",
      judul: "Menjaga Sanad Keilmuan dan Akhlak di Era Disrupsi Digital",
      penulis: "K.H. Ahmad Mubarok, M.Pd.I",
      tanggal: "18 Oktober 2026",
      ringkasan: "Kajian mendalam tentang pentingnya ketawadhu'an santri dalam menuntut ilmu dan bagaimana memegang teguh sanad keilmuan para ulama salaf di tengah derasnya arus informasi media sosial.",
      isi: "Pendidikan pesantren sejak berabad-abad silam telah meletakkan pondasi bahwa 'Al-Ilmu Nurun' (ilmu adalah cahaya) dan ilmu tidak akan didapat secara hakiki melainkan dengan adab, ketulusan niat, dan keterikatan sanad yang tersambung kepada Rasulullah SAW. Di era kecerdasan buatan dan dunia digital, santri Pondok Pesantren Miftahul Ulum Gunung Bubut dituntut cerdas memanfaatkan teknologi sebagai washilah dakwah amar ma'ruf nahi munkar, tanpa pernah meninggalkan tradisi mulia ta'dzim kepada guru dan ketekunan muthala'ah kitab kuning.",
      gambar: "https://images.unsplash.com/photo-1532012164546-f432f2e3edd4?auto=format&fit=crop&w=800&q=80",
      tag: "Tsaqofah Islamiyah"
    },
    {
      id: "art-2",
      kategori: "Artikel",
      kategoriBadge: "bg-emerald-100 text-emerald-800",
      judul: "Fiqih Muamalah: Keberkahan Transaksi Syariah dalam Wirausaha Santri",
      penulis: "Ustadz Lukman Hakim, S.Sos",
      tanggal: "12 Oktober 2026",
      ringkasan: "Memahami prinsip dasar permodalan syirkah, mudharabah, dan kejujuran akad dalam membangun kemandirian ekonomi pesantren dan para alumni.",
      isi: "Kemandirian pesantren adalah cita-cita luhur para masayikh. Dalam Fiqih Fathul Qorib dan Fathul Wahhab, bab jual beli (buyu') mengajarkan etika tertinggi dalam berbisnis: tidak ada gharar, tidak ada riba, dan mengutamakan ridho antar pihak. Melalui pembinaan SMK Kejuruan dan koperasi pondok, santri Miftahul Ulum dibekali keterampilan nyata agar mampu menjadi pelaku usaha yang amanah dan mandiri.",
      gambar: "https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80",
      tag: "Fiqih & Ekonomi Syariah"
    },
    {
      id: "ev-1",
      kategori: "Even",
      kategoriBadge: "bg-amber-100 text-amber-800",
      judul: "Peringatan Hari Santri Nasional 2026 & Tabligh Akbar",
      penulis: "Panitia HSN Gunung Bubut",
      tanggal: "22 Oktober 2026",
      ringkasan: "Upacara bendera Hari Santri, kirab santri sejauh 5 km, festival hadroh antar pesantren se-Tasikmalaya Selatan, dan Tabligh Akbar bersama Dewan Masayikh.",
      isi: "Rangkaian peringatan Hari Santri Nasional berlangsung khidmat di Lapangan Kompleks Ponpes Miftahul Ulum Gunung Bubut. Dihadiri ribuan santri putra dan putri, para wali santri, alumni, serta tokoh masyarakat Sodonghilir. Momentum ini meneguhkan peran santri sebagai pilar keutuhan NKRI dan penjaga nilai-nilai moral kebangsaan.",
      gambar: "https://images.unsplash.com/photo-1519817650390-64a93db51149?auto=format&fit=crop&w=800&q=80",
      tag: "Agenda Akbar"
    },
    {
      id: "ev-2",
      kategori: "Even",
      kategoriBadge: "bg-amber-100 text-amber-800",
      judul: "Haul Masyayikh & Silaturahmi Akbar Alumni (IKAMU) Ke-41",
      penulis: "Sekretariat Ponpes",
      tanggal: "15 November 2026",
      ringkasan: "Doa bersama mengenang jasa muassis KH. Zaenal Abidin dan temu akrab lintas angkatan santri Miftahul Ulum di Kompleks Pesantren.",
      isi: "Haul Masyayikh merupakan agenda tahunan yang menyatukan ribuan alumni yang tersebar di berbagai pelosok Nusantara. Dimulai dengan Khotmil Qur'an 30 juz bil ghoib, tahlil akbar di makbaroh masyayikh, serta peluncuran program Beasiswa Santri Berprestasi dari Ikatan Alumni Miftahul Ulum (IKAMU).",
      gambar: "https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=800&q=80",
      tag: "Haul & Alumni"
    },
    {
      id: "act-1",
      kategori: "Kegiatan Santri",
      kategoriBadge: "bg-blue-100 text-blue-800",
      judul: "Lalaran Nadzom Alfiyah Ibnu Malik & Imrithi Setiap Malam Rabu",
      penulis: "Pengurus Bahasa & Ta'lim",
      tanggal: "05 Oktober 2026",
      ringkasan: "Menghidupkan tradisi hafalan bait-bait nahwu sharaf dengan irama khas pesantren yang memperkaya pemahaman tata bahasa Arab santri.",
      isi: "Gema ribuan suara santri melantunkan bait Alfiyah Ibnu Malik memecah keheningan malam di Gunung Bubut. Kegiatan lalaran ini bukan sekadar menghafal kaidah nahwu, melainkan sarana mengasah kecerdasan berpikir, daya ingat, serta kekompakan spiritual santri dalam mencintai bahasa Al-Qur'an.",
      gambar: "https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=800&q=80",
      tag: "Tradisi Salaf"
    },
    {
      id: "act-2",
      kategori: "Kegiatan Santri",
      kategoriBadge: "bg-blue-100 text-blue-800",
      judul: "Latihan Rutin Khitobah (Muhadhoroh 3 Bahasa: Arab, Inggris, Indonesia)",
      penulis: "Lembaga Pengembangan Bahasa",
      tanggal: "28 September 2026",
      ringkasan: "Santri digembleng menjadi orator ulung dan dai penerang umat melalui panggung pidato mingguan di asrama putra dan putri.",
      isi: "Mental tampil di muka umum dipupuk sejak dini di Pesantren Miftahul Ulum. Setiap malam Kamis, setiap kamar mengutus juru bicaranya untuk berpidato dalam bahasa Arab, Inggris, dan Indonesia. Santri belajar teknik retorika, penyusunan materi dakwah, serta adab penyampaian yang santun dan memikat hati.",
      gambar: "https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=800&q=80",
      tag: "Pengembangan Diri"
    },
    {
      id: "act-3",
      kategori: "Kegiatan Santri",
      kategoriBadge: "bg-blue-100 text-blue-800",
      judul: "Ro'an Akbar: Tradisi Gotong Royong Kebersihan dan Kelestarian Pesantren",
      penulis: "Divisi Kebersihan & Kerapihan",
      tanggal: "21 September 2026",
      ringkasan: "Memupuk rasa memiliki dan kepedulian lingkungan melalui kerja bakti massal membersihkan kobong, masjid, dan taman pesantren.",
      isi: "Ro'an adalah filosofi kebersamaan khas pesantren. Santri membersihkan parit, menata kebun asrama, dan mengecat dinding fasilitas umum secara bergotong royong diiringi canda tawa dan lantunan sholawat. Dari tradisi ini tumbuh keikhlasan dan kecintaan pada kesucian lahir dan batin.",
      gambar: "https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=800&q=80",
      tag: "Karakter Santri"
    }
  ],

  testimoni: [
    {
      nama: "H. Ridwan Kamil, S.E.",
      status: "Wali Santri (Bandung)",
      teks: "Alhamdulillah putra kami tidak hanya pintar dalam urusan komputer di SMK Miftahul Ulum, tetapi juga tekun sholat tahajud dan hafal nadzom kitab kuning. Lingkungan asrama Gunung Bubut sangat menenangkan dan para asatidz begitu mengayomi.",
      rating: 5
    },
    {
      nama: "Fajar Maulana, S.Kom.",
      status: "Alumni SMK MU (Software Engineer di Jakarta)",
      teks: "Bekal akhlak dan kedisiplinan hidup mandiri di pondok Gunung Bubut menjadi modal terbesar saya berkarir di industri IT ibu kota. Terima kasih Miftahul Ulum!",
      rating: 5
    },
    {
      nama: "Hj. Endah Rohayati",
      status: "Wali Santriwati MTs (Tasikmalaya)",
      teks: "Putri saya sekarang lebih santun bicaranya, hapalan juz 30-nya tuntas, dan berprestasi di sekolah formal. Fasilitas asrama putri sangat aman dan terjaga.",
      rating: 5
    }
  ],

  alurPendaftaran: [
    {
      langkah: 1,
      judul: "Pendaftaran Online / Datang Langsung",
      deskripsi: "Mengisi formulir pendaftaran melalui website ini atau langsung ke Sekretariat PSB di Kantor Ponpes Miftahul Ulum Gunung Bubut."
    },
    {
      langkah: 2,
      judul: "Kelengkapan Berkas Administrasi",
      deskripsi: "Menyerahkan fotokopi KK, Akta Kelahiran, Ijazah/SKL terakhir, NISN, pas foto 3x4 (4 lembar), dan surat keterangan sehat."
    },
    {
      langkah: 3,
      judul: "Tes Pemetaan & Wawancara",
      deskripsi: "Tes membaca Al-Qur'an, pengetahuan agama dasar, wawancara kesiapan santri dan wali santri bersama Dewan Masayikh."
    },
    {
      langkah: 4,
      judul: "Daftar Ulang & Masuk Asrama",
      deskripsi: "Pemberian nomor induk santri (NIS), pembagian kamar asrama/kobong, penyerahan seragam, dan masa orientasi santri (Ta'aruf)."
    }
  ]
};
