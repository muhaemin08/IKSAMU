@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Calon Santri Baru (PSB) - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER BANNER -->
  <section class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-teal-950 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <span class="text-amber-400">Pendaftaran Santri Baru (PSB)</span>
      </div>
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">Formulir Pendaftaran Calon Santri Baru</h1>
          <p class="text-emerald-200 text-xs sm:text-sm mt-2 max-w-2xl leading-relaxed">
            Sistem Informasi Penerimaan Santri Baru (SIPENWARU) {{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum Gunung Bubut' }}. Lengkapi data di bawah ini untuk memulai registrasi.
          </p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-800/80 border border-emerald-700/80 rounded-2xl text-xs text-amber-300 font-bold self-center sm:self-auto shadow-sm">
          <i class="fa-solid fa-graduation-cap text-base"></i>
          <span>Tahun Ajaran 2026/2027</span>
        </div>
      </div>
    </div>
  </section>

  <!-- PETUNJUK & ALUR PENDAFTARAN -->
  <section class="py-10 bg-white border-b border-slate-200/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-2xl mx-auto mb-8">
        <span class="text-[11px] font-black tracking-widest text-emerald-800 uppercase bg-emerald-100 px-3.5 py-1 rounded-full">
          Alur Pendaftaran Santri Baru
        </span>
        <h2 class="text-xl sm:text-2xl font-extrabold text-emerald-950 mt-2">
          Tahapan Penerimaan Santri Baru
        </h2>
        <div class="islamic-divider"><i class="fa-solid fa-route text-amber-500"></i></div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 text-center space-y-2.5 hover:shadow-md transition-shadow">
          <div class="w-10 h-10 mx-auto rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-base shadow-sm">1</div>
          <h4 class="font-extrabold text-sm text-slate-900">Isi Formulir Lengkap</h4>
          <p class="text-xs text-slate-600 leading-relaxed">Isi formulir calon santri, orang tua/wali, serta pembiayaan di halaman ini.</p>
        </div>
        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 text-center space-y-2.5 hover:shadow-md transition-shadow">
          <div class="w-10 h-10 mx-auto rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-base shadow-sm">2</div>
          <h4 class="font-extrabold text-sm text-slate-900">Simpan & Kirim WA</h4>
          <p class="text-xs text-slate-600 leading-relaxed">Data otomatis tersimpan ke database admin. Konfirmasi bukti ke WhatsApp panitia.</p>
        </div>
        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 text-center space-y-2.5 hover:shadow-md transition-shadow">
          <div class="w-10 h-10 mx-auto rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-base shadow-sm">3</div>
          <h4 class="font-extrabold text-sm text-slate-900">Tes Baca Qur'an</h4>
          <p class="text-xs text-slate-600 leading-relaxed">Uji pemetaan membaca Al-Qur'an dan wawancara kesiapan santri serta wali.</p>
        </div>
        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 text-center space-y-2.5 hover:shadow-md transition-shadow">
          <div class="w-10 h-10 mx-auto rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-base shadow-sm">4</div>
          <h4 class="font-extrabold text-sm text-slate-900">Masuk Kobong / Asrama</h4>
          <p class="text-xs text-slate-600 leading-relaxed">Penetapan asrama santri mukim dan pembekalan orientasi Khutbatul Iftitah.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FORMULIR PENDAFTARAN UTAMA -->
  <section class="py-12 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

      @if(session('success'))
        <!-- KARTU SUKSES PENDAFTARAN -->
        <div class="mb-10 p-6 sm:p-8 rounded-3xl bg-emerald-50 border-2 border-emerald-500 shadow-xl space-y-6">
          <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-3xl shrink-0 shadow-md">
              <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
              <span class="text-[10px] font-black uppercase text-emerald-800 tracking-wider bg-emerald-200/80 px-2.5 py-0.5 rounded-full">
                Database Admin Verified
              </span>
              <h3 class="text-lg sm:text-xl font-extrabold text-emerald-950 mt-1">
                {{ session('success') }}
              </h3>
              <p class="text-xs text-emerald-700">Data calon santri telah tersimpan dengan aman pada database sistem panitia PSB.</p>
            </div>
          </div>

          @if(session('pendaftaran'))
            @php $p = session('pendaftaran'); @endphp
            <div class="bg-white rounded-2xl p-6 border border-emerald-200 shadow-sm space-y-4 text-xs">
              <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 border-b border-slate-100 pb-3">
                <div>
                  <span class="text-slate-400 block text-[11px]">Nomor Registrasi Santri:</span>
                  <span class="font-mono font-black text-lg text-emerald-800">
                    #PSB-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}
                  </span>
                </div>
                <div class="text-right">
                  <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-wider inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-user-check"></i> {{ $p->status ?? 'Pending' }}
                  </span>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-slate-700">
                <div>
                  <span class="text-slate-400 block text-[11px]">Nama Calon Santri:</span>
                  <span class="font-bold text-slate-900 text-sm">{{ $p->nama_santri }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">Jenis Kelamin:</span>
                  <span class="font-semibold text-slate-800">{{ $p->jenis_kelamin }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">NISN / NIK:</span>
                  <span class="font-mono text-slate-800">{{ $p->nisn ?? '-' }} / {{ $p->nik ?? '-' }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">Lembaga Pendidikan:</span>
                  <span class="font-bold text-emerald-900">{{ $p->pilihan_pendidikan }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">Jalur Pendaftaran:</span>
                  <span class="font-semibold text-amber-700">{{ $p->jalur_pendaftaran ?? 'Reguler' }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">Pilihan Asrama:</span>
                  <span class="font-semibold text-slate-800">{{ $p->pilihan_asrama }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">Nama Orang Tua / Wali:</span>
                  <span class="font-bold text-slate-900">{{ $p->nama_ayah ?? ($p->nama_wali ?? '-') }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">No. WhatsApp / HP:</span>
                  <span class="font-bold text-slate-900">{{ $p->no_hp }}</span>
                </div>
                <div>
                  <span class="text-slate-400 block text-[11px]">Asal Sekolah:</span>
                  <span class="font-semibold text-slate-800">{{ $p->asal_sekolah ?? '-' }}</span>
                </div>
                <div class="sm:col-span-2 md:col-span-3">
                  <span class="text-slate-400 block text-[11px]">Alamat Lengkap:</span>
                  <span class="font-semibold text-slate-800">{{ $p->alamat_asal }}</span>
                </div>
              </div>

              <!-- Rincian Biaya Tersimpan -->
              <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                  <span class="text-slate-500 block text-[11px]">Infaq / Wakaf Sukarela:</span>
                  <span class="font-mono font-bold text-sm text-slate-800">
                    Rp {{ number_format($p->infaq_sukarela ?? 0, 0, ',', '.') }}
                  </span>
                </div>
                <div>
                  <span class="text-slate-500 block text-[11px]">Estimasi Total Biaya Daftar Ulang:</span>
                  <span class="font-mono font-black text-base text-emerald-700">
                    Rp {{ number_format($p->total_biaya ?? 0, 0, ',', '.') }}
                  </span>
                </div>
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
              @if(session('wa_url'))
                <a href="{{ session('wa_url') }}" target="_blank" class="flex-1 py-3.5 px-6 rounded-2xl font-bold text-xs text-white bg-emerald-600 hover:bg-emerald-700 shadow-md flex items-center justify-center gap-2 transition-all">
                  <i class="fa-brands fa-whatsapp text-lg"></i>
                  <span>Kirim Bukti Pendaftaran ke WhatsApp Panitia</span>
                </a>
              @endif
              <button type="button" onclick="window.print()" class="px-6 py-3.5 rounded-2xl font-bold text-xs text-slate-700 bg-white hover:bg-slate-100 border border-slate-300 shadow-sm flex items-center justify-center gap-2 transition-all">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Lembar Pendaftaran</span>
              </button>
            </div>
          @endif

          <div class="text-center pt-2">
            <a href="{{ route('psb') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 underline inline-flex items-center gap-1.5">
              <i class="fa-solid fa-plus-circle"></i> Input Calon Santri Baru Lainnya
            </a>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div class="mb-8 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-xs text-rose-700 space-y-1">
          <div class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-circle-exclamation text-rose-600"></i> Mohon periksa kembali isian formulir:</div>
          <ul class="list-disc pl-5 space-y-0.5">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- FORMULIR LENGKAP ALA ASSALAAM -->
      <form action="{{ route('psb.store') }}" method="POST" id="psbForm" class="space-y-8">
        @csrf

        <!-- ============================================== -->
        <!-- BAGIAN A: PILIHAN PENDAFTARAN & JALUR          -->
        <!-- ============================================== -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
          <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
            <div class="w-9 h-9 rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-sm shadow-sm">
              A
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold text-slate-900">Pilihan Lembaga Pendidikan & Jalur Pendaftaran</h3>
              <p class="text-xs text-slate-500">Tentukan jenjang pendidikan formal dan jalur penerimaan yang diinginkan.</p>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Pilihan Sekolah / Jenjang <span class="text-rose-500">*</span>
              </label>
              <select name="pilihan_pendidikan" id="pilihan_pendidikan" required onchange="hitungUlangBiaya()" class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-medium text-slate-800">
                <option value="MTs Miftahul Ulum (Setingkat SMP)" {{ old('pilihan_pendidikan') == 'MTs Miftahul Ulum (Setingkat SMP)' ? 'selected' : '' }}>
                  MTs Miftahul Ulum (Setingkat SMP)
                </option>
                <option value="SMK YAPIM KAB. TASIKMALAYA - TKJ" {{ old('pilihan_pendidikan') == 'SMK YAPIM KAB. TASIKMALAYA - TKJ' ? 'selected' : '' }}>
                  SMK YAPIM - Teknik Komputer & Jaringan (TKJ)
                </option>
                <option value="SMK YAPIM KAB. TASIKMALAYA - RPL" {{ old('pilihan_pendidikan') == 'SMK YAPIM KAB. TASIKMALAYA - RPL' ? 'selected' : '' }}>
                  SMK YAPIM - Rekayasa Perangkat Lunak (RPL)
                </option>
                <option value="SMK YAPIM KAB. TASIKMALAYA - TBSM" {{ old('pilihan_pendidikan') == 'SMK YAPIM KAB. TASIKMALAYA - TBSM' ? 'selected' : '' }}>
                  SMK YAPIM - Teknik Bisnis Sepeda Motor (TBSM)
                </option>
                <option value="Pengajian Salafiyah Pesantren Saja" {{ old('pilihan_pendidikan') == 'Pengajian Salafiyah Pesantren Saja' ? 'selected' : '' }}>
                  Pengajian Salafiyah Pesantren Saja
                </option>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Jalur Pendaftaran <span class="text-rose-500">*</span>
              </label>
              <select name="jalur_pendaftaran" id="jalur_pendaftaran" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-medium text-slate-800">
                <option value="Reguler" {{ old('jalur_pendaftaran') == 'Reguler' ? 'selected' : '' }}>Jalur Reguler (Umum)</option>
                <option value="Prestasi (Tahfidz / Akademik)" {{ old('jalur_pendaftaran') == 'Prestasi (Tahfidz / Akademik)' ? 'selected' : '' }}>Jalur Prestasi (Tahfidz / Akademik)</option>
                <option value="Yatim Piatu / Dhuafa Berprestasi" {{ old('jalur_pendaftaran') == 'Yatim Piatu / Dhuafa Berprestasi' ? 'selected' : '' }}>Jalur Beasiswa Yatim / Dhuafa</option>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Pilihan Asrama / Mukim <span class="text-rose-500">*</span>
              </label>
              <select name="pilihan_asrama" id="pilihan_asrama" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-medium text-slate-800">
                <option value="Santri Mukim (Tinggal di Asrama Kobong)" {{ old('pilihan_asrama') == 'Santri Mukim (Tinggal di Asrama Kobong)' ? 'selected' : '' }}>Santri Mukim (Tinggal di Asrama Kobong)</option>
                <option value="Santri Non-Mukim / Kalong (Warga Sekitar)" {{ old('pilihan_asrama') == 'Santri Non-Mukim / Kalong (Warga Sekitar)' ? 'selected' : '' }}>Santri Non-Mukim / Kalong (Pulang Pergi)</option>
              </select>
            </div>
          </div>
        </div>

        <!-- ============================================== -->
        <!-- BAGIAN B: DATA CALON SANTRI                   -->
        <!-- ============================================== -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
          <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
            <div class="w-9 h-9 rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-sm shadow-sm">
              B
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold text-slate-900">Data Identitas Calon Santri</h3>
              <p class="text-xs text-slate-500">Lengkapi data pribadi calon santri sesuai dengan dokumen Akta Kelahiran dan Kartu Keluarga.</p>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Nama Lengkap Calon Santri <span class="text-rose-500">*</span>
              </label>
              <input type="text" name="nama_santri" value="{{ old('nama_santri') }}" required placeholder="Contoh: Muhammad Farhan Al-Ghifari" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 font-medium">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Jenis Kelamin <span class="text-rose-500">*</span>
              </label>
              <select name="jenis_kelamin" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-medium text-slate-800">
                <option value="Laki-laki (Santri Putra)" {{ old('jenis_kelamin') == 'Laki-laki (Santri Putra)' ? 'selected' : '' }}>Laki-laki (Santri Putra)</option>
                <option value="Perempuan (Santri Putri)" {{ old('jenis_kelamin') == 'Perempuan (Santri Putri)' ? 'selected' : '' }}>Perempuan (Santri Putri)</option>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Asal Sekolah / Madrasah Terakhir
              </label>
              <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" placeholder="Contoh: SD Negeri 1 Manonjaya / MI Miftahul Huda" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                NISN (Nomor Induk Siswa Nasional)
              </label>
              <input type="text" name="nisn" value="{{ old('nisn') }}" placeholder="Contoh: 0081234567 (10 Digit)" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 font-mono">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                NIK Calon Santri (No. KTP/KK)
              </label>
              <input type="text" name="nik" value="{{ old('nik') }}" placeholder="Contoh: 3206xxxxxxxxxxxx (16 Digit)" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 font-mono">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Tempat Lahir
              </label>
              <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Tasikmalaya" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Tanggal Lahir
              </label>
              <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 text-slate-700">
            </div>

            <div class="grid grid-cols-2 gap-3">
              <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  Anak Ke-
                </label>
                <input type="number" name="anak_ke" value="{{ old('anak_ke', 1) }}" min="1" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                  Dari Jml Saudara
                </label>
                <input type="number" name="jumlah_saudara" value="{{ old('jumlah_saudara', 1) }}" min="1" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500">
              </div>
            </div>

            <div class="md:col-span-2">
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Alamat Lengkap Domisili / Tempat Tinggal <span class="text-rose-500">*</span>
              </label>
              <textarea name="alamat_asal" required rows="2" placeholder="Nama Jalan, Kampung/Dusun, RT/RW, Desa/Kelurahan, Kecamatan, Kabupaten/Kota, Provinsi" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('alamat_asal') }}</textarea>
            </div>
          </div>
        </div>

        <!-- ============================================== -->
        <!-- BAGIAN C: DATA ORANG TUA / WALI                -->
        <!-- ============================================== -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
          <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
            <div class="w-9 h-9 rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-sm shadow-sm">
              C
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold text-slate-900">Data Orang Tua / Wali</h3>
              <p class="text-xs text-slate-500">Informasi identitas ayah, ibu, serta kontak aktif untuk koordinasi santri.</p>
            </div>
          </div>

          <!-- Data Ayah -->
          <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
            <h4 class="font-bold text-xs uppercase tracking-wider text-slate-700 flex items-center gap-2">
              <i class="fa-solid fa-user-tie text-emerald-700"></i> Data Ayah Kandung
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Nama Ayah</label>
                <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Nama Lengkap Ayah" class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" placeholder="PNS, Wiraswasta, Petani, dll" class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">No. HP / WA Ayah</label>
                <input type="tel" name="no_hp_ayah" value="{{ old('no_hp_ayah') }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-mono">
              </div>
            </div>
          </div>

          <!-- Data Ibu -->
          <div class="p-4 sm:p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
            <h4 class="font-bold text-xs uppercase tracking-wider text-slate-700 flex items-center gap-2">
              <i class="fa-solid fa-person-dress text-pink-600"></i> Data Ibu Kandung
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Nama Ibu</label>
                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Nama Lengkap Ibu" class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="IRT, Guru, Pedagang, dll" class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 uppercase mb-1">No. HP / WA Ibu</label>
                <input type="tel" name="no_hp_ibu" value="{{ old('no_hp_ibu') }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-mono">
              </div>
            </div>
          </div>

          <!-- Kontak Utama & Penghasilan -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Nama Wali Santri / Penanggung Jawab
              </label>
              <input type="text" name="nama_wali" value="{{ old('nama_wali') }}" placeholder="Bila santri diasuh wali selain orang tua" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                No. WhatsApp Utama (Konfirmasi) <span class="text-rose-500">*</span>
              </label>
              <input type="tel" name="no_hp" required value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 font-mono">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Rata-rata Penghasilan Orang Tua
              </label>
              <select name="penghasilan_ortu" class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white text-slate-800">
                <option value="Kurang dari Rp 1.000.000" {{ old('penghasilan_ortu') == 'Kurang dari Rp 1.000.000' ? 'selected' : '' }}>< Rp 1.000.000</option>
                <option value="Rp 1.000.000 - Rp 2.500.000" {{ old('penghasilan_ortu') == 'Rp 1.000.000 - Rp 2.500.000' ? 'selected' : '' }}>Rp 1.000.000 - Rp 2.500.000</option>
                <option value="Rp 2.500.000 - Rp 5.000.000" {{ old('penghasilan_ortu') == 'Rp 2.500.000 - Rp 5.000.000' ? 'selected' : '' }}>Rp 2.500.000 - Rp 5.000.000</option>
                <option value="Rp 5.000.000 - Rp 10.000.000" {{ old('penghasilan_ortu') == 'Rp 5.000.000 - Rp 10.000.000' ? 'selected' : '' }}>Rp 5.000.000 - Rp 10.000.000</option>
                <option value="Lebih dari Rp 10.000.000" {{ old('penghasilan_ortu') == 'Lebih dari Rp 10.000.000' ? 'selected' : '' }}>> Rp 10.000.000</option>
              </select>
            </div>
          </div>
        </div>

        <!-- ============================================== -->
        <!-- BAGIAN D: PERSYARATAN BERKAS                   -->
        <!-- ============================================== -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-4">
          <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
            <div class="w-9 h-9 rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-sm shadow-sm">
              D
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold text-slate-900">Ketentuan Persyaratan Berkas Fisik</h3>
              <p class="text-xs text-slate-500">Berkas fisik dapat diserahkan langsung ke kantor panitia atau dikirim saat kedatangan santri.</p>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 pt-2">
            <div class="p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-100 text-xs text-emerald-900 flex items-start gap-2.5">
              <i class="fa-solid fa-check-circle text-emerald-600 mt-0.5"></i>
              <span>Fotokopi Kartu Keluarga & Akta Kelahiran (3 Lembar)</span>
            </div>
            <div class="p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-100 text-xs text-emerald-900 flex items-start gap-2.5">
              <i class="fa-solid fa-check-circle text-emerald-600 mt-0.5"></i>
              <span>Fotokopi Ijazah / SKL / Surat Keterangan Lulus (3 Lembar)</span>
            </div>
            <div class="p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-100 text-xs text-emerald-900 flex items-start gap-2.5">
              <i class="fa-solid fa-check-circle text-emerald-600 mt-0.5"></i>
              <span>Fotokopi NISN Resmi dari Kemdikbud / Kemenag</span>
            </div>
            <div class="p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-100 text-xs text-emerald-900 flex items-start gap-2.5">
              <i class="fa-solid fa-check-circle text-emerald-600 mt-0.5"></i>
              <span>Pas foto terbaru ukuran 3x4 berwarna (4 Lembar)</span>
            </div>
          </div>
        </div>

        <!-- ============================================== -->
        <!-- BAGIAN E: RINCIAN BIAYA & PEMBIAYAAN           -->
        <!-- ============================================== -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
          <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-sm shadow-sm">
                E
              </div>
              <div>
                <h3 class="text-base sm:text-lg font-bold text-slate-900">Rincian Biaya Pendidikan & Daftar Ulang</h3>
                <p class="text-xs text-slate-500">Transparansi nominal pembiayaan santri baru tahun ajaran 2026/2027.</p>
              </div>
            </div>
            <div class="hidden sm:block text-right">
              <span class="text-[10px] uppercase font-bold text-slate-400 block">Unit Terpilih</span>
              <span id="labelUnitPendidikan" class="text-xs font-black text-emerald-800 bg-emerald-100 px-3 py-1 rounded-lg">
                MTs Miftahul Ulum
              </span>
            </div>
          </div>

          <!-- Tabel Komponen Biaya Dinamis dari Database Admin -->
          <div class="overflow-x-auto rounded-2xl border border-slate-200">
            <table class="w-full text-left text-xs sm:text-sm">
              <thead>
                <tr class="bg-slate-100 text-slate-700 font-bold border-b border-slate-200">
                  <th class="py-3 px-4 w-12 text-center">No</th>
                  <th class="py-3 px-4">Komponen Biaya</th>
                  <th class="py-3 px-4">Kategori</th>
                  <th class="py-3 px-4">Keterangan</th>
                  <th class="py-3 px-4 text-right">Nominal (Rp)</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100 text-slate-700" id="tabelBiayaBody">
                @php $no = 1; @endphp
                @foreach($biayas as $biaya)
                  <tr class="hover:bg-slate-50/80 transition-colors baris-biaya"
                      data-id="{{ $biaya->id }}"
                      data-mts="{{ $biaya->nominal_mts }}"
                      data-smk="{{ $biaya->nominal_smk }}">
                    <td class="py-3 px-4 text-center font-mono text-slate-400">{{ $no++ }}</td>
                    <td class="py-3 px-4 font-bold text-slate-800">{{ $biaya->nama_biaya }}</td>
                    <td class="py-3 px-4">
                      <span class="px-2 py-0.5 rounded text-[11px] bg-slate-100 text-slate-600 border border-slate-200">
                        {{ $biaya->kategori }}
                      </span>
                    </td>
                    <td class="py-3 px-4 text-slate-500 text-xs">{{ $biaya->keterangan ?? '-' }}</td>
                    <td class="py-3 px-4 text-right font-mono font-bold text-slate-800 cell-nominal">
                      Rp {{ number_format($biaya->nominal_mts, 0, ',', '.') }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr class="bg-emerald-50 font-bold text-emerald-950 border-t-2 border-emerald-300">
                  <td colspan="4" class="py-3.5 px-4 text-right uppercase tracking-wider text-xs">
                    Subtotal Biaya Daftar Ulang Pokok:
                  </td>
                  <td class="py-3.5 px-4 text-right font-mono text-base text-emerald-800" id="subtotalBiayaPokok">
                    Rp {{ number_format($totalMts, 0, ',', '.') }}
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>

          <!-- Pilihan Infaq / Wakaf Sukarela (Fitur Assalaam) -->
          <div class="p-5 rounded-2xl bg-amber-50/70 border border-amber-200/80 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
              <div>
                <h4 class="font-extrabold text-sm text-amber-950 flex items-center gap-2">
                  <i class="fa-solid fa-hand-holding-heart text-amber-600"></i> Pilihan Infaq / Wakaf Pengembangan Fasilitas Pesantren
                </h4>
                <p class="text-xs text-amber-800 mt-0.5">
                  Partisipasi sukarela wali santri untuk pengembangan sarana prasarana asrama & masjid pondok.
                </p>
              </div>
              <span class="text-[11px] font-bold text-amber-800 bg-amber-200/60 px-2.5 py-1 rounded-full self-start sm:self-auto">
                Sukarela (Tidak Mengikat)
              </span>
            </div>

            <!-- Radio Pilihan Infaq -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
              <label class="flex items-center gap-2.5 p-3 rounded-xl border border-amber-300 bg-white hover:bg-amber-100/50 cursor-pointer transition-all">
                <input type="radio" name="pilihan_infaq_radio" value="0" checked onchange="pilihInfaq(0)" class="text-amber-600 focus:ring-amber-500">
                <span class="text-xs font-bold text-slate-800">Rp 0 (Tanpa Tambahan)</span>
              </label>
              <label class="flex items-center gap-2.5 p-3 rounded-xl border border-amber-300 bg-white hover:bg-amber-100/50 cursor-pointer transition-all">
                <input type="radio" name="pilihan_infaq_radio" value="500000" onchange="pilihInfaq(500000)" class="text-amber-600 focus:ring-amber-500">
                <span class="text-xs font-bold text-slate-800">Rp 500.000</span>
              </label>
              <label class="flex items-center gap-2.5 p-3 rounded-xl border border-amber-300 bg-white hover:bg-amber-100/50 cursor-pointer transition-all">
                <input type="radio" name="pilihan_infaq_radio" value="1000000" onchange="pilihInfaq(1000000)" class="text-amber-600 focus:ring-amber-500">
                <span class="text-xs font-bold text-slate-800">Rp 1.000.000</span>
              </label>
              <label class="flex items-center gap-2.5 p-3 rounded-xl border border-amber-300 bg-white hover:bg-amber-100/50 cursor-pointer transition-all">
                <input type="radio" name="pilihan_infaq_radio" value="custom" onchange="pilihInfaq('custom')" class="text-amber-600 focus:ring-amber-500">
                <span class="text-xs font-bold text-slate-800">Nominal Lainnya...</span>
              </label>
            </div>

            <div id="wrapperCustomInfaq" class="hidden pt-1">
              <label class="block text-xs font-bold text-amber-900 mb-1">Masukkan Nominal Infaq Sukarela Lainnya (Rp):</label>
              <div class="relative max-w-xs">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-xs font-bold text-slate-400">Rp</span>
                <input type="number" step="10000" id="inputCustomInfaq" placeholder="Contoh: 1500000" oninput="updateCustomInfaq(this.value)" class="w-full pl-10 pr-3 py-2 text-sm rounded-xl border border-amber-400 bg-white focus:outline-none focus:ring-2 focus:ring-amber-500 font-mono font-bold">
              </div>
            </div>
          </div>

          <!-- Total Biaya Grand Total -->
          <div class="p-6 rounded-2xl bg-gradient-to-r from-emerald-900 to-teal-900 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-md">
            <div>
              <span class="text-xs font-bold text-emerald-300 uppercase tracking-widest block">Total Estimasi Biaya Pendaftaran</span>
              <p class="text-xs text-slate-300 mt-0.5">Biaya pokok daftar ulang + Infaq sukarela pengembangan pesantren.</p>
            </div>
            <div class="text-right">
              <span class="text-3xl font-black text-amber-300 font-mono" id="displayGrandTotal">
                Rp {{ number_format($totalMts, 0, ',', '.') }}
              </span>
              <span class="block text-[11px] text-emerald-200 mt-0.5">Dapat diangsur sesuai kesepakatan saat wawancara</span>
            </div>
          </div>

          <!-- Hidden Input untuk dikirim ke Backend -->
          <input type="hidden" name="infaq_sukarela" id="infaq_sukarela" value="0">
          <input type="hidden" name="total_biaya" id="total_biaya" value="{{ $totalMts }}">
        </div>

        <!-- ============================================== -->
        <!-- BAGIAN F: DATA LAIN-LAIN & KONFIRMASI          -->
        <!-- ============================================== -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
          <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
            <div class="w-9 h-9 rounded-xl bg-emerald-800 text-amber-400 flex items-center justify-center font-black text-sm shadow-sm">
              F
            </div>
            <div>
              <h3 class="text-base sm:text-lg font-bold text-slate-900">Informasi Tambahan & Pernyataan Wali</h3>
              <p class="text-xs text-slate-500">Konfirmasi kesediaan dan sumber informasi pendaftaran.</p>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
              Mengetahui Informasi Pendaftaran Pesantren Dari:
            </label>
            <select name="sumber_info" class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white text-slate-800">
              <option value="Media Sosial (Facebook, Instagram, YouTube, TikTok)">Media Sosial (Facebook, Instagram, YouTube, TikTok)</option>
              <option value="Keluarga, Saudara, atau Alumni Pesantren">Keluarga, Saudara, atau Alumni Pesantren</option>
              <option value="Guru / Sekolah Asal (SD/MI/SMP/MTs)">Guru / Sekolah Asal (SD/MI/SMP/MTs)</option>
              <option value="Website Resmi Pesantren">Website Resmi Pesantren</option>
              <option value="Spanduk / Baliho / Brosur">Spanduk / Baliho / Brosur</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>

          <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
            <label class="flex items-start gap-3 cursor-pointer">
              <input type="checkbox" required class="mt-1 w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
              <span class="text-xs text-slate-700 leading-relaxed">
                Dengan ini saya menyatakan bahwa seluruh data yang diisikan dalam formulir pendaftaran ini adalah benar dan dapat dipertanggungjawabkan. Saya bersedia mengikuti seluruh tata tertib dan ketentuan penerimaan santri baru di <strong>Pondok Pesantren Miftahul Ulum Gunung Bubut</strong>.
              </span>
            </label>
          </div>

          <div class="pt-2">
            <button type="submit" id="btnSubmitPsb" class="w-full py-4 px-8 rounded-2xl font-extrabold text-sm sm:text-base text-white bg-emerald-800 hover:bg-emerald-700 shadow-xl hover:shadow-emerald-900/40 transition-all flex items-center justify-center gap-3 transform hover:-translate-y-0.5">
              <i class="fa-solid fa-cloud-arrow-up text-xl text-amber-400"></i>
              <span>Kirim & Simpan Formulir Pendaftaran ke Database</span>
            </button>
            <p class="text-[11px] text-slate-500 text-center mt-3 flex items-center justify-center gap-1.5">
              <i class="fa-solid fa-lock text-emerald-600"></i>
              <span>Data formulir langsung terenkripsi dan tersimpan ke database admin penerimaan santri baru.</span>
            </p>
          </div>
        </div>

      </form>

    </div>
  </section>

  <!-- JAVASCRIPT REAL-TIME KALKULASI BIAYA & SELEKSI SEKOLAH -->
  <script>
    let infaqNominal = 0;

    function formatRupiah(angka) {
      return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    function hitungUlangBiaya() {
      const pilihan = document.getElementById('pilihan_pendidikan').value;
      const isSmk = pilihan.toLowerCase().includes('smk');
      const labelUnit = document.getElementById('labelUnitPendidikan');
      
      if (isSmk) {
        labelUnit.innerText = 'SMK YAPIM';
        labelUnit.className = 'text-xs font-black text-blue-800 bg-blue-100 px-3 py-1 rounded-lg';
      } else {
        labelUnit.innerText = 'MTs Miftahul Ulum';
        labelUnit.className = 'text-xs font-black text-emerald-800 bg-emerald-100 px-3 py-1 rounded-lg';
      }

      let subtotalPokok = 0;
      const rows = document.querySelectorAll('.baris-biaya');

      rows.forEach(row => {
        const nomMts = parseFloat(row.getAttribute('data-mts')) || 0;
        const nomSmk = parseFloat(row.getAttribute('data-smk')) || 0;
        const nominalDipakai = isSmk ? nomSmk : nomMts;

        subtotalPokok += nominalDipakai;
        const cellNominal = row.querySelector('.cell-nominal');
        if (cellNominal) {
          cellNominal.innerText = formatRupiah(nominalDipakai);
        }
      });

      document.getElementById('subtotalBiayaPokok').innerText = formatRupiah(subtotalPokok);

      const grandTotal = subtotalPokok + infaqNominal;
      document.getElementById('displayGrandTotal').innerText = formatRupiah(grandTotal);

      document.getElementById('infaq_sukarela').value = infaqNominal;
      document.getElementById('total_biaya').value = grandTotal;
    }

    function pilihInfaq(val) {
      const wrapperCustom = document.getElementById('wrapperCustomInfaq');
      const inputCustom = document.getElementById('inputCustomInfaq');

      if (val === 'custom') {
        wrapperCustom.classList.remove('hidden');
        infaqNominal = parseFloat(inputCustom.value) || 0;
      } else {
        wrapperCustom.classList.add('hidden');
        infaqNominal = parseFloat(val) || 0;
      }
      hitungUlangBiaya();
    }

    function updateCustomInfaq(val) {
      infaqNominal = parseFloat(val) || 0;
      hitungUlangBiaya();
    }

    // Jalankan kalkulasi saat halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
      hitungUlangBiaya();
    });
  </script>

@endsection
