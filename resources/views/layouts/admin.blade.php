<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') - Pondok Pesantren Miftahul Ulum</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logo.svg') }}">

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
            sans: ['Arial', 'Helvetica', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style>
    /* Default seluruh teks admin panel menggunakan font Arial */
    html, body, input, button, select, textarea, optgroup, option {
      font-family: Arial, Helvetica, sans-serif !important;
    }

    /* Pengecualian khusus: Font Awesome agar semua ikon menu & dashboard muncul sempurna */
    .fa, .fas, .fa-solid {
      font-family: "Font Awesome 6 Free" !important;
      font-weight: 900 !important;
    }
    .far, .fa-regular {
      font-family: "Font Awesome 6 Free" !important;
      font-weight: 400 !important;
    }
    .fab, .fa-brands {
      font-family: "Font Awesome 6 Brands" !important;
      font-weight: 400 !important;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Quill WYSIWYG Editor CDN -->
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 antialiased flex h-screen overflow-hidden">

  <!-- Mobile Sidebar Backdrop -->
  <div id="adminSidebarBackdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 hidden md:hidden"></div>

  <!-- SIDEBAR (Responsive for Mobile & Desktop) -->
  <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-emerald-950 text-white flex flex-col shrink-0 border-r border-emerald-900 select-none transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out">
    
    <!-- Sidebar Brand -->
    <div class="p-5 border-b border-emerald-800/80 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <img src="{{ asset('assets/images/logo-pesantren.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.svg') }}';" alt="Logo" class="w-10 h-10 object-contain rounded-full bg-white p-0.5">
        <div>
          <div class="font-extrabold text-sm leading-tight">MIFTAHUL ULUM</div>
          <div class="text-[10px] text-amber-400 font-semibold tracking-wider">ADMIN PANEL</div>
        </div>
      </div>
      <button type="button" id="adminSidebarClose" class="md:hidden text-slate-400 hover:text-white p-1.5 rounded-lg bg-emerald-900/60 transition-colors" title="Tutup Menu">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <!-- Sidebar Menu Links -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-1.5 text-xs font-semibold">
      
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
        <i class="fa-solid fa-gauge w-4 text-center text-amber-400"></i>
        <span>Dashboard</span>
      </a>

      @if(auth()->user()->isSuperAdmin())
        <div class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider px-3 pt-4 pb-1">Manajemen Lembaga</div>

        <a href="{{ route('admin.masayikh.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.masayikh*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-user-tie w-4 text-center text-amber-400"></i>
          <span>Dewan Masayikh</span>
        </a>

        <a href="{{ route('admin.santri.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.santri*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-users-rectangle w-4 text-center text-teal-400"></i>
          <span>Database Santri</span>
        </a>

        <a href="{{ route('admin.jadwal.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.jadwal*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-clock w-4 text-center text-amber-400"></i>
          <span>Jadwal Harian Santri</span>
        </a>

        <a href="{{ route('admin.fasilitas.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.fasilitas*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-building-columns w-4 text-center text-emerald-400"></i>
          <span>Fasilitas Pesantren</span>
        </a>

        <a href="{{ route('admin.prestasi.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.prestasi*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-trophy w-4 text-center text-amber-400"></i>
          <span>Prestasi Santri</span>
        </a>

        <a href="{{ route('admin.cerita-alumni.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.cerita-alumni*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-quote-left w-4 text-center text-amber-400"></i>
          <span>Cerita Alumni</span>
        </a>

        <a href="{{ route('admin.alumni.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.alumni*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-user-graduate w-4 text-center text-cyan-400"></i>
          <span>Jumlah Alumni</span>
        </a>

        <div class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider px-3 pt-4 pb-1">Manajemen PSB</div>

        <a href="{{ route('admin.psb.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.psb.index*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-users w-4 text-center text-blue-400"></i>
          <span>Pendaftaran Santri Baru</span>
        </a>

        <a href="{{ route('admin.psb.biaya.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.psb.biaya*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-money-bill-wave w-4 text-center text-amber-400"></i>
          <span>Biaya & Tarif PSB</span>
        </a>

        <div class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider px-3 pt-4 pb-1">Lembaga Pendidikan Formal</div>

        <a href="{{ route('admin.pendidikan.mts') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.pendidikan.mts*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-graduation-cap w-4 text-center text-emerald-400"></i>
          <span>MTs. Miftahul Ulum</span>
        </a>

        <a href="{{ route('admin.pendidikan.smk') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.pendidikan.smk*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-laptop-code w-4 text-center text-blue-400"></i>
          <span class="truncate" title="SMK YAPIM KABUPATEN TASIKMALAYA">SMK YAPIM KAB. TASIKMALAYA</span>
        </a>
      @endif

      <div class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider px-3 pt-4 pb-1">Konfigurasi</div>

      <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.articles*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
        <i class="fa-solid fa-newspaper w-4 text-center text-emerald-400"></i>
        <span>Pengelolaan Artikel</span>
      </a>

      @if(auth()->user()->isSuperAdmin())
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.users*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-users-gear w-4 text-center text-teal-400"></i>
          <span>Manajemen User</span>
        </a>

        <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.settings*') ? 'bg-emerald-800 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-emerald-900/60 hover:text-white' }}">
          <i class="fa-solid fa-sliders w-4 text-center text-amber-400"></i>
          <span>Setting Dasar Aplikasi</span>
        </a>
      @endif

      <div class="pt-6">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-emerald-300 hover:bg-emerald-900/80 hover:text-white transition-colors border border-emerald-800/80">
          <i class="fa-solid fa-arrow-up-right-from-square w-4 text-center"></i>
          <span>Lihat Halaman Publik</span>
        </a>
      </div>

    </nav>

    <!-- Sidebar User Profile -->
    <div class="p-4 border-t border-emerald-900 bg-emerald-950/60 flex items-center justify-between">
      <div class="flex items-center gap-2.5 overflow-hidden">
        <div class="w-8 h-8 rounded-full bg-emerald-800 text-amber-300 flex items-center justify-center font-bold text-xs uppercase shrink-0">
          {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <div class="truncate">
          <div class="font-bold text-xs text-white truncate">{{ auth()->user()->name }}</div>
          <div class="text-[10px] text-amber-400 font-semibold uppercase">{{ auth()->user()->role }}</div>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-400 transition-colors" title="Keluar">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </button>
      </form>
    </div>

  </aside>

  <!-- MAIN BODY -->
  <div class="flex-1 flex flex-col overflow-hidden">
    
    <!-- Top Header -->
    <header class="bg-white border-b border-slate-200 px-4 sm:px-6 py-3.5 sm:py-4 flex justify-between items-center shadow-xs">
      <div class="flex items-center gap-3">
        <button type="button" id="adminSidebarToggle" class="md:hidden text-slate-700 hover:text-emerald-800 p-2 rounded-xl hover:bg-slate-100 transition-colors" title="Buka Menu">
          <i class="fa-solid fa-bars text-lg"></i>
        </button>
        <h2 class="font-extrabold text-base sm:text-lg text-slate-800">
          @yield('header_title', 'Dashboard')
        </h2>
      </div>
      <div class="flex items-center gap-2 sm:gap-3">
        <a href="{{ route('home') }}" target="_blank" class="px-2.5 sm:px-3 py-1 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 rounded-full text-xs font-bold flex items-center gap-1.5 transition-colors">
          <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
          <span class="hidden sm:inline">Lihat Web</span>
        </a>
      </div>
    </header>

    <!-- Flash Message -->
    @if(session('success'))
      <div class="mx-4 sm:mx-6 mt-4 p-4 bg-emerald-100 border border-emerald-200 text-emerald-900 rounded-2xl flex items-center gap-3 text-xs font-bold shadow-xs">
        <i class="fa-solid fa-circle-check text-base text-emerald-600"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if($errors->any())
      <div class="mx-4 sm:mx-6 mt-4 p-4 bg-red-100 border border-red-200 text-red-900 rounded-2xl flex items-center gap-3 text-xs font-bold shadow-xs">
        <i class="fa-solid fa-triangle-exclamation text-base text-red-600"></i>
        <span>{{ $errors->first() }}</span>
      </div>
    @endif

    <!-- Scrollable Content -->
    <main class="flex-1 overflow-y-auto p-4 sm:p-6">
      @yield('content')
    </main>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('adminSidebar');
      const backdrop = document.getElementById('adminSidebarBackdrop');
      const toggleBtn = document.getElementById('adminSidebarToggle');
      const closeBtn = document.getElementById('adminSidebarClose');

      const openSidebar = () => {
        sidebar?.classList.remove('-translate-x-full');
        backdrop?.classList.remove('hidden');
      };
      const closeSidebar = () => {
        sidebar?.classList.add('-translate-x-full');
        backdrop?.classList.add('hidden');
      };

      toggleBtn?.addEventListener('click', openSidebar);
      closeBtn?.addEventListener('click', closeSidebar);
      backdrop?.addEventListener('click', closeSidebar);
    });
  </script>

  @stack('scripts')
</body>
</html>
