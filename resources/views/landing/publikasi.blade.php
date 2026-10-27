@extends('layouts.app')

@section('title', 'Publikasi Artikel, Even & Kegiatan - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-emerald-950 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-15"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <span class="text-amber-400">Publikasi</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Artikel, Even & Kegiatan Santri</h1>
      <p class="text-slate-200 text-sm mt-2 max-w-2xl">
        Kanal warta resmi seputar kajian khazanah keilmuan Islam, agenda even pesantren, serta dinamika keseharian para santri.
      </p>
    </div>
  </section>

  <!-- FILTER & SEARCH BAR -->
  <section class="py-6 bg-white border-b border-slate-200 sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        
        <!-- Category Filter Buttons -->
        <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm font-bold w-full md:w-auto">
          <a href="{{ route('publikasi') }}" class="px-4 py-2 rounded-full transition-all {{ empty($activeCategory) ? 'bg-emerald-800 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-emerald-100 hover:text-emerald-900' }}">
            <i class="fa-solid fa-layer-group mr-1.5"></i> Semua
          </a>
          @foreach($categories as $cat)
            <a href="{{ route('publikasi', ['kategori' => $cat->slug]) }}" class="px-4 py-2 rounded-full transition-all {{ $activeCategory === $cat->slug ? 'bg-emerald-800 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-emerald-100 hover:text-emerald-900' }}">
              {{ $cat->nama }}
            </a>
          @endforeach
        </div>

        <!-- Search Input Form -->
        <form action="{{ route('publikasi') }}" method="GET" class="w-full md:w-72 relative">
          @if($activeCategory)
            <input type="hidden" name="kategori" value="{{ $activeCategory }}">
          @endif
          <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
          <input type="text" name="cari" value="{{ $search ?? '' }}" placeholder="Cari artikel atau kegiatan..." class="w-full pl-9 pr-4 py-2 rounded-full text-xs border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
        </form>

      </div>
    </div>
  </section>

  <!-- ARTICLES GRID -->
  <section class="py-14 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      @if($articles->isEmpty())
        <div class="text-center py-16">
          <div class="w-16 h-16 mx-auto rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-2xl mb-3">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
          <h3 class="text-base font-bold text-slate-700">Tidak ada publikasi ditemukan</h3>
          <p class="text-xs text-slate-500 mt-1">Coba gunakan kata kunci pencarian yang lain atau ubah kategori filter.</p>
        </div>
      @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($articles as $item)
            <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 hover-card-elevate flex flex-col justify-between">
              <div class="relative aspect-video overflow-hidden">
                <img src="{{ asset($item->thumbnail ?? 'assets/images/hero-pesantren.jpg') }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                <div class="absolute top-3 left-3">
                  <span class="badge-category {{ $item->category->badge_class ?? 'bg-emerald-100 text-emerald-800' }}">
                    {{ $item->category->nama ?? 'Publikasi' }}
                  </span>
                </div>
              </div>
              <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                <div>
                  <div class="text-xs text-slate-400 mb-1 flex items-center gap-2">
                    <i class="fa-regular fa-clock"></i> {{ $item->tanggal_publikasi ? $item->tanggal_publikasi->translatedFormat('d F Y') : $item->created_at->format('d/m/Y') }}
                  </div>
                  <h3 class="font-extrabold text-base text-emerald-950 line-clamp-2 hover:text-emerald-700 transition-colors">
                    <a href="{{ route('publikasi.detail', $item->slug) }}">{{ $item->judul }}</a>
                  </h3>
                  <p class="text-xs text-slate-600 line-clamp-3 mt-2 leading-relaxed">
                    {{ $item->ringkasan }}
                  </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                  <div class="text-xs font-semibold text-slate-500">
                    <i class="fa-regular fa-user mr-1 text-emerald-700"></i> {{ $item->penulis }}
                  </div>
                  <a href="{{ route('publikasi.detail', $item->slug) }}" class="px-4 py-1.5 rounded-full text-xs font-bold text-emerald-800 bg-emerald-50 hover:bg-emerald-800 hover:text-white transition-all flex items-center gap-1.5">
                    <span>Baca Lengkap</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-12">
          {{ $articles->links() }}
        </div>
      @endif

    </div>
  </section>

@endsection
