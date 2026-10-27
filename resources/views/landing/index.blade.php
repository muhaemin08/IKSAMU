@extends('layouts.app')

@section('title', ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum') . ' - Beranda')

@section('content')

  <!-- HERO SECTION WITH FULL-BLEED SLIDER & CENTERED CONTENT -->
  <section id="heroSection" class="relative min-h-[580px] sm:min-h-[640px] lg:min-h-[720px] flex items-center justify-center text-white overflow-hidden bg-emerald-950">
    
    <!-- 1. FULL BACKGROUND IMAGE SLIDER (RANDOM SEQUENCE AUTO-SLIDE) -->
    <div id="heroSliderContainer" class="absolute inset-0 z-0">
      @php
        $heroSlides = [
          [
            'img' => asset('assets/images/slider/slide-1.png'),
            'caption' => 'Kompleks Pesantren Miftahul Ulum Gunung Bubut'
          ],
          [
            'img' => asset('assets/images/slider/slide-2.jpg'),
            'caption' => 'Gedung Utama & Asrama Pondok Pesantren'
          ],
          [
            'img' => asset('assets/images/slider/slide-3.png'),
            'caption' => 'Haul Akbar & Khidmah Keilmuan Para Masayikh'
          ],
          [
            'img' => asset('assets/images/slider/slide-4.png'),
            'caption' => 'Rutinitas & Tradisi Keilmuan Santri Mukim'
          ],
          [
            'img' => asset('assets/images/slider/slide-5.png'),
            'caption' => 'Kampus Pendidikan Formal MTs & SMK Miftahul Ulum'
          ]
        ];
      @endphp

      @foreach($heroSlides as $i => $slide)
        <div class="hero-bg-slide absolute inset-0 transition-all duration-1000 ease-in-out transform scale-100 opacity-0 pointer-events-none" 
             data-index="{{ $i }}" 
             style="background-image: url('{{ $slide['img'] }}'); background-size: cover; background-position: center;">
        </div>
      @endforeach
    </div>

    <!-- 2. HIGH-CONTRAST OVERLAYS FOR MAXIMUM TEXT READABILITY -->
    <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/90 via-emerald-950/75 to-emerald-950/95 z-10 pointer-events-none"></div>
    <div class="absolute inset-0 bg-black/40 z-10 pointer-events-none"></div>
    <div class="absolute inset-0 bg-islamic-pattern opacity-15 z-10 pointer-events-none"></div>

    <!-- 3. CENTERED HERO CONTENT -->
    <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24 lg:py-28 text-center flex flex-col items-center justify-center">
      
      <!-- Top Badge / Ribbon -->
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-900/80 border border-amber-400/40 text-amber-300 text-xs sm:text-sm font-semibold backdrop-blur-md shadow-lg mb-6">
        <i class="fa-solid fa-mosque text-amber-400 text-xs sm:text-sm"></i>
        <span>Selamat Datang di Website Resmi</span>
      </div>

      <!-- Main Headline: Centered, Bold & Ultra Clear -->
      <h1 class="text-3xl sm:text-5xl md:text-6xl font-black tracking-tight leading-tight text-white drop-shadow-[0_4px_16px_rgba(0,0,0,0.85)]">
        {{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum' }}
        <span class="block mt-2.5 text-2xl sm:text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-amber-400 to-amber-200 drop-shadow-[0_2px_10px_rgba(0,0,0,0.9)] tracking-wide">
          {{ $settings['site_subname'] ?? 'GUNUNG BUBUT – TASIKMALAYA' }}
        </span>
      </h1>

      <!-- Subtitle Description -->
      <p class="text-slate-100 text-sm sm:text-base md:text-lg max-w-3xl mx-auto leading-relaxed font-normal mt-5 drop-shadow-[0_2px_6px_rgba(0,0,0,0.85)]">
        {{ $settings['hero_subtitle'] ?? 'Lembaga pendidikan Islam yang memadukan tradisi keilmuan kitab salafiyah ala Ahlussunnah wal Jama\'ah An-Nahdliyyah dengan pendidikan formal terpadu MTs & SMK Miftahul Ulum guna mencetak santri yang berakhlak mulia, cerdas, dan mandiri.' }}
      </p>

      <!-- Centered Action Buttons (CTA) -->
      <div class="pt-8 flex flex-wrap items-center justify-center gap-3.5 sm:gap-5">
        <a href="{{ route('psb') }}" class="inline-flex items-center gap-2.5 px-6 sm:px-8 py-3.5 sm:py-4 rounded-full font-bold text-xs sm:text-sm text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 hover:from-amber-300 hover:to-amber-400 shadow-2xl hover:shadow-amber-500/40 hover:scale-105 active:scale-95 transition-all cursor-pointer">
          <i class="fa-solid fa-file-pen text-slate-950 text-sm sm:text-base"></i>
          <span>Pendaftaran Santri Baru (PSB)</span>
        </a>
        <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 px-6 sm:px-8 py-3.5 sm:py-4 rounded-full font-bold text-xs sm:text-sm text-white bg-emerald-900/80 hover:bg-emerald-800 border border-emerald-500/60 hover:border-amber-400 backdrop-blur-md shadow-xl hover:scale-105 active:scale-95 transition-all cursor-pointer">
          <i class="fa-solid fa-compass text-amber-400 text-sm sm:text-base"></i>
          <span>Profil & Sejarah Pesantren</span>
        </a>
      </div>

      <!-- Quick Feature Shortcut Pills (Centered 4-item grid) -->
      <div class="pt-10 w-full max-w-4xl grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3.5 text-xs">
        <a href="{{ route('pendidikan.mts') }}" class="p-3 bg-emerald-950/70 hover:bg-emerald-900/90 rounded-2xl border border-emerald-800/80 hover:border-amber-400/80 backdrop-blur-md transition-all flex items-center justify-center sm:justify-start gap-2.5 group">
          <div class="w-8 h-8 rounded-xl bg-emerald-800/80 group-hover:bg-amber-500 text-amber-400 group-hover:text-slate-950 flex items-center justify-center transition-colors shrink-0">
            <i class="fa-solid fa-graduation-cap text-xs"></i>
          </div>
          <div class="text-left">
            <div class="font-extrabold text-white text-xs">MTs MU</div>
            <div class="text-[10px] text-emerald-200">Akreditasi A</div>
          </div>
        </a>

        <a href="{{ route('pendidikan.smk') }}" class="p-3 bg-emerald-950/70 hover:bg-emerald-900/90 rounded-2xl border border-emerald-800/80 hover:border-amber-400/80 backdrop-blur-md transition-all flex items-center justify-center sm:justify-start gap-2.5 group">
          <div class="w-8 h-8 rounded-xl bg-emerald-800/80 group-hover:bg-amber-500 text-amber-400 group-hover:text-slate-950 flex items-center justify-center transition-colors shrink-0">
            <i class="fa-solid fa-laptop-code text-xs"></i>
          </div>
          <div class="text-left">
            <div class="font-extrabold text-white text-xs">SMK MU</div>
            <div class="text-[10px] text-emerald-200">Vokasi & IT</div>
          </div>
        </a>

        <a href="{{ route('asrama') }}#asrama-selamet" class="p-3 bg-emerald-950/70 hover:bg-emerald-900/90 rounded-2xl border border-emerald-800/80 hover:border-amber-400/80 backdrop-blur-md transition-all flex items-center justify-center sm:justify-start gap-2.5 group">
          <div class="w-8 h-8 rounded-xl bg-emerald-800/80 group-hover:bg-amber-500 text-amber-400 group-hover:text-slate-950 flex items-center justify-center transition-colors shrink-0">
            <i class="fa-solid fa-hotel text-xs"></i>
          </div>
          <div class="text-left">
            <div class="font-extrabold text-white text-xs">Asrama Putra</div>
            <div class="text-[10px] text-emerald-200">Selamet & Rahayu</div>
          </div>
        </a>

        <a href="{{ route('asrama') }}#asrama-alhidayah" class="p-3 bg-emerald-950/70 hover:bg-emerald-900/90 rounded-2xl border border-emerald-800/80 hover:border-amber-400/80 backdrop-blur-md transition-all flex items-center justify-center sm:justify-start gap-2.5 group">
          <div class="w-8 h-8 rounded-xl bg-emerald-800/80 group-hover:bg-amber-500 text-amber-400 group-hover:text-slate-950 flex items-center justify-center transition-colors shrink-0">
            <i class="fa-solid fa-heart text-xs"></i>
          </div>
          <div class="text-left">
            <div class="font-extrabold text-white text-xs">Asrama Putri</div>
            <div class="text-[10px] text-emerald-200">Al-Hidayah</div>
          </div>
        </a>
      </div>

      <!-- Slide Indicator Dots -->
      <div class="pt-6 flex items-center justify-center gap-2 z-20">
        @foreach($heroSlides as $i => $slide)
          <button type="button" 
                  class="hero-dot h-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-amber-400 w-7' : 'bg-white/40 hover:bg-white/80 w-2' }} cursor-pointer" 
                  data-to="{{ $i }}" 
                  title="{{ $slide['caption'] }}"></button>
        @endforeach
      </div>

    </div>

    <!-- Navigation Arrows Left & Right -->
    <button type="button" id="prevHeroSlide" class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-slate-900/40 hover:bg-emerald-800/80 border border-white/20 text-white flex items-center justify-center text-sm backdrop-blur-md transition-all hover:scale-110 active:scale-95 z-30 cursor-pointer shadow-lg" aria-label="Slide Sebelumnya">
      <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button type="button" id="nextHeroSlide" class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-slate-900/40 hover:bg-emerald-800/80 border border-white/20 text-white flex items-center justify-center text-sm backdrop-blur-md transition-all hover:scale-110 active:scale-95 z-30 cursor-pointer shadow-lg" aria-label="Slide Selanjutnya">
      <i class="fa-solid fa-chevron-right"></i>
    </button>

    <!-- Wave divider bottom -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none text-slate-50 z-20 pointer-events-none">
      <svg class="block w-full h-8 sm:h-12" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,20 1200,60 L1200,120 L0,120 Z" fill="currentColor"></path>
      </svg>
    </div>
  </section>

  <!-- SAMBUTAN PIMPINAN PESANTREN -->
  <section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 items-center">
          
          <div class="lg:col-span-4 bg-emerald-900 p-8 sm:p-10 text-white text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
            <div class="relative z-10 space-y-4">
              <div class="w-36 h-36 mx-auto rounded-full p-1.5 bg-gradient-to-tr from-amber-400 to-emerald-400 shadow-xl overflow-hidden">
                <img src="{{ str_starts_with($settings['sambutan_foto'] ?? '', 'http') ? $settings['sambutan_foto'] : asset($settings['sambutan_foto'] ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80') }}" 
                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80';"
                     alt="Pimpinan Pesantren" class="w-full h-full object-cover rounded-full">
              </div>
              <div>
                <h3 class="font-bold text-lg text-amber-300">{{ $settings['sambutan_nama'] ?? 'K.H. Ahmad Mubarok, M.Pd.I' }}</h3>
                <p class="text-xs text-emerald-200 uppercase tracking-widest mt-0.5">{{ $settings['sambutan_jabatan'] ?? 'Pimpinan Pondok Pesantren' }}</p>
              </div>
              <div class="text-xs text-slate-300 border-t border-emerald-800/80 pt-3">
                "Menjaga Warisan Salaf, Meraih Kejayaan Masa Depan dengan Akhlaqul Karimah"
              </div>
            </div>
          </div>

          <div class="lg:col-span-8 p-8 sm:p-10 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase tracking-wider">
              <i class="fa-solid fa-quote-left"></i> Kalimat Sambutan
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-emerald-950">
              Selamat Datang di Portal Resmi {{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum' }}
            </h2>
            <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3">
              <p>{!! nl2br(e($settings['sambutan_teks'] ?? 'Assalamu’alaikum Warahmatullahi Wabarakatuh. Alhamdulillah, segala puji dan syukur kita panjatkan ke hadirat Allah SWT.')) !!}</p>
            </div>
            <div class="pt-2 flex items-center gap-4">
              <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-800 hover:text-amber-600 transition-colors">
                <span>Pelajari Selengkapnya Tentang Pesantren</span>
                <i class="fa-solid fa-arrow-right text-xs"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- 4 PILAR UTAMA PESANTREN -->
  <section class="py-16 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
          Struktur Lembaga Terpadu
        </span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950 mt-3">
          Sistem Pendidikan Komprehensif Miftahul Ulum
        </h2>
        <div class="islamic-divider">
          <i class="fa-solid fa-star-and-crescent text-amber-500"></i>
        </div>
        <p class="text-slate-600 text-sm sm:text-base">
          Mewadahi tumbuh kembang santri secara holistik dari sisi ruhaniyah, ilmu syar'i, sains formal, hingga keterampilan teknologi.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Kartu 1: Tentang -->
        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/80 hover-card-elevate flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-2xl mb-5 shadow-sm">
              <i class="fa-solid fa-mosque"></i>
            </div>
            <h3 class="font-extrabold text-lg text-emerald-950 mb-2">Profil & Masayikh</h3>
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4">
              Sejarah perjuangan muassis KH. Zaenal Abidin dan bimbingan langsung para Dewan Masayikh yang tersambung sanad keilmuannya.
            </p>
          </div>
          <a href="{{ route('profil') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl text-xs font-bold text-emerald-800 bg-white border border-emerald-200 hover:bg-emerald-800 hover:text-white transition-all">
            <span>Buka Profil</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

        <!-- Kartu 2: Asrama -->
        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/80 hover-card-elevate flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-2xl mb-5 shadow-sm">
              <i class="fa-solid fa-hotel"></i>
            </div>
            <h3 class="font-extrabold text-lg text-emerald-950 mb-2">Asrama Putra & Putri</h3>
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4">
              Lingkungan mukim yang sejuk, aman, dan disiplin 24 jam dengan bimbingan rohani, tahfidz, dan kemandirian hidup.
            </p>
          </div>
          <a href="{{ route('asrama') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl text-xs font-bold text-amber-800 bg-white border border-amber-200 hover:bg-amber-600 hover:text-white transition-all">
            <span>Buka Asrama</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

        <!-- Kartu 3: Pendidikan Formal -->
        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/80 hover-card-elevate flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-800 flex items-center justify-center text-2xl mb-5 shadow-sm">
              <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h3 class="font-extrabold text-lg text-emerald-950 mb-2">Pendidikan Formal</h3>
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4">
              Mewujudkan santri cerdas iptek dengan ijazah resmi negara melalui MTs Miftahul Ulum & SMK Miftahul Ulum.
            </p>
          </div>
          <a href="{{ route('pendidikan') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl text-xs font-bold text-blue-800 bg-white border border-blue-200 hover:bg-blue-600 hover:text-white transition-all">
            <span>Buka Pendidikan</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

        <!-- Kartu 4: Publikasi -->
        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/80 hover-card-elevate flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-800 flex items-center justify-center text-2xl mb-5 shadow-sm">
              <i class="fa-solid fa-bullhorn"></i>
            </div>
            <h3 class="font-extrabold text-lg text-emerald-950 mb-2">Publikasi & Warta</h3>
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4">
              Kanal warta kegiatan pondok, kajian artikel keislaman dari asatidz, serta agenda even akbar santri.
            </p>
          </div>
          <a href="{{ route('publikasi') }}" class="inline-flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl text-xs font-bold text-purple-800 bg-white border border-purple-200 hover:bg-purple-600 hover:text-white transition-all">
            <span>Buka Publikasi</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
          </a>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION FASILITAS PESANTREN DINAMIS -->
  <section id="fasilitas" class="py-16 bg-white border-t border-slate-200/60 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs font-extrabold tracking-widest text-emerald-700 uppercase bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">
          Sarana & Prasarana Terpadu
        </span>
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-emerald-950 mt-3">
          Fasilitas Pondok Pesantren
        </h2>
        <div class="islamic-divider">
          <i class="fa-solid fa-building-columns text-amber-500"></i>
        </div>
        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-xl mx-auto">
          Fasilitas ibadah, asrama kobong santri, sarana olahraga, dan ruang belajar representatif guna menunjang kenyamanan serta tumbuh kembang santri secara holistik.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($fasilitas as $f)
          <div class="group bg-slate-50 rounded-3xl overflow-hidden border border-slate-200/80 shadow-2xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
            <div>
              <div class="aspect-[16/10] w-full bg-slate-900 overflow-hidden relative">
                <img src="{{ str_starts_with($f->foto ?? '', 'http') ? $f->foto : asset($f->foto ?? 'assets/images/gedung-pesantren.webp') }}" 
                     onerror="this.onerror=null; this.src='{{ asset('assets/images/gedung-pesantren.webp') }}';"
                     alt="{{ $f->nama }}" 
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/80 via-transparent to-transparent"></div>
                <div class="absolute top-3 left-3">
                  <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-white/95 text-emerald-900 backdrop-blur-xs shadow-xs flex items-center gap-1.5">
                    <i class="fa-solid {{ $f->icon ?? 'fa-building-columns' }} text-emerald-600 text-xs"></i>
                    <span>{{ $f->kategori }}</span>
                  </span>
                </div>
              </div>

              <div class="p-5 sm:p-6 space-y-2">
                <h3 class="font-extrabold text-base sm:text-lg text-emerald-950 group-hover:text-emerald-700 transition-colors">
                  {{ $f->nama }}
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-3">
                  {{ $f->deskripsi }}
                </p>
              </div>
            </div>

            <div class="px-5 sm:px-6 pb-5 pt-2 flex items-center justify-between text-xs text-slate-400 border-t border-slate-200/60">
              <span class="flex items-center gap-1 text-[11px] font-semibold text-emerald-700">
                <i class="fa-solid fa-circle-check text-emerald-600"></i> Fasilitas Resmi Pesantren
              </span>
              <span class="text-[11px] font-bold text-slate-400">#{{ $loop->iteration }}</span>
            </div>
          </div>
        @empty
          <div class="col-span-full p-8 text-center text-slate-400">Fasilitas pesantren sedang diperbarui.</div>
        @endforelse
      </div>

    </div>
  </section>

  <!-- SECTION DEWAN MASAYIKH PREVIEW -->
  <section class="py-16 bg-slate-50 border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
        <div>
          <span class="text-xs font-extrabold tracking-widest text-emerald-700 uppercase bg-emerald-100 px-3 py-1 rounded-full">
            Keteladanan & Sanad Keilmuan
          </span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-emerald-950 mt-2">
            Dewan Masayikh Pondok Pesantren
          </h2>
          <p class="text-slate-600 text-sm mt-1">
            Para sesepuh dan pimpinan yang membimbing ruhaniyah dan keilmuan para santri Miftahul Ulum Gunung Bubut.
          </p>
        </div>
        <a href="{{ route('profil') }}#masayikh" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-800 hover:text-amber-600 transition-colors">
          <span>Lihat Seluruh Masayikh</span>
          <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($masayikhs as $m)
          <div class="bg-white rounded-2xl p-5 border border-slate-200/80 hover-card-elevate text-center space-y-3">
            <div class="w-24 h-24 mx-auto rounded-full p-1 bg-gradient-to-tr from-amber-400 to-emerald-600 shadow-md overflow-hidden">
              <img src="{{ $m->foto ? asset($m->foto) : 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $m->nama }}" class="w-full h-full object-cover rounded-full">
            </div>
            <div>
              <h4 class="font-extrabold text-sm text-emerald-950">{{ $m->nama }}</h4>
              <p class="text-xs font-semibold text-amber-600 mt-0.5">{{ $m->gelar }}</p>
            </div>
            <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">{{ $m->deskripsi }}</p>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- SECTION PENDIDIKAN FORMAL (MTS & SMK PREVIEW) -->
  <section class="py-16 bg-white border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs font-extrabold tracking-widest text-blue-700 uppercase bg-blue-50 px-3 py-1 rounded-full border border-blue-200">
          Pendidikan Formal Terpadu
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-emerald-950 mt-2">
          MTs & SMK Miftahul Ulum Gunung Bubut
        </h2>
        <div class="islamic-divider">
          <i class="fa-solid fa-book-quran text-amber-500"></i>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- MTs Card -->
        @if($mts)
        <div class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white rounded-3xl p-8 relative overflow-hidden shadow-xl">
          <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
          <div class="relative z-10">
            <div class="flex justify-between items-start mb-6">
              <span class="px-3 py-1 bg-amber-500 text-slate-900 rounded-full font-extrabold text-xs">
                {{ $mts->akreditasi ?? 'AKREDITASI A' }}
              </span>
              <span class="text-xs text-emerald-300">NPSN: {{ $mts->npsn ?? '20278561' }}</span>
            </div>
            <h3 class="text-2xl font-extrabold text-white mb-2">{{ $mts->nama }}</h3>
            <p class="text-emerald-100 text-sm leading-relaxed mb-6">{{ $mts->deskripsi }}</p>
            <a href="{{ route('pendidikan') }}#mts" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-bold text-emerald-950 bg-amber-400 hover:bg-amber-300 transition-all">
              <span>Detail Profil MTs</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>
        @endif

        <!-- SMK Card -->
        @if($smk)
        <div class="bg-gradient-to-br from-slate-900 to-slate-950 text-white rounded-3xl p-8 relative overflow-hidden shadow-xl">
          <div class="relative z-10">
            <div class="flex justify-between items-start mb-6">
              <span class="px-3 py-1 bg-blue-500 text-white rounded-full font-extrabold text-xs">
                {{ $smk->akreditasi ?? 'VOKASI & IT' }}
              </span>
              <span class="text-xs text-slate-400">NPSN: {{ $smk->npsn ?? '20278562' }}</span>
            </div>
            <h3 class="text-2xl font-extrabold text-white mb-2">{{ $smk->nama }}</h3>
            <p class="text-slate-300 text-sm leading-relaxed mb-6">{{ $smk->deskripsi }}</p>
            <a href="{{ route('pendidikan') }}#smk" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-bold text-white bg-blue-600 hover:bg-blue-500 transition-all">
              <span>Detail Jurusan SMK</span>
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>
        @endif

      </div>

    </div>
  </section>

  <!-- SECTION PRESTASI SANTRI & LEMBAGA DINAMIS -->
  <section id="prestasi" class="py-16 bg-slate-50 border-t border-slate-200/60 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
        <div>
          <span class="text-xs font-extrabold tracking-widest text-amber-700 uppercase bg-amber-100 px-3.5 py-1.5 rounded-full border border-amber-200">
            Jejak Keunggulan & Prestasi
          </span>
          <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-emerald-950 mt-2.5">
            Prestasi Santri & Lembaga
          </h2>
          <p class="text-slate-600 text-xs sm:text-sm mt-1 max-w-xl">
            Capaian gemilang santri Miftahul Ulum di bidang keagamaan, kitab kuning, tahfidz, sains, vokasi teknologi, dan olahraga.
          </p>
        </div>
        <div class="flex items-center gap-2">
          <span class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-2xs">
            <i class="fa-solid fa-award text-amber-500 mr-1"></i> Terakreditasi & Berprestasi
          </span>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
        @forelse($prestasi as $p)
          <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
            <div>
              <div class="aspect-video w-full bg-slate-900 overflow-hidden relative">
                <img src="{{ str_starts_with($p->foto ?? '', 'http') ? $p->foto : asset($p->foto ?? 'assets/images/gedung-pesantren.webp') }}" 
                     onerror="this.onerror=null; this.src='{{ asset('assets/images/gedung-pesantren.webp') }}';"
                     alt="{{ $p->judul }}" 
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                
                <div class="absolute top-3 left-3">
                  <span class="px-3 py-1 rounded-full text-[10px] font-extrabold bg-amber-400 text-slate-950 shadow-xs uppercase tracking-wider">
                    <i class="fa-solid fa-trophy mr-1 text-slate-950"></i> {{ $p->tingkat }}
                  </span>
                </div>

                <div class="absolute top-3 right-3">
                  <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-white/90 text-slate-800 shadow-xs">
                    {{ $p->tahun }}
                  </span>
                </div>
              </div>

              <div class="p-5 sm:p-6 space-y-3">
                <div class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">
                  {{ $p->kategori }}
                </div>
                <h3 class="font-black text-sm sm:text-base text-slate-900 group-hover:text-emerald-800 transition-colors line-clamp-2 leading-snug">
                  {{ $p->judul }}
                </h3>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                  <i class="fa-solid fa-user-graduate text-emerald-600 text-sm shrink-0"></i>
                  <span class="truncate">{{ $p->peraih }}</span>
                </div>
                @if($p->deskripsi)
                  <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                    {{ $p->deskripsi }}
                  </p>
                @endif
              </div>
            </div>

            <div class="p-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
              <span class="text-[11px] font-semibold text-amber-700 flex items-center gap-1">
                <i class="fa-solid fa-medal text-amber-500"></i> Penghargaan Resmi
              </span>
              <span class="text-[11px] font-bold text-slate-400">Tahun {{ $p->tahun }}</span>
            </div>
          </div>
        @empty
          <div class="col-span-full p-8 text-center text-slate-400">Data prestasi sedang diperbarui.</div>
        @endforelse
      </div>

    </div>
  </section>

  <!-- SECTION PUBLIKASI TERKINI -->
  <section class="py-16 bg-slate-50 border-t border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
        <div>
          <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
            Kabar Terkini Pesantren
          </span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-emerald-950 mt-2">
            Publikasi: Artikel, Even & Kegiatan Santri
          </h2>
          <p class="text-slate-600 text-sm mt-1">
            Menyimak mutiara nasehat asatidz, dokumentasi kegiatan santri, dan agenda even pondok.
          </p>
        </div>
        <a href="{{ route('publikasi') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-emerald-800 bg-emerald-100 hover:bg-emerald-200 transition-all">
          <span>Lihat Semua Publikasi</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($articles as $item)
          <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 hover-card-elevate flex flex-col justify-between">
            <div class="relative aspect-video overflow-hidden">
              <img src="{{ asset($item->thumbnail ?? 'assets/images/logo-pesantren.jpg') }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
              <div class="absolute top-3 left-3">
                <span class="badge-category {{ $item->category->badge_class ?? 'bg-emerald-100 text-emerald-800' }}">{{ $item->category->nama ?? 'Publikasi' }}</span>
              </div>
            </div>
            <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
              <div>
                <div class="text-[11px] text-slate-400 mb-1 flex items-center gap-2">
                  <i class="fa-regular fa-clock"></i> {{ $item->tanggal_publikasi ? $item->tanggal_publikasi->translatedFormat('d F Y') : $item->created_at->format('d/m/Y') }}
                </div>
                <h3 class="font-bold text-base text-emerald-950 line-clamp-2 hover:text-emerald-700 transition-colors">
                  <a href="{{ route('publikasi.detail', $item->slug) }}">{{ $item->judul }}</a>
                </h3>
                <p class="text-xs text-slate-600 line-clamp-2 mt-2 leading-relaxed">
                  {{ $item->ringkasan }}
                </p>
              </div>
              <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500">{{ $item->penulis }}</span>
                <a href="{{ route('publikasi.detail', $item->slug) }}" class="text-xs font-bold text-emerald-700 hover:text-amber-600 transition-colors flex items-center gap-1">
                  <span>Baca</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- BANNER CTA DAFTAR SANTRI BARU (PSB) -->
  <section class="py-16 bg-emerald-950 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20" style="background-image: url('{{ asset('assets/images/gedung-pesantren.webp') }}');"></div>
    <div class="absolute inset-0 bg-emerald-950/85"></div>
    <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
    <div class="relative max-w-5xl mx-auto px-4 text-center space-y-6">
      <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 font-bold text-xs uppercase tracking-wider border border-amber-500/30">
        Penerimaan Santri Baru (PSB) Tahun Ajaran 2026/2027
      </span>
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold">
        Mari Bergabung Bersama Keluarga Besar <br>
        <span class="text-gold-gradient">{{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum' }}</span>
      </h2>
      <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
        Pendaftaran dibuka untuk jenjang MTs dan SMK Miftahul Ulum Gunung Bubut serta Program Pengajian Kitab Kuning & Tahfidz Al-Qur'an.
      </p>
      <div class="flex flex-wrap justify-center gap-4 pt-4">
        <a href="{{ route('psb') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-bold text-sm text-slate-900 bg-amber-400 hover:bg-amber-300 shadow-xl hover:scale-105 transition-all">
          <i class="fa-solid fa-file-pen"></i>
          <span>Isi Formulir Pendaftaran Sekarang</span>
        </a>
        <a href="https://wa.me/{{ $settings['whatsapp_psb'] ?? '6282123456789' }}?text=Halo%20Panitia%20PSB%20Miftahul%20Ulum%20Gunung%20Bubut,%20saya%20ingin%20konsultasi%20pendaftaran%20santri%20baru" target="_blank" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-bold text-sm text-white bg-emerald-800 hover:bg-emerald-700 border border-emerald-600 transition-all">
          <i class="fa-brands fa-whatsapp text-lg text-emerald-400"></i>
          <span>Konsultasi via WhatsApp</span>
        </a>
      </div>
    </div>
  </section>

  <!-- SCRIPT SLIDER HERO BACKGROUND SECARA RANDOM -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const bgSlides = document.querySelectorAll('.hero-bg-slide');
      const dots = document.querySelectorAll('.hero-dot');
      const btnPrev = document.getElementById('prevHeroSlide');
      const btnNext = document.getElementById('nextHeroSlide');
      const heroSection = document.getElementById('heroSection');

      if (!bgSlides.length) return;

      // Buat urutan slide secara random (acak)
      let slideOrder = Array.from(Array(bgSlides.length).keys());
      for (let i = slideOrder.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [slideOrder[i], slideOrder[j]] = [slideOrder[j], slideOrder[i]];
      }

      let orderIndex = 0;
      let slideInterval = null;

      function showSlideByOrder(idx) {
        orderIndex = (idx + slideOrder.length) % slideOrder.length;
        const activeSlideIndex = slideOrder[orderIndex];

        bgSlides.forEach((slide) => {
          const sIdx = parseInt(slide.getAttribute('data-index'));
          if (sIdx === activeSlideIndex) {
            slide.classList.remove('opacity-0', 'pointer-events-none', 'scale-105');
            slide.classList.add('opacity-100', 'scale-100');
          } else {
            slide.classList.remove('opacity-100', 'scale-100');
            slide.classList.add('opacity-0', 'pointer-events-none', 'scale-105');
          }
        });

        // Update Dots
        dots.forEach((dot) => {
          const dIdx = parseInt(dot.getAttribute('data-to'));
          if (dIdx === activeSlideIndex) {
            dot.className = 'hero-dot h-2 rounded-full transition-all duration-300 bg-amber-400 w-7 cursor-pointer shadow-sm';
          } else {
            dot.className = 'hero-dot h-2 rounded-full transition-all duration-300 bg-white/40 hover:bg-white/80 w-2 cursor-pointer';
          }
        });
      }

      function startAutoSlide() {
        if (slideInterval) clearInterval(slideInterval);
        slideInterval = setInterval(() => {
          showSlideByOrder(orderIndex + 1);
        }, 5000); // Berganti otomatis setiap 5 detik
      }

      function stopAutoSlide() {
        if (slideInterval) clearInterval(slideInterval);
      }

      // Mulai dengan slide pertama dari urutan acak
      showSlideByOrder(0);
      startAutoSlide();

      if (btnNext) {
        btnNext.addEventListener('click', function(e) {
          e.preventDefault();
          showSlideByOrder(orderIndex + 1);
          startAutoSlide();
        });
      }

      if (btnPrev) {
        btnPrev.addEventListener('click', function(e) {
          e.preventDefault();
          showSlideByOrder(orderIndex - 1);
          startAutoSlide();
        });
      }

      dots.forEach((dot) => {
        dot.addEventListener('click', function(e) {
          e.preventDefault();
          const target = parseInt(this.getAttribute('data-to'));
          const foundOrder = slideOrder.indexOf(target);
          if (foundOrder !== -1) {
            showSlideByOrder(foundOrder);
          } else {
            showSlideByOrder(target);
          }
          startAutoSlide();
        });
      });

      if (heroSection) {
        heroSection.addEventListener('mouseenter', stopAutoSlide);
        heroSection.addEventListener('mouseleave', startAutoSlide);
      }
    });
  </script>

@endsection
