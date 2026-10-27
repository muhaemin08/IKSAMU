@extends('layouts.app')

@section('title', $article->judul . ' - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-emerald-950 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-15"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-3 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <a href="{{ route('publikasi') }}" class="hover:text-amber-400">Publikasi</a>
        <span>/</span>
        <span class="text-amber-400">{{ $article->category->nama ?? 'Artikel' }}</span>
      </div>
      <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white leading-tight">
        {{ $article->judul }}
      </h1>
      <div class="flex flex-wrap items-center justify-center sm:justify-start gap-4 text-xs text-emerald-200 mt-4">
        <span><i class="fa-regular fa-user mr-1 text-amber-400"></i> {{ $article->penulis }}</span>
        <span>•</span>
        <span><i class="fa-regular fa-calendar mr-1 text-amber-400"></i> {{ $article->tanggal_publikasi ? $article->tanggal_publikasi->translatedFormat('d F Y') : $article->created_at->format('d/m/Y') }}</span>
        <span>•</span>
        <span><i class="fa-regular fa-eye mr-1 text-amber-400"></i> {{ $article->views }} x dibaca</span>
      </div>
    </div>
  </section>

  <!-- CONTENT DETAIL -->
  <section class="py-14 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      @if($article->thumbnail)
        <div class="rounded-3xl overflow-hidden shadow-xl mb-10 aspect-video max-h-[480px]">
          <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
        </div>
      @endif

      @if($article->ringkasan)
        <div class="p-6 bg-emerald-50 border-l-4 border-emerald-600 rounded-r-2xl text-slate-700 text-sm sm:text-base leading-relaxed mb-8 italic">
          {{ $article->ringkasan }}
        </div>
      @endif

      <!-- Article Body -->
      <div class="prose prose-emerald max-w-none text-slate-700 text-base leading-relaxed space-y-4">
        {!! $article->konten !!}
      </div>

      <!-- Tags & Share -->
      <div class="mt-12 pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-2 text-xs font-semibold">
          <span class="text-slate-500">Kategori:</span>
          <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800">{{ $article->category->nama ?? 'Publikasi' }}</span>
          @if($article->tag)
            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800">#{{ $article->tag }}</span>
          @endif
        </div>
        <div class="flex items-center gap-2 text-xs">
          <span class="text-slate-500 font-semibold">Bagikan:</span>
          <a href="https://api.whatsapp.com/send?text={{ urlencode($article->judul . ' - ' . url()->current()) }}" target="_blank" class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center hover:bg-emerald-700 transition-colors">
            <i class="fa-brands fa-whatsapp"></i>
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
        </div>
      </div>

      <!-- Related Articles -->
      @if($related->isNotEmpty())
        <div class="mt-16 pt-10 border-t border-slate-200">
          <h3 class="font-extrabold text-xl text-emerald-950 mb-6">Artikel Terkait Lainnya</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($related as $rel)
              <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200 hover-card-elevate space-y-2">
                <span class="text-[10px] font-bold text-emerald-700">{{ $rel->category->nama }}</span>
                <h4 class="font-bold text-sm text-slate-900 line-clamp-2">
                  <a href="{{ route('publikasi.detail', $rel->slug) }}" class="hover:text-emerald-700">{{ $rel->judul }}</a>
                </h4>
                <p class="text-[11px] text-slate-500 line-clamp-2">{{ $rel->ringkasan }}</p>
              </div>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </section>

@endsection
