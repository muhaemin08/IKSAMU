@extends('layouts.app')

@section('title', 'Lembaga Pendidikan Formal - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-emerald-950 text-white py-14 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-15" style="background-image: url('{{ asset('assets/images/gedung-pesantren.webp') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/95 via-emerald-950/85 to-emerald-950/90"></div>
    <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <span class="text-amber-400 font-semibold">Lembaga Pendidikan Formal</span>
      </div>
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white">
        Lembaga Pendidikan Formal Terpadu
      </h1>
      <p class="text-slate-200 text-sm sm:text-base mt-2.5 max-w-3xl leading-relaxed">
        Memadukan kurikulum Kementerian Agama, Kemendikbudristek, dan keilmuan Pesantren Salafiyah guna mencetak santri cerdas iptek, siap kerja, dan berakhlakul karimah.
      </p>
    </div>
  </section>

  <!-- JUMPLINKS & QUICK ACCESS -->
  <div class="sticky top-20 z-30 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-xs py-3.5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-3">
      <div class="flex flex-wrap gap-2 text-xs sm:text-sm font-bold">
        <a href="{{ route('pendidikan.mts') }}" class="px-5 py-2.5 rounded-full bg-emerald-700 text-white hover:bg-emerald-800 transition-all flex items-center gap-2 shadow-sm">
          <i class="fa-solid fa-graduation-cap"></i>
          <span>Halaman Khusus MTs. Miftahul Ulum &rarr;</span>
        </a>
        <a href="{{ route('pendidikan.smk') }}" class="px-5 py-2.5 rounded-full bg-blue-700 text-white hover:bg-blue-800 transition-all flex items-center gap-2 shadow-sm">
          <i class="fa-solid fa-laptop-code"></i>
          <span>Halaman Khusus SMK YAPIM &rarr;</span>
        </a>
      </div>
      <div class="text-xs text-slate-500 font-medium hidden md:flex items-center gap-3">
        <span>Lompat:</span>
        <a href="#mts" class="hover:text-emerald-700 font-semibold">MTs</a>
        <span>•</span>
        <a href="#smk" class="hover:text-blue-700 font-semibold">SMK</a>
      </div>
    </div>
  </div>

  <!-- BAGIAN 1: MTS MIFTAHUL ULUM -->
  @if($mts)
  <section id="mts" class="py-16 bg-white scroll-mt-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        
        <div class="lg:col-span-7 space-y-5">
          <div class="flex flex-wrap items-center gap-2">
            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full font-extrabold text-xs uppercase tracking-wider">
              {{ $mts->jenjang ?? 'MADRASAH TSANAWIYAH' }}
            </span>
            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full font-extrabold text-xs uppercase tracking-wider">
              {{ $mts->akreditasi ?? 'TERAKREDITASI A' }}
            </span>
          </div>

          <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950 leading-tight">
            {{ $mts->nama }}
          </h2>

          <div class="text-xs text-slate-500 font-semibold flex flex-wrap items-center gap-4">
            <span><i class="fa-solid fa-id-card text-emerald-600 mr-1"></i> NPSN: <b>{{ $mts->npsn ?? '-' }}</b></span>
            <span>•</span>
            <span><i class="fa-solid fa-user-tie text-emerald-600 mr-1"></i> Kepala Madrasah: <b>{{ $mts->kepala_sekolah ?? '-' }}</b></span>
          </div>

          <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
            {{ $mts->deskripsi }}
          </p>

          <!-- Keunggulan MTs -->
          @if(!empty($mts->keunggulan) && count($mts->keunggulan) > 0)
            <div class="space-y-3 pt-2">
              <div class="text-xs font-extrabold text-emerald-950 uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span>Keunggulan MTs Miftahul Ulum:</span>
              </div>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-slate-700">
                @foreach($mts->keunggulan as $k)
                  <div class="p-3 bg-emerald-50/60 rounded-xl border border-emerald-100 flex items-start gap-2.5">
                    <i class="fa-solid fa-check text-emerald-600 mt-0.5 text-xs"></i>
                    <span>{{ $k }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Ekstrakurikuler MTs -->
          @if(!empty($mts->ekskul) && count($mts->ekskul) > 0)
            <div class="space-y-2 pt-2">
              <div class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">Ekstrakurikuler Santri MTs:</div>
              <div class="flex flex-wrap gap-2">
                @foreach($mts->ekskul as $ek)
                  <span class="px-3 py-1 bg-slate-100 hover:bg-emerald-50 rounded-lg text-xs font-semibold text-slate-700 border border-slate-200">
                    {{ $ek }}
                  </span>
                @endforeach
              </div>
            </div>
          @endif

          <div class="pt-4 flex items-center gap-3">
            <a href="{{ route('psb') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold text-white bg-emerald-800 hover:bg-emerald-700 shadow-md transition-all">
              <i class="fa-solid fa-file-pen"></i>
              <span>Daftar MTs Miftahul Ulum (PSB)</span>
            </a>
          </div>

        </div>

        <!-- Foto & Akreditasi Showcase -->
        <div class="lg:col-span-5 space-y-5">
          <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-slate-900 relative group">
            <img src="{{ str_starts_with($mts->foto ?? '', 'http') ? $mts->foto : asset($mts->foto ?? 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=800&q=80') }}" 
                 alt="{{ $mts->nama }}" 
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/90 via-transparent to-transparent flex items-end p-6">
              <div class="text-white">
                <span class="px-2.5 py-1 rounded bg-amber-500 text-slate-950 font-bold text-xs uppercase">
                  {{ $mts->akreditasi ?? 'Terakreditasi A' }}
                </span>
                <h3 class="font-extrabold text-lg mt-1">{{ $mts->nama }}</h3>
                <p class="text-xs text-emerald-200">Kampus Terpadu Gunung Bubut</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- PROFIL KEPALA MADRASAH MTS -->
      <div class="bg-gradient-to-br from-emerald-900 to-teal-950 rounded-3xl p-6 sm:p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-6 sm:gap-8">
          
          <div class="shrink-0 text-center">
            <div class="w-32 h-40 sm:w-36 sm:h-44 rounded-2xl overflow-hidden border-3 border-amber-400 shadow-2xl bg-slate-900 mx-auto">
              <img src="{{ str_starts_with($mts->foto_kepala_sekolah ?? '', 'http') ? $mts->foto_kepala_sekolah : asset($mts->foto_kepala_sekolah ?? 'assets/images/pimpinan_1792662555.jpeg') }}" 
                   onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80';"
                   alt="{{ $mts->kepala_sekolah }}" 
                   class="w-full h-full object-cover">
            </div>
            <span class="inline-block px-3 py-1 bg-amber-400 text-slate-950 font-black text-[10px] rounded-full uppercase tracking-wider mt-2.5 shadow-sm">
              Kepala Madrasah
            </span>
          </div>

          <div class="flex-1 text-center md:text-left space-y-3">
            <div>
              <h3 class="text-xl sm:text-2xl font-black text-amber-300">{{ $mts->kepala_sekolah }}</h3>
              <p class="text-xs text-emerald-200 mt-0.5">
                Kepala MTs. Miftahul Ulum Gunung Bubut @if($mts->nip_kepala_sekolah) • NIP: {{ $mts->nip_kepala_sekolah }} @endif
              </p>
            </div>
            
            @if($mts->sambutan_kepala_sekolah)
              <div class="relative bg-emerald-950/60 rounded-2xl p-4 sm:p-5 border border-emerald-800/80 text-xs sm:text-sm text-slate-200 leading-relaxed italic">
                <i class="fa-solid fa-quote-left text-amber-400 text-lg mr-2 opacity-80"></i>
                <span>{{ $mts->sambutan_kepala_sekolah }}</span>
              </div>
            @endif
          </div>

        </div>
      </div>

      <!-- ARTIKEL & KEGIATAN KHUSUS MTS -->
      @if($mts->articles && $mts->articles->count() > 0)
        <div class="pt-8 border-t border-slate-100">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h3 class="text-xl font-extrabold text-emerald-950 flex items-center gap-2">
                <i class="fa-solid fa-newspaper text-emerald-600"></i>
                <span>Artikel & Kabar Terkini {{ $mts->nama }}</span>
              </h3>
              <p class="text-xs text-slate-500 mt-0.5">Informasi, even, dan prestasi santri madrasah</p>
            </div>
            <a href="{{ route('publikasi') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
              <span>Semua Publikasi</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($mts->articles as $art)
              <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-200 shadow-2xs hover-card-elevate flex flex-col justify-between">
                <div class="aspect-video overflow-hidden bg-slate-200 relative">
                  @if($art->thumbnail)
                    <img src="{{ asset($art->thumbnail) }}" alt="{{ $art->judul }}" class="w-full h-full object-cover">
                  @else
                    <div class="w-full h-full flex items-center justify-center text-slate-400 bg-emerald-950 text-2xl">
                      <i class="fa-solid fa-graduation-cap text-amber-400"></i>
                    </div>
                  @endif
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                  <div>
                    <div class="text-[10px] text-slate-400 mb-1 flex items-center gap-1.5">
                      <i class="fa-regular fa-calendar"></i>
                      <span>{{ $art->tanggal_publikasi ? $art->tanggal_publikasi->translatedFormat('d M Y') : '' }}</span>
                    </div>
                    <h4 class="font-bold text-sm text-slate-900 line-clamp-2 hover:text-emerald-700">
                      <a href="{{ route('publikasi.detail', $art->slug) }}">{{ $art->judul }}</a>
                    </h4>
                    <p class="text-xs text-slate-500 line-clamp-2 mt-1">{{ $art->ringkasan }}</p>
                  </div>
                  <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs font-semibold">
                    <span class="text-slate-500 text-[11px]">{{ $art->penulis }}</span>
                    <a href="{{ route('publikasi.detail', $art->slug) }}" class="text-emerald-700 hover:text-amber-600 flex items-center gap-1">
                      <span>Baca</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </section>
  @endif

  <!-- BAGIAN 2: SMK YAPIM KABUPATEN TASIKMALAYA -->
  @if($smk)
  <section id="smk" class="py-16 bg-slate-50 border-t border-slate-200/80 scroll-mt-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
      
      <div class="text-center max-w-3xl mx-auto">
        <span class="text-xs font-extrabold tracking-widest text-blue-700 uppercase bg-blue-100 px-3.5 py-1.5 rounded-full border border-blue-200">
          Vokasi Kejuruan Santri Terdepan
        </span>
        <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3">{{ $smk->nama }}</h2>
        <div class="islamic-divider"><i class="fa-solid fa-laptop-code text-blue-600"></i></div>
        <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">{{ $smk->deskripsi }}</p>
        <div class="mt-4 flex flex-wrap justify-center items-center gap-4 text-xs font-semibold text-slate-600">
          <span><i class="fa-solid fa-id-card text-blue-600 mr-1"></i> NPSN: <b>{{ $smk->npsn ?? '-' }}</b></span>
          <span>•</span>
          <span><i class="fa-solid fa-award text-amber-500 mr-1"></i> Akreditasi: <b>{{ $smk->akreditasi ?? 'Terakreditasi' }}</b></span>
          <span>•</span>
          <span><i class="fa-solid fa-user-tie text-blue-600 mr-1"></i> Kepala Sekolah: <b>{{ $smk->kepala_sekolah ?? '-' }}</b></span>
        </div>
      </div>

      <!-- FOTO UTAMA & KEUNGGULAN SMK -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-5">
          <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-slate-900 relative group">
            <img src="{{ str_starts_with($smk->foto ?? '', 'http') ? $smk->foto : asset($smk->foto ?? 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=800&q=80') }}" 
                 alt="{{ $smk->nama }}" 
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-950/90 via-transparent to-transparent flex items-end p-6">
              <div class="text-white">
                <span class="px-2.5 py-1 rounded bg-blue-600 text-white font-bold text-xs uppercase">
                  Vokasi & Teknologi
                </span>
                <h3 class="font-extrabold text-lg mt-1">{{ $smk->nama }}</h3>
                <p class="text-xs text-blue-200">Mencetak Santri Terampil & Mandiri</p>
              </div>
            </div>
          </div>
        </div>

        <div class="lg:col-span-7 space-y-4">
          @if(!empty($smk->keunggulan) && count($smk->keunggulan) > 0)
            <div class="space-y-3">
              <div class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-award text-blue-600"></i>
                <span>Keunggulan SMK YAPIM:</span>
              </div>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-slate-700">
                @foreach($smk->keunggulan as $k)
                  <div class="p-3 bg-white rounded-xl border border-blue-100 flex items-start gap-2.5 shadow-2xs">
                    <i class="fa-solid fa-check text-blue-600 mt-0.5 text-xs"></i>
                    <span>{{ $k }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          @if(!empty($smk->ekskul) && count($smk->ekskul) > 0)
            <div class="space-y-2 pt-2">
              <div class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">Ekstrakurikuler & Keahlian:</div>
              <div class="flex flex-wrap gap-2">
                @foreach($smk->ekskul as $ek)
                  <span class="px-3 py-1 bg-white hover:bg-blue-50 rounded-lg text-xs font-semibold text-slate-700 border border-slate-200">
                    {{ $ek }}
                  </span>
                @endforeach
              </div>
            </div>
          @endif

          <div class="pt-4">
            <a href="{{ route('psb') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold text-white bg-blue-700 hover:bg-blue-800 shadow-md transition-all">
              <i class="fa-solid fa-file-pen"></i>
              <span>Daftar SMK YAPIM (PSB Online)</span>
            </a>
          </div>
        </div>
      </div>

      <!-- PROFIL KEPALA SEKOLAH SMK YAPIM -->
      <div class="bg-gradient-to-br from-blue-900 to-indigo-950 rounded-3xl p-6 sm:p-8 text-white shadow-xl relative overflow-hidden">
        <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-6 sm:gap-8">
          
          <div class="shrink-0 text-center">
            <div class="w-32 h-40 sm:w-36 sm:h-44 rounded-2xl overflow-hidden border-3 border-amber-400 shadow-2xl bg-slate-900 mx-auto">
              <img src="{{ str_starts_with($smk->foto_kepala_sekolah ?? '', 'http') ? $smk->foto_kepala_sekolah : asset($smk->foto_kepala_sekolah ?? 'assets/images/pimpinan_1792662555.jpeg') }}" 
                   onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80';"
                   alt="{{ $smk->kepala_sekolah }}" 
                   class="w-full h-full object-cover">
            </div>
            <span class="inline-block px-3 py-1 bg-amber-400 text-slate-950 font-black text-[10px] rounded-full uppercase tracking-wider mt-2.5 shadow-sm">
              Kepala Sekolah
            </span>
          </div>

          <div class="flex-1 text-center md:text-left space-y-3">
            <div>
              <h3 class="text-xl sm:text-2xl font-black text-amber-300">{{ $smk->kepala_sekolah }}</h3>
              <p class="text-xs text-blue-200 mt-0.5">
                Kepala {{ $smk->nama }} @if($smk->nip_kepala_sekolah) • NIP: {{ $smk->nip_kepala_sekolah }} @endif
              </p>
            </div>
            
            @if($smk->sambutan_kepala_sekolah)
              <div class="relative bg-blue-950/60 rounded-2xl p-4 sm:p-5 border border-blue-800/80 text-xs sm:text-sm text-slate-200 leading-relaxed italic">
                <i class="fa-solid fa-quote-left text-amber-400 text-lg mr-2 opacity-80"></i>
                <span>{{ $smk->sambutan_kepala_sekolah }}</span>
              </div>
            @endif
          </div>

        </div>
      </div>

      <!-- DAFTAR PROGRAM KEAHLIAN / JURUSAN DINAMIS -->
      @if(!empty($smk->jurusan) && count($smk->jurusan) > 0)
        <div>
          <div class="text-center mb-8">
            <h3 class="text-2xl font-extrabold text-slate-900">Program Keahlian / Jurusan</h3>
            <p class="text-xs text-slate-500 mt-1">Pilihan kompetensi vokasi siap kerja untuk santri</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($smk->jurusan as $jurusan)
              <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-xs hover-card-elevate flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-black uppercase px-2.5 py-1 bg-blue-100 text-blue-800 rounded-lg">
                      {{ $jurusan['kode'] ?? 'JURUSAN' }}
                    </span>
                    <i class="fa-solid fa-code text-blue-500"></i>
                  </div>
                  <h4 class="font-black text-lg text-slate-900 mb-2">{{ $jurusan['nama'] ?? '' }}</h4>
                  <p class="text-xs text-slate-600 leading-relaxed">{{ $jurusan['deskripsi'] ?? '' }}</p>
                </div>
                <div class="pt-6 border-t border-slate-100 mt-6 flex items-center justify-between text-xs font-bold text-blue-700">
                  <span><i class="fa-solid fa-certificate text-emerald-600 mr-1"></i> Sertifikasi BNSP</span>
                  <span class="text-slate-400 text-[10px]">Siap Kerja</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- ARTIKEL & KEGIATAN KHUSUS SMK YAPIM -->
      @if($smk->articles && $smk->articles->count() > 0)
        <div class="pt-8 border-t border-slate-200">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h3 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-newspaper text-blue-600"></i>
                <span>Artikel & Kegiatan {{ $smk->nama }}</span>
              </h3>
              <p class="text-xs text-slate-500 mt-0.5">Informasi teknologi, prestasi vokasi, dan kabar sekolah</p>
            </div>
            <a href="{{ route('publikasi') }}" class="text-xs font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
              <span>Semua Publikasi</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($smk->articles as $art)
              <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-2xs hover-card-elevate flex flex-col justify-between">
                <div class="aspect-video overflow-hidden bg-slate-200 relative">
                  @if($art->thumbnail)
                    <img src="{{ asset($art->thumbnail) }}" alt="{{ $art->judul }}" class="w-full h-full object-cover">
                  @else
                    <div class="w-full h-full flex items-center justify-center text-slate-400 bg-blue-950 text-2xl">
                      <i class="fa-solid fa-laptop-code text-cyan-400"></i>
                    </div>
                  @endif
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                  <div>
                    <div class="text-[10px] text-slate-400 mb-1 flex items-center gap-1.5">
                      <i class="fa-regular fa-calendar"></i>
                      <span>{{ $art->tanggal_publikasi ? $art->tanggal_publikasi->translatedFormat('d M Y') : '' }}</span>
                    </div>
                    <h4 class="font-bold text-sm text-slate-900 line-clamp-2 hover:text-blue-700">
                      <a href="{{ route('publikasi.detail', $art->slug) }}">{{ $art->judul }}</a>
                    </h4>
                    <p class="text-xs text-slate-500 line-clamp-2 mt-1">{{ $art->ringkasan }}</p>
                  </div>
                  <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs font-semibold">
                    <span class="text-slate-500 text-[11px]">{{ $art->penulis }}</span>
                    <a href="{{ route('publikasi.detail', $art->slug) }}" class="text-blue-700 hover:text-blue-900 flex items-center gap-1">
                      <span>Baca</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </section>
  @endif

@endsection
