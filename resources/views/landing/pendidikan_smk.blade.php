@extends('layouts.app')

@section('title', ($smk->nama ?? 'SMK YAPIM KABUPATEN TASIKMALAYA') . ' - Pondok Pesantren Miftahul Ulum')

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-gradient-to-r from-blue-950 via-slate-900 to-indigo-950 text-white py-14 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-15" style="background-image: url('{{ asset('assets/images/gedung-pesantren.webp') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 via-blue-950/85 to-blue-950/90"></div>
    <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-blue-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <a href="{{ route('pendidikan') }}" class="hover:text-amber-400">Pendidikan Formal</a>
        <span>/</span>
        <span class="text-amber-400 font-semibold">SMK YAPIM</span>
      </div>
      <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mb-2">
        <span class="px-3 py-1 bg-blue-500/30 text-blue-200 border border-blue-400/40 rounded-full font-extrabold text-xs uppercase tracking-wider">
          {{ $smk->jenjang ?? 'SEKOLAH MENENGAH KEJURUAN' }}
        </span>
        <span class="px-3 py-1 bg-amber-400 text-slate-950 rounded-full font-black text-xs uppercase tracking-wider">
          {{ $smk->akreditasi ?? 'TERAKREDITASI' }}
        </span>
      </div>
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white">
        {{ $smk->nama }}
      </h1>
      <p class="text-slate-200 text-sm sm:text-base mt-2.5 max-w-3xl leading-relaxed">
        Lembaga pendidikan kejuruan vokasi terpadu di lingkungan Pondok Pesantren Miftahul Ulum Gunung Bubut yang membina santri siap kerja, wirausahawan mandiri, bersertifikasi BNSP, dan berakhlak Qur'ani.
      </p>
    </div>
  </section>

  <!-- QUICK NAVIGATION SWITCHER -->
  <div class="bg-white border-b border-slate-200 py-3 shadow-2xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4 text-xs">
      <div class="flex items-center gap-2">
        <span class="text-slate-400 font-semibold">Lembaga Formal:</span>
        @if($mts)
          <a href="{{ route('pendidikan.mts') }}" class="px-3 py-1.5 rounded-full bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-800 font-bold flex items-center gap-1.5 transition-colors">
            <i class="fa-solid fa-graduation-cap text-emerald-600"></i> {{ $mts->nama }}
          </a>
        @endif
        <span class="px-3 py-1.5 rounded-full bg-blue-100 text-blue-900 font-bold flex items-center gap-1.5">
          <i class="fa-solid fa-laptop-code text-blue-700"></i> {{ $smk->nama }}
        </span>
      </div>
      <a href="{{ route('psb') }}" class="hidden sm:inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-xs transition-all">
        <i class="fa-solid fa-file-pen text-amber-400"></i>
        <span>Daftar Santri Baru (PSB)</span>
      </a>
    </div>
  </div>

  <!-- KONTEN UTAMA SMK YAPIM -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
      
      <!-- GRID PROFIL & FOTO -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
        
        <div class="lg:col-span-7 space-y-5">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
            Vokasi Kejuruan Santri Terdepan: Siap Kerja, Berdaya Saing, dan Berjiwa Wirausaha
          </h2>

          <div class="text-xs text-slate-500 font-semibold flex flex-wrap items-center gap-4 py-2 border-y border-slate-100">
            <span><i class="fa-solid fa-id-card text-blue-600 mr-1"></i> NPSN: <b>{{ $smk->npsn ?? '-' }}</b></span>
            <span>•</span>
            <span><i class="fa-solid fa-award text-amber-500 mr-1"></i> Akreditasi: <b>{{ $smk->akreditasi ?? 'Terakreditasi' }}</b></span>
            <span>•</span>
            <span><i class="fa-solid fa-user-tie text-blue-600 mr-1"></i> Kepala Sekolah: <b>{{ $smk->kepala_sekolah ?? '-' }}</b></span>
          </div>

          <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
            {{ $smk->deskripsi }}
          </p>

          <!-- Keunggulan SMK -->
          @if(!empty($smk->keunggulan) && count($smk->keunggulan) > 0)
            <div class="space-y-3 pt-2">
              <div class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                <i class="fa-solid fa-certificate text-blue-600"></i>
                <span>Keunggulan SMK YAPIM:</span>
              </div>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-slate-700">
                @foreach($smk->keunggulan as $k)
                  <div class="p-3 bg-blue-50/60 rounded-xl border border-blue-100 flex items-start gap-2.5">
                    <i class="fa-solid fa-check text-blue-600 mt-0.5 text-xs"></i>
                    <span>{{ $k }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Ekstrakurikuler SMK -->
          @if(!empty($smk->ekskul) && count($smk->ekskul) > 0)
            <div class="space-y-2 pt-2">
              <div class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">Ekstrakurikuler & Keahlian:</div>
              <div class="flex flex-wrap gap-2">
                @foreach($smk->ekskul as $ek)
                  <span class="px-3 py-1 bg-slate-100 hover:bg-blue-50 rounded-lg text-xs font-semibold text-slate-700 border border-slate-200">
                    {{ $ek }}
                  </span>
                @endforeach
              </div>
            </div>
          @endif

          <div class="pt-4 flex items-center gap-3">
            <a href="{{ route('psb') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold text-white bg-blue-700 hover:bg-blue-800 shadow-md transition-all">
              <i class="fa-solid fa-file-pen"></i>
              <span>Daftar SMK YAPIM Online</span>
            </a>
            <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-xs font-bold text-slate-800 bg-slate-100 border border-slate-200 hover:bg-slate-200 transition-all">
              <i class="fa-solid fa-phone"></i>
              <span>Hubungi Sekolah</span>
            </a>
          </div>

        </div>

        <!-- Foto Utama Showcase -->
        <div class="lg:col-span-5 space-y-5">
          <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200 aspect-[4/3] bg-slate-900 relative group">
            <img src="{{ str_starts_with($smk->foto ?? '', 'http') ? $smk->foto : asset($smk->foto ?? 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=800&q=80') }}" 
                 alt="{{ $smk->nama }}" 
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-950/90 via-transparent to-transparent flex items-end p-6">
              <div class="text-white">
                <span class="px-2.5 py-1 rounded bg-blue-600 text-white font-bold text-xs uppercase">
                  Vokasi & IT
                </span>
                <h3 class="font-extrabold text-lg mt-1">{{ $smk->nama }}</h3>
                <p class="text-xs text-blue-200">Kampus Terpadu Ponpes Miftahul Ulum</p>
              </div>
            </div>
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
            <span class="text-xs font-extrabold tracking-widest text-blue-700 uppercase bg-blue-100 px-3.5 py-1.5 rounded-full border border-blue-200">
              Kompetensi Keahlian
            </span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Pilihan Program Keahlian / Jurusan</h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Disiapkan untuk menghadapi dunia kerja industri dan wirausaha digital</p>
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
        <div class="pt-8 border-t border-slate-100">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-newspaper text-blue-600"></i>
                <span>Kabar, Prestasi & Kegiatan {{ $smk->nama }}</span>
              </h3>
              <p class="text-xs text-slate-500 mt-0.5">Informasi teknologi, prestasi vokasi, dan kabar sekolah</p>
            </div>
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

          @if($smk->articles instanceof \Illuminate\Pagination\LengthAwarePaginator && $smk->articles->hasPages())
            <div class="mt-6">
              {{ $smk->articles->links() }}
            </div>
          @endif
        </div>
      @endif

      <!-- BANNER JALUR MTS -->
      @if($mts)
        <div class="p-6 sm:p-8 rounded-3xl bg-emerald-50 border border-emerald-200 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
          <div class="flex items-center gap-4 text-center sm:text-left">
            <div class="w-14 h-14 rounded-2xl bg-emerald-700 text-white flex items-center justify-center text-2xl shrink-0 shadow-sm">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
              <span class="text-[10px] font-extrabold uppercase text-emerald-800 tracking-wider">Jenjang Menengah Pertama</span>
              <h4 class="text-base sm:text-lg font-black text-slate-900 mt-0.5">{{ $mts->nama }}</h4>
              <p class="text-xs text-slate-600">Madrasah Tsanawiyah Terakreditasi A terpadu dengan pesantren salafiyah dan tahfidz.</p>
            </div>
          </div>
          <a href="{{ route('pendidikan.mts') }}" class="px-5 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2 shrink-0">
            <span>Buka Profil MTs Miftahul Ulum</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      @endif

    </div>
  </section>

@endsection
