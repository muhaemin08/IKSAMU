<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum Gunung Bubut')</title>
  <meta name="description" content="@yield('meta_desc', $settings['site_motto'] ?? 'Pondok Pesantren Miftahul Ulum Gunung Bubut Tasikmalaya')">
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logo.svg') }}">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            emerald: { 850: '#064e3b', 950: '#022c22' },
            gold: { 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309' }
          },
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            arabic: ['Amiri', 'serif']
          }
        }
      }
    }
  </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <style>
    /* Strict Dropdown Visibility Rules */
    .dropdown-menu {
      opacity: 0 !important;
      visibility: hidden !important;
      pointer-events: none !important;
      transform: translateY(8px);
      transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .dropdown-group:hover > .dropdown-menu,
    .group:hover > .dropdown-menu {
      opacity: 1 !important;
      visibility: visible !important;
      pointer-events: auto !important;
      transform: translateY(0) !important;
    }
  </style>
  @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-emerald-600 selection:text-white flex flex-col min-h-screen">

  <!-- TOP BAR -->
  <div class="bg-emerald-950 text-white text-xs border-b border-emerald-800 py-2.5 px-4 hidden md:block">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <div class="flex items-center gap-6">
        <span class="flex items-center gap-2 text-emerald-200">
          <i class="fa-solid fa-location-dot text-amber-400"></i>
          {{ $settings['address'] ?? 'Gunungbubut, Pakalongan, Sodonghilir, Tasikmalaya' }}
        </span>
        <span class="flex items-center gap-2 text-emerald-200">
          <i class="fa-solid fa-phone text-amber-400"></i>
          {{ $settings['phone'] ?? '+62 821-2345-6789' }}
        </span>
      </div>
      <div class="flex items-center gap-4">
        <span class="text-amber-300 font-medium">Bismillah Menuju Generasi Tafaqquh Fiddin</span>
        <div class="h-3 w-px bg-emerald-800"></div>
        <div class="flex items-center gap-3 text-slate-300">
          @if(!empty($settings['facebook']))<a href="{{ $settings['facebook'] }}" target="_blank" class="hover:text-amber-400"><i class="fa-brands fa-facebook-f"></i></a>@endif
          @if(!empty($settings['instagram']))<a href="{{ $settings['instagram'] }}" target="_blank" class="hover:text-amber-400"><i class="fa-brands fa-instagram"></i></a>@endif
          @if(!empty($settings['youtube']))<a href="{{ $settings['youtube'] }}" target="_blank" class="hover:text-amber-400"><i class="fa-brands fa-youtube"></i></a>@endif
          @if(!empty($settings['tiktok']))<a href="{{ $settings['tiktok'] }}" target="_blank" class="hover:text-amber-400"><i class="fa-brands fa-tiktok"></i></a>@endif
          <a href="{{ route('login') }}" class="hover:text-amber-400" title="Login"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- MAIN NAVIGATION (Sticky & Blur like psb.alfalah.ponpes.id) -->
  <header id="siteHeader" class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-gray-100 shadow-xs transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 xl:gap-3 group shrink-0 py-2">
          <img src="{{ asset($settings['logo_url'] ?? 'assets/images/logo-pesantren.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.svg') }}';" alt="Logo" class="w-11 h-11 md:w-12 md:h-12 object-contain rounded-full transition-transform duration-300 group-hover:scale-105 drop-shadow-xs">
          <div>
            <h1 class="text-sm xl:text-base font-extrabold text-emerald-950 leading-tight uppercase tracking-tight whitespace-nowrap">
              {{ $settings['site_name'] ?? 'Miftahul Ulum' }}
            </h1>
            <p class="text-[10px] xl:text-xs font-semibold text-amber-600 tracking-wider whitespace-nowrap">
              {{ $settings['site_subname'] ?? 'GUNUNG BUBUT - TASIKMALAYA' }}
            </p>
          </div>
        </a>

        <!-- Desktop Navigation Menu (Al-Falah Style) -->
        <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2 text-xs xl:text-sm font-semibold text-slate-700 flex-nowrap">
          
          <!-- Beranda -->
          <a href="{{ route('home') }}" class="relative px-3 py-2 text-slate-700 hover:text-emerald-700 transition-colors duration-300 group whitespace-nowrap {{ request()->routeIs('home') ? 'text-emerald-700 font-bold' : '' }}">
            <span>Beranda</span>
            <span class="absolute inset-x-2 bottom-0 h-0.5 bg-emerald-600 transform {{ request()->routeIs('home') ? 'scale-x-100' : 'scale-x-0' }} origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
          </a>

          <!-- Tentang (Dropdown) -->
          <div class="relative group dropdown-group">
            <button type="button" class="relative flex items-center gap-1.5 px-3 py-2 text-slate-700 hover:text-emerald-700 transition-colors duration-300 group whitespace-nowrap {{ request()->routeIs('profil') ? 'text-emerald-700 font-bold' : '' }}">
              <span>Tentang</span>
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180 text-slate-400 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
              <span class="absolute inset-x-2 bottom-0 h-0.5 bg-emerald-600 transform {{ request()->routeIs('profil') ? 'scale-x-100' : 'scale-x-0' }} origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
            </button>
            <div class="dropdown-menu absolute left-0 top-full pt-2 w-64 z-50 opacity-0 invisible pointer-events-none translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto group-hover:translate-y-0 transition-all duration-200">
              <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 border border-slate-100 py-2 divide-y divide-slate-50 overflow-hidden">
                <a href="{{ route('profil') }}#profil" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-mosque text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Profil Pesantren</div>
                    <div class="text-[11px] text-slate-400 font-normal">Visi, misi, dan identitas</div>
                  </div>
                </a>
                <a href="{{ route('profil') }}#sejarah" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-landmark-dome text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Sejarah Pesantren</div>
                    <div class="text-[11px] text-slate-400 font-normal">Napak tilas muassis</div>
                  </div>
                </a>
                <a href="{{ route('profil') }}#masayikh" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-user-tie text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Dewan Masayikh</div>
                    <div class="text-[11px] text-slate-400 font-normal">Pimpinan & pengasuh</div>
                  </div>
                </a>
                <a href="{{ route('home') }}#fasilitas" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-building-columns text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Fasilitas Pesantren</div>
                    <div class="text-[11px] text-slate-400 font-normal">Masjid, Asrama, Futsal, Volly</div>
                  </div>
                </a>
                <a href="{{ route('home') }}#prestasi" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-trophy text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Prestasi Santri</div>
                    <div class="text-[11px] text-slate-400 font-normal">Kejuaraan & apresiasi santri</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <!-- Asrama (Dropdown) -->
          <div class="relative group dropdown-group">
            <button type="button" class="relative flex items-center gap-1.5 px-3 py-2 text-slate-700 hover:text-emerald-700 transition-colors duration-300 group whitespace-nowrap {{ request()->routeIs('asrama') ? 'text-emerald-700 font-bold' : '' }}">
              <span>Asrama</span>
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180 text-slate-400 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
              <span class="absolute inset-x-2 bottom-0 h-0.5 bg-emerald-600 transform {{ request()->routeIs('asrama') ? 'scale-x-100' : 'scale-x-0' }} origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
            </button>
            <div class="dropdown-menu absolute left-0 top-full pt-2 w-72 z-50 opacity-0 invisible pointer-events-none translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto group-hover:translate-y-0 transition-all duration-200">
              <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 border border-slate-100 py-2 divide-y divide-slate-50 overflow-hidden">
                <a href="{{ route('asrama') }}#asrama-selamet" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-hotel text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Asrama Putra</div>
                    <div class="text-[11px] text-slate-400 font-normal">Asrama Selamet & Rahayu</div>
                  </div>
                </a>
                <a href="{{ route('asrama') }}#asrama-alhidayah" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-pink-50 text-pink-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-person-dress text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Asrama Putri</div>
                    <div class="text-[11px] text-slate-400 font-normal">Al-Hidayah Lama & Baru</div>
                  </div>
                </a>
                <a href="{{ route('asrama') }}#jadwal" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-clock text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Jadwal Harian</div>
                    <div class="text-[11px] text-slate-400 font-normal">24 Jam Rutinitas Santri</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <!-- Pendidikan Formal (Dropdown) -->
          <div class="relative group dropdown-group">
            <button type="button" class="relative flex items-center gap-1.5 px-3 py-2 text-slate-700 hover:text-emerald-700 transition-colors duration-300 group whitespace-nowrap {{ request()->routeIs('pendidikan*') ? 'text-emerald-700 font-bold' : '' }}">
              <span>Pendidikan Formal</span>
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180 text-slate-400 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
              <span class="absolute inset-x-2 bottom-0 h-0.5 bg-emerald-600 transform {{ request()->routeIs('pendidikan*') ? 'scale-x-100' : 'scale-x-0' }} origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
            </button>
            <div class="dropdown-menu absolute left-0 top-full pt-2 w-80 z-50 opacity-0 invisible pointer-events-none translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto group-hover:translate-y-0 transition-all duration-200">
              <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 border border-slate-100 py-2 divide-y divide-slate-50 overflow-hidden">
                <a href="{{ route('pendidikan.mts') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-graduation-cap text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">MTs. Miftahul Ulum</div>
                    <div class="text-[11px] text-slate-400 font-normal">Madrasah Tsanawiyah Terakreditasi A</div>
                  </div>
                </a>
                <a href="{{ route('pendidikan.smk') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-laptop-code text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">SMK YAPIM KAB. TASIKMALAYA</div>
                    <div class="text-[11px] text-slate-400 font-normal">Vokasi IT, Jaringan & Otomotif</div>
                  </div>
                </a>
                <a href="{{ route('pendidikan') }}" class="flex items-center gap-2 px-4 py-2 text-slate-600 hover:text-emerald-700 hover:bg-slate-50 text-xs font-semibold">
                  <i class="fa-solid fa-arrow-right text-[10px] text-slate-400"></i>
                  <span>Lihat Ikhtisar & Kurikulum Lengkap</span>
                </a>
              </div>
            </div>
          </div>

          <!-- Publikasi (Dropdown) -->
          <div class="relative group dropdown-group">
            <button type="button" class="relative flex items-center gap-1.5 px-3 py-2 text-slate-700 hover:text-emerald-700 transition-colors duration-300 group whitespace-nowrap {{ request()->routeIs('publikasi*') ? 'text-emerald-700 font-bold' : '' }}">
              <span>Publikasi</span>
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180 text-slate-400 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
              <span class="absolute inset-x-2 bottom-0 h-0.5 bg-emerald-600 transform {{ request()->routeIs('publikasi*') ? 'scale-x-100' : 'scale-x-0' }} origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
            </button>
            <div class="dropdown-menu absolute left-0 top-full pt-2 w-64 z-50 opacity-0 invisible pointer-events-none translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto group-hover:translate-y-0 transition-all duration-200">
              <div class="bg-white rounded-2xl shadow-xl ring-1 ring-black/5 border border-slate-100 py-2 divide-y divide-slate-50 overflow-hidden">
                <a href="{{ route('publikasi', ['kategori' => 'artikel']) }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-newspaper text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Artikel</div>
                    <div class="text-[11px] text-slate-400 font-normal">Kajian kitab & pemikiran</div>
                  </div>
                </a>
                <a href="{{ route('publikasi', ['kategori' => 'even']) }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-calendar-check text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Even</div>
                    <div class="text-[11px] text-slate-400 font-normal">Agenda dan peringatan akbar</div>
                  </div>
                </a>
                <a href="{{ route('publikasi', ['kategori' => 'kegiatan-santri']) }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/70 transition-colors duration-200">
                  <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-users-rays text-xs"></i>
                  </div>
                  <div>
                    <div class="font-bold text-xs xl:text-sm text-slate-800">Kegiatan Santri</div>
                    <div class="text-[11px] text-slate-400 font-normal">Dokumentasi rutinitas santri</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <!-- Alumni (IKSAMU) -->
          <a href="{{ route('alumni') }}" class="relative px-3 py-2 text-slate-700 hover:text-emerald-700 transition-colors duration-300 group whitespace-nowrap {{ request()->routeIs('alumni*') ? 'text-emerald-700 font-bold' : '' }}">
            <span>Alumni</span>
            <span class="absolute inset-x-2 bottom-0 h-0.5 bg-emerald-600 transform {{ request()->routeIs('alumni*') ? 'scale-x-100' : 'scale-x-0' }} origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
          </a>

          <!-- Kontak -->
          <a href="{{ route('kontak') }}" class="relative px-3 py-2 text-slate-700 hover:text-emerald-700 transition-colors duration-300 group whitespace-nowrap {{ request()->routeIs('kontak') ? 'text-emerald-700 font-bold' : '' }}">
            <span>Kontak</span>
            <span class="absolute inset-x-2 bottom-0 h-0.5 bg-emerald-600 transform {{ request()->routeIs('kontak') ? 'scale-x-100' : 'scale-x-0' }} origin-left transition-transform duration-300 group-hover:scale-x-100"></span>
          </a>

        </nav>

        <!-- Right Action Buttons (Al-Falah Style: Masuk & Daftar Sekarang) -->
        <div class="hidden sm:flex items-center gap-2.5 xl:gap-3 shrink-0">
          <a href="{{ route('login') }}" class="px-4 py-2 rounded-full border border-slate-300 hover:border-emerald-600 text-slate-700 hover:text-emerald-700 font-bold text-xs xl:text-sm hover:bg-emerald-50/50 transition-all duration-200 flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-right-to-bracket text-xs text-emerald-600"></i>
            <span>Masuk</span>
          </a>

          <a href="{{ route('psb') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-bold text-xs xl:text-sm text-white bg-emerald-700 hover:bg-emerald-800 shadow-md hover:shadow-emerald-700/25 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 whitespace-nowrap">
            <i class="fa-solid fa-file-pen text-amber-300"></i>
            <span>Daftar Sekarang</span>
          </a>
        </div>

        <!-- Mobile Menu Hamburger & Quick Action -->
        <div class="flex items-center gap-2 lg:hidden">
          <a href="{{ route('psb') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold text-white bg-emerald-700 shadow-xs">
            Daftar
          </a>
          <button id="mobileMenuToggle" class="p-2 text-slate-700 hover:text-emerald-700 rounded-xl hover:bg-slate-100 transition-colors" aria-label="Buka Menu">
            <i class="fa-solid fa-bars text-xl"></i>
          </button>
        </div>

      </div>
    </div>
  </header>

  <!-- MOBILE DRAWER (Accordion Model like Al-Falah) -->
  <div id="mobileMenu" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden transition-opacity duration-300">
    <div class="drawer-content fixed top-0 left-0 bottom-0 w-80 max-w-full bg-white shadow-2xl flex flex-col transform -translate-x-full transition-transform duration-300 ease-out">
      
      <!-- Drawer Header -->
      <div class="p-4 bg-emerald-950 text-white flex justify-between items-center border-b border-emerald-800">
        <div class="flex items-center gap-3">
          <img src="{{ asset($settings['logo_url'] ?? 'assets/images/logo-pesantren.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.svg') }}';" alt="Logo" class="w-10 h-10 object-contain rounded-full shadow-xs">
          <div>
            <div class="font-extrabold text-sm">{{ $settings['site_name'] ?? 'MIFTAHUL ULUM' }}</div>
            <div class="text-[11px] text-amber-400 font-medium">Gunung Bubut Tasikmalaya</div>
          </div>
        </div>
        <button id="mobileMenuClose" class="w-8 h-8 rounded-lg bg-emerald-900/60 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <!-- Drawer Nav List (Accordions) -->
      <div class="flex-1 overflow-y-auto p-4 space-y-1.5 text-sm font-semibold text-slate-700">
        
        <!-- Beranda -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-800 transition-colors {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">
          <i class="fa-solid fa-house w-5 text-emerald-600"></i>
          <span>Beranda</span>
        </a>

        <!-- Accordion Tentang -->
        <div>
          <button type="button" class="mobile-dropdown-btn flex items-center justify-between w-full px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-800 transition-colors text-left {{ request()->routeIs('profil') ? 'text-emerald-800 font-bold' : '' }}">
            <span class="flex items-center gap-3">
              <i class="fa-solid fa-circle-info w-5 text-emerald-600"></i>
              <span>Tentang Pesantren</span>
            </span>
            <svg class="mobile-dropdown-icon w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div class="mobile-dropdown-content hidden pl-11 pr-2 py-1 space-y-1">
            <a href="{{ route('profil') }}#profil" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Profil Pesantren
            </a>
            <a href="{{ route('profil') }}#sejarah" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Sejarah Muassis
            </a>
            <a href="{{ route('profil') }}#masayikh" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Dewan Masayikh
            </a>
            <a href="{{ route('home') }}#fasilitas" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Fasilitas Pesantren
            </a>
            <a href="{{ route('home') }}#prestasi" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Prestasi Santri & Lembaga
            </a>
          </div>
        </div>

        <!-- Accordion Asrama -->
        <div>
          <button type="button" class="mobile-dropdown-btn flex items-center justify-between w-full px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-800 transition-colors text-left {{ request()->routeIs('asrama') ? 'text-emerald-800 font-bold' : '' }}">
            <span class="flex items-center gap-3">
              <i class="fa-solid fa-hotel w-5 text-emerald-600"></i>
              <span>Asrama Santri</span>
            </span>
            <svg class="mobile-dropdown-icon w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div class="mobile-dropdown-content hidden pl-11 pr-2 py-1 space-y-1">
            <a href="{{ route('asrama') }}#asrama-selamet" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Asrama Putra (Selamet & Rahayu)
            </a>
            <a href="{{ route('asrama') }}#asrama-alhidayah" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Asrama Putri (Al-Hidayah)
            </a>
            <a href="{{ route('asrama') }}#jadwal" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Jadwal Rutinitas Santri
            </a>
          </div>
        </div>

        <!-- Accordion Pendidikan Formal -->
        <div>
          <button type="button" class="mobile-dropdown-btn flex items-center justify-between w-full px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-800 transition-colors text-left {{ request()->routeIs('pendidikan*') ? 'text-emerald-800 font-bold' : '' }}">
            <span class="flex items-center gap-3">
              <i class="fa-solid fa-graduation-cap w-5 text-emerald-600"></i>
              <span>Pendidikan Formal</span>
            </span>
            <svg class="mobile-dropdown-icon w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div class="mobile-dropdown-content hidden pl-11 pr-2 py-1 space-y-1">
            <a href="{{ route('pendidikan.mts') }}" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              MTs. Miftahul Ulum
            </a>
            <a href="{{ route('pendidikan.smk') }}" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              SMK YAPIM KAB. TASIKMALAYA
            </a>
            <a href="{{ route('pendidikan') }}" class="block py-2 text-xs text-emerald-700 hover:text-emerald-900 font-bold">
              Ikhtisar & Kurikulum &rarr;
            </a>
          </div>
        </div>

        <!-- Accordion Publikasi -->
        <div>
          <button type="button" class="mobile-dropdown-btn flex items-center justify-between w-full px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-800 transition-colors text-left {{ request()->routeIs('publikasi*') ? 'text-emerald-800 font-bold' : '' }}">
            <span class="flex items-center gap-3">
              <i class="fa-solid fa-bullhorn w-5 text-emerald-600"></i>
              <span>Publikasi</span>
            </span>
            <svg class="mobile-dropdown-icon w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div class="mobile-dropdown-content hidden pl-11 pr-2 py-1 space-y-1">
            <a href="{{ route('publikasi', ['kategori' => 'artikel']) }}" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Artikel Keislaman
            </a>
            <a href="{{ route('publikasi', ['kategori' => 'even']) }}" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Even & Agenda
            </a>
            <a href="{{ route('publikasi', ['kategori' => 'kegiatan-santri']) }}" class="block py-2 text-xs text-slate-600 hover:text-emerald-700 font-medium border-b border-slate-100 last:border-b-0">
              Kegiatan Santri
            </a>
          </div>
        </div>

        <!-- Alumni (IKSAMU) -->
        <a href="{{ route('alumni') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-800 transition-colors {{ request()->routeIs('alumni*') ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">
          <i class="fa-solid fa-user-graduate w-5 text-emerald-600"></i>
          <span>Alumni (IKSAMU)</span>
        </a>

        <!-- Kontak -->
        <a href="{{ route('kontak') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-800 transition-colors {{ request()->routeIs('kontak') ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">
          <i class="fa-solid fa-address-book w-5 text-emerald-600"></i>
          <span>Kontak & Peta</span>
        </a>

      </div>

      <!-- Drawer Bottom Action Buttons (Al-Falah Style) -->
      <div class="p-4 border-t border-slate-200 bg-slate-50 space-y-2">
        <a href="{{ route('psb') }}" class="w-full inline-flex justify-center items-center gap-2 py-2.5 px-4 rounded-xl text-white font-bold text-xs bg-emerald-700 hover:bg-emerald-800 shadow-md transition-all">
          <i class="fa-solid fa-file-pen text-amber-300"></i>
          <span>Daftar Sekarang (PSB Online)</span>
        </a>
        <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center gap-2 py-2 px-4 rounded-xl text-slate-700 hover:text-emerald-800 font-bold text-xs border border-slate-300 bg-white hover:bg-slate-50 transition-all">
          <i class="fa-solid fa-arrow-right-to-bracket text-emerald-600"></i>
          <span>Masuk ke Akun (Login)</span>
        </a>
      </div>

    </div>
  </div>

  <!-- MAIN CONTENT -->
  <main class="flex-grow">
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="bg-slate-900 text-slate-300 border-t border-slate-800 text-sm mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
        
        <div class="lg:col-span-2 space-y-4">
          <div class="flex items-center gap-3">
            <img src="{{ asset($settings['logo_url'] ?? 'assets/images/logo-pesantren.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.svg') }}';" alt="Logo" class="w-12 h-12 object-contain rounded-full">
            <div>
              <div class="font-extrabold text-white text-base tracking-wide">{{ $settings['site_name'] ?? 'PONDOK PESANTREN' }}</div>
              <div class="font-bold text-amber-400 text-sm">{{ $settings['site_subname'] ?? 'GUNUNG BUBUT' }}</div>
            </div>
          </div>
          <p class="text-xs text-slate-400 leading-relaxed">
            {{ $settings['site_motto'] ?? 'Lembaga pendidikan Islam salafiyah terpadu di Tasikmalaya yang berkomitmen melahirkan generasi muttaqin, tafaqquh fiddin, cerdas teknologi, dan berkhidmah bagi agama, nusa, dan bangsa.' }}
          </p>
          <div class="text-xs text-slate-400 space-y-1.5 pt-2">
            <div class="flex items-start gap-2.5">
              <i class="fa-solid fa-location-dot text-amber-500 mt-1"></i>
              <span>{{ $settings['address'] ?? 'Jl. KHZ Abidin, Kp. Gunungbubut, Sodonghilir, Tasikmalaya' }}</span>
            </div>
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-phone text-amber-500"></i>
              <span>{{ $settings['phone'] ?? '+62 821-2345-6789' }}</span>
            </div>
            <div class="flex items-center gap-2.5">
              <i class="fa-solid fa-envelope text-amber-500"></i>
              <span>{{ $settings['email'] ?? 'info@miftahululumgunungbubut.sch.id' }}</span>
            </div>
          </div>
        </div>

        <div class="space-y-3">
          <h4 class="font-bold text-white text-sm uppercase tracking-wider border-b border-slate-800 pb-2">Tentang & Asrama</h4>
          <ul class="space-y-2 text-xs">
            <li><a href="{{ route('profil') }}#profil" class="hover:text-amber-400">Profil Pesantren</a></li>
            <li><a href="{{ route('profil') }}#sejarah" class="hover:text-amber-400">Sejarah Pesantren</a></li>
            <li><a href="{{ route('profil') }}#masayikh" class="hover:text-amber-400">Dewan Masayikh</a></li>
            <li><a href="{{ route('asrama') }}#asrama-putra" class="hover:text-amber-400">Asrama Putra</a></li>
            <li><a href="{{ route('asrama') }}#asrama-putri" class="hover:text-amber-400">Asrama Putri</a></li>
            <li><a href="{{ route('asrama') }}#jadwal" class="hover:text-amber-400">Jadwal Harian Santri</a></li>
            <li><a href="{{ route('alumni') }}" class="hover:text-amber-400 text-amber-300 font-semibold"><i class="fa-solid fa-graduation-cap text-[10px] mr-1"></i> Cerita Alumni (IKSAMU)</a></li>
          </ul>
        </div>

        <div class="space-y-3">
          <h4 class="font-bold text-white text-sm uppercase tracking-wider border-b border-slate-800 pb-2">Pendidikan Formal</h4>
          <ul class="space-y-2 text-xs">
            <li><a href="{{ route('pendidikan.mts') }}" class="hover:text-amber-400">MTs Miftahul Ulum</a></li>
            <li><a href="{{ route('pendidikan.smk') }}" class="hover:text-amber-400">SMK YAPIM KABUPATEN TASIKMALAYA</a></li>
            <li><a href="{{ route('pendidikan') }}" class="hover:text-amber-400">Ikhtisar & Kurikulum</a></li>
            <li><a href="{{ route('psb') }}" class="hover:text-amber-400">PSB Online</a></li>
          </ul>
        </div>

        <div class="space-y-3">
          <h4 class="font-bold text-white text-sm uppercase tracking-wider border-b border-slate-800 pb-2">Publikasi & Media</h4>
          <ul class="space-y-2 text-xs">
            <li><a href="{{ route('publikasi', ['kategori' => 'artikel']) }}" class="hover:text-amber-400">Artikel Keislaman</a></li>
            <li><a href="{{ route('publikasi', ['kategori' => 'even']) }}" class="hover:text-amber-400">Even & Agenda Akbar</a></li>
            <li><a href="{{ route('publikasi', ['kategori' => 'kegiatan-santri']) }}" class="hover:text-amber-400">Kegiatan Santri</a></li>
            <li><a href="{{ route('kontak') }}" class="hover:text-amber-400">Hubungi Kami</a></li>
          </ul>
          <div class="pt-2">
            <div class="text-xs font-semibold text-white mb-2">Ikuti Kami:</div>
            <div class="flex items-center gap-2">
              @if(!empty($settings['facebook']))<a href="{{ $settings['facebook'] }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-emerald-700 flex items-center justify-center text-slate-300 hover:text-white"><i class="fa-brands fa-facebook-f text-xs"></i></a>@endif
              @if(!empty($settings['instagram']))<a href="{{ $settings['instagram'] }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-emerald-700 flex items-center justify-center text-slate-300 hover:text-white"><i class="fa-brands fa-instagram text-xs"></i></a>@endif
              @if(!empty($settings['youtube']))<a href="{{ $settings['youtube'] }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-emerald-700 flex items-center justify-center text-slate-300 hover:text-white"><i class="fa-brands fa-youtube text-xs"></i></a>@endif
              @if(!empty($settings['tiktok']))<a href="{{ $settings['tiktok'] }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-emerald-700 flex items-center justify-center text-slate-300 hover:text-white"><i class="fa-brands fa-tiktok text-xs"></i></a>@endif
            </div>
          </div>
        </div>

      </div>

      <div class="mt-12 pt-6 border-t border-slate-800 text-xs text-slate-500 flex flex-col sm:flex-row justify-between items-center gap-3 text-center sm:text-left">
        <div>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum' }}. Hak Cipta Dilindungi.</div>
        <div class="flex items-center gap-4">
          <a href="{{ route('profil') }}" class="hover:text-slate-300">Tentang</a>
          <a href="{{ route('alumni') }}" class="hover:text-slate-300">Alumni</a>
          <a href="{{ route('kontak') }}" class="hover:text-slate-300">Kontak</a>
          <a href="{{ route('psb') }}" class="hover:text-slate-300">PSB Online</a>
          <a href="{{ route('login') }}" class="text-amber-400 hover:text-amber-300 font-semibold"><i class="fa-solid fa-lock text-[10px] mr-1"></i> Login Portal</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- FLOATING WHATSAPP -->
  <a href="https://wa.me/{{ $settings['whatsapp_psb'] ?? '6282123456789' }}?text=Assalamu%27alaikum,%20saya%20ingin%20bertanya%20mengenai%20Pondok%20Pesantren%20Miftahul%20Ulum" target="_blank" class="floating-btn fixed bottom-6 right-6 z-40 bg-emerald-600 hover:bg-emerald-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl transition-all" title="WhatsApp Panitia">
    <i class="fa-brands fa-whatsapp text-3xl"></i>
  </a>

  <!-- BACK TO TOP -->
  <button id="backToTop" class="floating-btn fixed bottom-24 right-6 z-40 bg-white/90 hover:bg-white text-emerald-900 border border-slate-200 w-11 h-11 rounded-full flex items-center justify-center shadow-lg transition-all opacity-0 pointer-events-none translate-y-4">
    <i class="fa-solid fa-chevron-up text-sm"></i>
  </button>

  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
