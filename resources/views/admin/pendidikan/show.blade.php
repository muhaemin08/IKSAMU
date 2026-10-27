@extends('layouts.admin')

@section('title', 'Kelola ' . $item->nama)
@section('header_title', 'Kelola Lembaga Pendidikan Formal')

@section('content')

  <div class="space-y-6">

    <!-- HEADER CARD -->
    <div class="bg-gradient-to-r {{ $kode === 'mts' ? 'from-emerald-900 to-teal-950' : 'from-blue-900 to-indigo-950' }} text-white rounded-3xl p-6 sm:p-8 shadow-lg relative overflow-hidden">
      <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
      
      <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
          <div class="w-16 h-16 rounded-2xl {{ $kode === 'mts' ? 'bg-emerald-500/30 border-emerald-400' : 'bg-blue-500/30 border-blue-400' }} border-2 flex items-center justify-center text-3xl shadow-inner shrink-0">
            <i class="fa-solid {{ $kode === 'mts' ? 'fa-graduation-cap text-amber-300' : 'fa-laptop-code text-cyan-300' }}"></i>
          </div>
          <div>
            <div class="flex items-center gap-2">
              <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ $kode === 'mts' ? 'bg-emerald-500/30 text-emerald-200' : 'bg-blue-500/30 text-blue-200' }}">
                {{ $item->jenjang ?? ($kode === 'mts' ? 'Madrasah Tsanawiyah' : 'Sekolah Menengah Kejuruan') }}
              </span>
              <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-amber-400 text-slate-950">
                {{ $item->akreditasi ?? 'Terakreditasi' }}
              </span>
            </div>
            <h2 class="text-xl sm:text-2xl font-black mt-1">{{ $item->nama }}</h2>
            <div class="text-xs text-slate-300 flex items-center gap-4 mt-1">
              <span><i class="fa-solid fa-id-card mr-1 text-amber-400"></i> NPSN: {{ $item->npsn ?? '-' }}</span>
              <span>•</span>
              <span><i class="fa-solid fa-user-tie mr-1 text-amber-400"></i> Kepala: {{ $item->kepala_sekolah ?? '-' }}</span>
            </div>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <a href="{{ route('pendidikan') }}#{{ $kode }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-xs font-bold transition-all flex items-center gap-2">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Lihat Halaman Publik</span>
          </a>
        </div>
      </div>
    </div>

    <!-- TABS NAVIGATION -->
    <div class="flex border-b border-slate-200 gap-3 text-xs font-bold" id="pendidikanTabs">
      <button type="button" onclick="switchTab('profil')" id="tabBtn-profil" class="tab-btn px-5 py-3 border-b-2 border-emerald-600 text-emerald-800 flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-sliders"></i>
        <span>Profil & Tampilan Dinamis</span>
      </button>
      <button type="button" onclick="switchTab('artikel')" id="tabBtn-artikel" class="tab-btn px-5 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-800 flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-newspaper"></i>
        <span>Pengelolaan Artikel & Berita ({{ $articles->total() }})</span>
      </button>
    </div>

    <!-- TAB 1: PROFIL & TAMPILAN DINAMIS -->
    <div id="tabContent-profil" class="tab-pane space-y-6">
      <form action="{{ route('admin.pendidikan.update', $kode) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="flex flex-col sm:flex-row justify-between sm:items-center pb-4 border-b border-slate-100 gap-3">
          <div>
            <h3 class="font-extrabold text-base text-slate-900">Konfigurasi Tampilan Dinamis</h3>
            <p class="text-xs text-slate-500 mt-0.5">Seluruh data di bawah ini langsung sinkron dengan halaman publik website</p>
          </div>
          <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md transition-all flex items-center justify-center gap-2">
            <i class="fa-solid fa-floppy-disk"></i>
            <span>Simpan Perubahan Profil</span>
          </button>
        </div>

        <!-- IDENTITAS UMUM -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Resmi Lembaga *</label>
            <input type="text" name="nama" value="{{ old('nama', $item->nama) }}" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-bold">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">NPSN</label>
            <input type="text" name="npsn" value="{{ old('npsn', $item->npsn) }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Status Akreditasi</label>
            <input type="text" name="akreditasi" value="{{ old('akreditasi', $item->akreditasi) }}" placeholder="Contoh: Terakreditasi A (Unggul)" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Jenjang Pendidikan</label>
            <input type="text" name="jenjang" value="{{ old('jenjang', $item->jenjang) }}" placeholder="Contoh: Madrasah Tsanawiyah / SMK" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <!-- PROFIL KEPALA SEKOLAH / KEPALA MADRASAH -->
        <div class="p-6 rounded-3xl bg-amber-50/60 border border-amber-200/80 space-y-4">
          <div class="flex items-center justify-between border-b border-amber-200/60 pb-3">
            <h4 class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
              <i class="fa-solid fa-user-tie text-amber-600"></i>
              <span>Profil {{ $kode === 'mts' ? 'Kepala Madrasah' : 'Kepala Sekolah' }}</span>
            </h4>
            <span class="text-[11px] font-bold text-amber-800 bg-amber-100 px-2.5 py-0.5 rounded-full">
              Pimpinan Lembaga
            </span>
          </div>

          <div class="flex flex-col sm:flex-row items-start gap-6">
            <!-- Foto Kepala Sekolah -->
            <div class="space-y-2 shrink-0 text-center mx-auto sm:mx-0">
              <div class="w-28 h-36 rounded-2xl overflow-hidden border-2 border-amber-400 shadow-md bg-slate-900 mx-auto relative group">
                <img src="{{ str_starts_with($item->foto_kepala_sekolah ?? '', 'http') ? $item->foto_kepala_sekolah : asset($item->foto_kepala_sekolah ?? 'assets/images/pimpinan_1792662555.jpeg') }}" 
                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80';"
                     alt="Foto Kepala" class="w-full h-full object-cover">
              </div>
              <span class="text-[10px] text-slate-500 font-semibold block">Pasfoto Resmi</span>
            </div>

            <!-- Detail Kepala Sekolah -->
            <div class="flex-1 space-y-3.5 w-full">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap & Gelar *</label>
                  <input type="text" name="kepala_sekolah" value="{{ old('kepala_sekolah', $item->kepala_sekolah) }}" required placeholder="Contoh: Drs. H. Mamat Rohimat, M.M." class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 bg-white focus:outline-none focus:border-amber-500 font-bold">
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">NIP / NUPTK</label>
                  <input type="text" name="nip_kepala_sekolah" value="{{ old('nip_kepala_sekolah', $item->nip_kepala_sekolah) }}" placeholder="Contoh: 19680512 199403 1 004" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 bg-white focus:outline-none focus:border-amber-500">
                </div>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Ganti Pasfoto Kepala (Auto WebP)</label>
                <input type="file" name="foto_kepala_sekolah_file" accept="image/*" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 bg-white">
                <p class="text-[11px] text-slate-500 mt-1">Upload foto setengah badan / pasfoto formal. Otomatis dikonversi dan di-resize oleh sistem.</p>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Sambutan Singkat / Pesan Kepala Sekolah</label>
                <textarea name="sambutan_kepala_sekolah" rows="3" placeholder="Pesan pengantar atau visi pimpinan madrasah/sekolah..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 bg-white focus:outline-none focus:border-amber-500 leading-relaxed">{{ old('sambutan_kepala_sekolah', $item->sambutan_kepala_sekolah) }}</textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- FOTO UTAMA LEMBAGA -->
        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
          <label class="block text-xs font-extrabold text-slate-800 uppercase tracking-wider">
            <i class="fa-solid fa-image text-emerald-700 mr-1.5"></i> Foto Utama Lembaga (Gedung / Aktivitas)
          </label>
          <div class="flex flex-col sm:flex-row items-center gap-5">
            <div class="w-48 h-32 rounded-xl overflow-hidden border border-slate-300 shadow bg-slate-900 shrink-0">
              <img src="{{ str_starts_with($item->foto ?? '', 'http') ? $item->foto : asset($item->foto ?? 'assets/images/hero-pesantren.jpg') }}" 
                   onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=800&q=80';"
                   alt="Preview Foto" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 space-y-2">
              <p class="text-xs text-slate-700 font-semibold">Upload foto representatif lembaga untuk ditampilkan pada kartu profil publik.</p>
              <input type="file" name="foto_file" accept="image/*" class="w-full px-4 py-2 text-xs rounded-xl border border-slate-300 bg-white">
              <p class="text-[11px] text-slate-500">File otomatis di-resize dan dikonversi ke WebP teroptimasi oleh sistem.</p>
            </div>
          </div>
        </div>

        <!-- DESKRIPSI -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi & Profil Lembaga</label>
          <textarea name="deskripsi" rows="4" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 leading-relaxed">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </div>

        <!-- KEUNGGULAN & EKSKUL -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">
              <i class="fa-solid fa-circle-check text-emerald-600 mr-1"></i> Keunggulan Lembaga (Satu butir per baris)
            </label>
            <textarea name="keunggulan_text" rows="6" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono text-[11px] leading-relaxed">{{ old('keunggulan_text', implode("\n", $item->keunggulan ?? [])) }}</textarea>
            <p class="text-[10px] text-slate-400 mt-1">Tekan Enter untuk membuat butir keunggulan baru.</p>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">
              <i class="fa-solid fa-shapes text-amber-600 mr-1"></i> Ekstrakurikuler (Satu butir per baris)
            </label>
            <textarea name="ekskul_text" rows="6" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono text-[11px] leading-relaxed">{{ old('ekskul_text', implode("\n", $item->ekskul ?? [])) }}</textarea>
            <p class="text-[10px] text-slate-400 mt-1">Tekan Enter untuk membuat butir ekstrakurikuler baru.</p>
          </div>
        </div>

        <!-- KHUSUS SMK: PROGRAM KEAHLIAN / JURUSAN -->
        @if($kode === 'smk')
          <div class="border-t border-slate-100 pt-6 space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <h4 class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
                  <i class="fa-solid fa-network-wired text-blue-600"></i>
                  <span>Program Keahlian / Jurusan Kejuruan</span>
                </h4>
                <p class="text-xs text-slate-500 mt-0.5">Kelola daftar jurusan dan kompetensi keahlian yang ada di {{ $item->nama }}</p>
              </div>
              <button type="button" onclick="addJurusanRow()" class="px-3 py-1.5 rounded-lg border border-blue-300 text-blue-700 hover:bg-blue-50 text-xs font-bold transition-colors">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Jurusan
              </button>
            </div>

            <div id="jurusanContainer" class="space-y-3">
              @php $jurusanList = $item->jurusan ?? []; @endphp
              @forelse($jurusanList as $idx => $jur)
                <div class="jurusan-row p-4 rounded-2xl bg-blue-50/50 border border-blue-200/80 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                  <div class="sm:col-span-2">
                    <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Kode</label>
                    <input type="text" name="jurusan_data[{{ $idx }}][kode]" value="{{ $jur['kode'] ?? '' }}" placeholder="TKJ" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white uppercase font-bold">
                  </div>
                  <div class="sm:col-span-4">
                    <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Nama Jurusan</label>
                    <input type="text" name="jurusan_data[{{ $idx }}][nama]" value="{{ $jur['nama'] ?? '' }}" placeholder="Teknik Komputer & Jaringan" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white font-bold">
                  </div>
                  <div class="sm:col-span-5">
                    <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Deskripsi Singkat</label>
                    <input type="text" name="jurusan_data[{{ $idx }}][deskripsi]" value="{{ $jur['deskripsi'] ?? '' }}" placeholder="Fokus kompetensi keahlian..." class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white">
                  </div>
                  <div class="sm:col-span-1 flex items-end justify-center pt-4 sm:pt-0">
                    <button type="button" onclick="this.closest('.jurusan-row').remove()" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Jurusan">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </div>
                </div>
              @empty
                <div class="jurusan-row p-4 rounded-2xl bg-blue-50/50 border border-blue-200/80 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                  <div class="sm:col-span-2">
                    <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Kode</label>
                    <input type="text" name="jurusan_data[0][kode]" value="TKJ" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white uppercase font-bold">
                  </div>
                  <div class="sm:col-span-4">
                    <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Nama Jurusan</label>
                    <input type="text" name="jurusan_data[0][nama]" value="Teknik Komputer & Jaringan" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white font-bold">
                  </div>
                  <div class="sm:col-span-5">
                    <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Deskripsi Singkat</label>
                    <input type="text" name="jurusan_data[0][deskripsi]" value="Keahlian jaringan, server, dan instalasi IT." class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white">
                  </div>
                  <div class="sm:col-span-1 flex items-end justify-center pt-4 sm:pt-0">
                    <button type="button" onclick="this.closest('.jurusan-row').remove()" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </div>
                </div>
              @endforelse
            </div>
          </div>
        @endif

        <div class="pt-4 border-t border-slate-100 flex justify-end">
          <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-floppy-disk"></i>
            <span>Simpan Perubahan Profil {{ $item->nama }}</span>
          </button>
        </div>

      </form>
    </div>

    <!-- TAB 2: ARTIKEL & BERITA LEMBAGA -->
    <div id="tabContent-artikel" class="tab-pane space-y-6 hidden">
      <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
        
        <div class="flex flex-col sm:flex-row justify-between sm:items-center pb-6 border-b border-slate-100 gap-4 mb-6">
          <div>
            <h3 class="font-extrabold text-base text-slate-900">Publikasi & Kegiatan {{ $item->nama }}</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola berita, even, artikel karya santri & dewan guru khusus {{ $item->nama }}</p>
          </div>
          <button type="button" onclick="document.getElementById('modalTambahArtikel').classList.remove('hidden')" class="px-4 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tulis Artikel Baru</span>
          </button>
        </div>

        <!-- TABEL ARTIKEL LEMBAGA -->
        <div class="overflow-x-auto border border-slate-200 rounded-2xl">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase text-[10px] tracking-wider">
              <tr>
                <th class="py-3 px-4 w-12 text-center">No</th>
                <th class="py-3 px-4">Artikel / Berita</th>
                <th class="py-3 px-4">Kategori</th>
                <th class="py-3 px-4">Penulis</th>
                <th class="py-3 px-4">Tanggal</th>
                <th class="py-3 px-4 text-center">Status</th>
                <th class="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
              @forelse($articles as $index => $art)
                <tr class="hover:bg-slate-50/80 transition-colors">
                  <td class="py-3.5 px-4 text-center text-slate-400 font-semibold">
                    {{ $articles->firstItem() + $index }}
                  </td>
                  <td class="py-3.5 px-4">
                    <div class="flex items-center gap-3">
                      <div class="w-14 h-10 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 shrink-0">
                        @if($art->thumbnail)
                          <img src="{{ asset($art->thumbnail) }}" alt="{{ $art->judul }}" class="w-full h-full object-cover">
                        @else
                          <div class="w-full h-full flex items-center justify-center text-slate-400"><i class="fa-solid fa-newspaper"></i></div>
                        @endif
                      </div>
                      <div class="max-w-md">
                        <a href="{{ route('publikasi.detail', $art->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-emerald-700 line-clamp-1">
                          {{ $art->judul }}
                        </a>
                        <p class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $art->ringkasan }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="py-3.5 px-4">
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $art->category->badge_class ?? 'bg-slate-100 text-slate-700' }}">
                      {{ $art->category->nama ?? 'Artikel' }}
                    </span>
                  </td>
                  <td class="py-3.5 px-4 text-slate-600 font-medium">
                    {{ $art->penulis ?? '-' }}
                  </td>
                  <td class="py-3.5 px-4 text-slate-500 text-[11px]">
                    {{ $art->tanggal_publikasi ? $art->tanggal_publikasi->translatedFormat('d M Y') : '-' }}
                  </td>
                  <td class="py-3.5 px-4 text-center">
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $art->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                      {{ $art->status === 'published' ? 'Tayang' : 'Draft' }}
                    </span>
                  </td>
                  <td class="py-3.5 px-4 text-right">
                    <div class="flex items-center justify-end gap-1.5">
                      <a href="{{ route('admin.articles.edit', $art) }}" class="p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-emerald-700" title="Edit Artikel">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <form action="{{ route('admin.articles.destroy', $art) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-red-50 hover:text-red-600" title="Hapus Artikel">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="py-12 text-center text-slate-400">
                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-xl mb-2">
                      <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div class="font-bold text-slate-700 text-sm">Belum ada artikel khusus {{ $item->nama }}</div>
                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                      Klik tombol <b>Tulis Artikel Baru</b> di atas untuk mempublikasikan artikel, even, atau prestasi madrasah/sekolah.
                    </p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($articles->hasPages())
          <div class="mt-4">
            {{ $articles->links() }}
          </div>
        @endif

      </div>
    </div>

  </div>

  <!-- MODAL TAMBAH ARTIKEL LEMBAGA -->
  <div id="modalTambahArtikel" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto p-6 sm:p-8 shadow-2xl space-y-4">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="font-black text-base text-slate-900">Tulis Artikel Baru</h3>
          <p class="text-xs text-slate-500">Publikasi khusus untuk: <b>{{ $item->nama }}</b></p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahArtikel').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-xl"></i>
        </button>
      </div>

      <form action="{{ route('admin.pendidikan.article.store', $kode) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Judul Artikel *</label>
          <input type="text" name="judul" required placeholder="Contoh: Prestasi Santri {{ $item->nama }} Juara 1 Tingkat Kabupaten" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori *</label>
            <select name="category_id" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Status Publikasi *</label>
            <select name="status" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
              <option value="published">Tayangkan Sekarang (Published)</option>
              <option value="draft">Simpan Sebagai Draft</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Penulis</label>
            <input type="text" name="penulis" value="{{ auth()->user()->name }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Publikasi *</label>
            <input type="date" name="tanggal_publikasi" value="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Foto Sampul / Thumbnail (Auto WebP)</label>
          <input type="file" name="thumbnail_file" accept="image/*" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 bg-slate-50">
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Ringkasan Singkat</label>
          <textarea name="ringkasan" rows="2" placeholder="Ulasan ringkas artikel..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Isi Lengkap Konten *</label>
          <textarea name="konten" rows="6" required placeholder="Tulis isi berita / kegiatan di sini..." class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
          <button type="button" onclick="document.getElementById('modalTambahArtikel').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold shadow-md">
            Terbitkan Artikel
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function switchTab(tab) {
      document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-emerald-600', 'text-emerald-800');
        btn.classList.add('border-transparent', 'text-slate-500');
      });

      document.getElementById('tabContent-' + tab).classList.remove('hidden');
      const activeBtn = document.getElementById('tabBtn-' + tab);
      activeBtn.classList.remove('border-transparent', 'text-slate-500');
      activeBtn.classList.add('border-emerald-600', 'text-emerald-800');
    }

    let jurusanIndex = {{ count($jurusanList ?? [1]) }};
    function addJurusanRow() {
      const container = document.getElementById('jurusanContainer');
      const div = document.createElement('div');
      div.className = 'jurusan-row p-4 rounded-2xl bg-blue-50/50 border border-blue-200/80 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center';
      div.innerHTML = `
        <div class="sm:col-span-2">
          <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Kode</label>
          <input type="text" name="jurusan_data[\${jurusanIndex}][kode]" placeholder="RPL" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white uppercase font-bold">
        </div>
        <div class="sm:col-span-4">
          <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Nama Jurusan</label>
          <input type="text" name="jurusan_data[\${jurusanIndex}][nama]" placeholder="Nama Keahlian" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white font-bold">
        </div>
        <div class="sm:col-span-5">
          <label class="block text-[10px] font-bold text-slate-600 mb-0.5">Deskripsi Singkat</label>
          <input type="text" name="jurusan_data[\${jurusanIndex}][deskripsi]" placeholder="Fokus kompetensi..." class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-300 bg-white">
        </div>
        <div class="sm:col-span-1 flex items-end justify-center pt-4 sm:pt-0">
          <button type="button" onclick="this.closest('.jurusan-row').remove()" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
            <i class="fa-solid fa-trash"></i>
          </button>
        </div>
      `;
      container.appendChild(div);
      jurusanIndex++;
    }
  </script>

@endsection
