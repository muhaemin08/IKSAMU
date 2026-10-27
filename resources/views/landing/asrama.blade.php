@extends('layouts.app')

@section('title', 'Asrama Putra & Putri - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-emerald-950 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-15"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <span class="text-amber-400">Asrama Santri</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Asrama Putra & Asrama Putri</h1>
      <p class="text-slate-200 text-sm mt-2 max-w-2xl">
        Hunian santri yang representatif, nyaman, dan higienis sebagai kawah candradimuka pembentukan kedisiplinan dan ukhuwah islamiyah.
      </p>
    </div>
  </section>

  <!-- JUMPLINKS -->
  <div class="sticky top-20 z-30 bg-white border-b border-slate-200 shadow-sm py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center sm:justify-start gap-3 text-xs sm:text-sm font-bold flex-wrap">
      <a href="#asrama-putra" class="px-4 py-2 rounded-full bg-emerald-100 text-emerald-900 hover:bg-emerald-200 transition-colors">
        <i class="fa-solid fa-hotel mr-1.5 text-emerald-700"></i> Asrama Putra (Selamet & Rahayu)
      </a>
      <a href="#asrama-putri" class="px-4 py-2 rounded-full bg-pink-100 text-pink-900 hover:bg-pink-200 transition-colors">
        <i class="fa-solid fa-person-dress mr-1.5 text-pink-600"></i> Asrama Putri (Al-Hidayah Lama & Baru)
      </a>
      <a href="#jadwal" class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 hover:bg-amber-100 hover:text-amber-900 transition-colors">
        <i class="fa-solid fa-clock mr-1.5 text-amber-600"></i> Jadwal Santri 24 Jam
      </a>
    </div>
  </div>

  <!-- BAGIAN 1: ASRAMA PUTRA (ASRAMA SELAMET & ASRAMA RAHAYU) -->
  <section id="asrama-putra" class="py-16 bg-white scroll-mt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs font-extrabold tracking-widest text-emerald-800 uppercase bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">
          <i class="fa-solid fa-person mr-1"></i> Kompleks Santri Putra
        </span>
        <h2 class="text-3xl font-extrabold text-emerald-950 mt-3">
          Asrama Selamet & Asrama Rahayu
        </h2>
        <p class="text-slate-600 text-sm mt-2">
          Pusat pembinaan adab santri putra, mudzakarah kitab salafiyah, dan pembiasaan sholat berjamaah di bawah asuhan dewan asatidz.
        </p>
        <div class="islamic-divider"><i class="fa-solid fa-mosque text-emerald-700"></i></div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($asramaPutras as $item)
          <div id="{{ Str::slug($item->nama) }}" class="bg-gradient-to-b from-emerald-50/50 to-white rounded-3xl p-6 sm:p-8 border border-emerald-200 shadow-md flex flex-col justify-between space-y-6 scroll-mt-32">
            
            <div class="space-y-4">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <span class="px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-emerald-800 text-amber-300">
                    Asrama Putra
                  </span>
                  <h3 class="text-2xl font-extrabold text-emerald-950 mt-1.5">{{ $item->nama }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl shrink-0 shadow-xs">
                  <i class="fa-solid fa-hotel"></i>
                </div>
              </div>

              <div class="rounded-2xl overflow-hidden aspect-video border border-emerald-200 shadow-sm relative group">
                <img src="{{ str_starts_with($item->foto ?? '', 'http') ? $item->foto : asset($item->foto ?? 'assets/images/hero-pesantren.jpg') }}" 
                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1584697964190-705b893683f1?auto=format&fit=crop&w=800&q=80';"
                     alt="{{ $item->nama }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute bottom-3 left-3 bg-slate-900/80 backdrop-blur-xs text-white text-[11px] font-bold px-2.5 py-1 rounded-lg">
                  <i class="fa-solid fa-bed text-amber-400 mr-1"></i> {{ $item->jumlah_kamar }}
                </div>
              </div>

              <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                {{ $item->deskripsi }}
              </p>

              <!-- Stats & Pembina -->
              <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="p-3.5 bg-white rounded-xl border border-emerald-100 shadow-2xs">
                  <span class="text-[10px] font-bold text-slate-400 uppercase">Kapasitas:</span>
                  <div class="font-bold text-slate-900 mt-0.5 text-sm">{{ $item->kapasitas }}</div>
                </div>
                <div class="p-3.5 bg-white rounded-xl border border-emerald-100 shadow-2xs">
                  <span class="text-[10px] font-bold text-slate-400 uppercase">Pembina:</span>
                  <div class="font-bold text-slate-900 mt-0.5 line-clamp-1 text-xs">{{ $item->pembina }}</div>
                </div>
              </div>

              <!-- Fasilitas -->
              <div class="space-y-2 pt-2">
                <div class="text-[11px] font-extrabold text-emerald-950 uppercase tracking-wider">Fasilitas Kompleks:</div>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                  @foreach($item->fasilitas ?? [] as $f)
                    <li class="flex items-center gap-2">
                      <i class="fa-solid fa-circle-check text-emerald-600 shrink-0 text-xs"></i>
                      <span>{{ $f }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>

            <div class="pt-4 border-t border-emerald-100 flex items-center justify-between">
              <span class="text-xs text-slate-500 font-medium"><i class="fa-solid fa-shield-halved text-emerald-600 mr-1"></i> Terpantau Mudabbir 24 Jam</span>
              <a href="{{ route('psb') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-emerald-800 hover:bg-emerald-700 shadow-xs transition-colors">
                Daftar Asrama
              </a>
            </div>

          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- BAGIAN 2: ASRAMA PUTRI (ASRAMA AL-HIDAYAH LAMA & ASRAMA AL-HIDAYAH BARU) -->
  <section id="asrama-putri" class="py-16 bg-slate-50 border-t border-slate-200/60 scroll-mt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs font-extrabold tracking-widest text-pink-800 uppercase bg-pink-100 px-3.5 py-1.5 rounded-full border border-pink-200">
          <i class="fa-solid fa-person-dress mr-1"></i> Kompleks Santri Putri
        </span>
        <h2 class="text-3xl font-extrabold text-emerald-950 mt-3">
          Asrama Al-Hidayah Lama & Asrama Al-Hidayah Baru
        </h2>
        <p class="text-slate-600 text-sm mt-2">
          Lingkungan mukim santriwati mandiri yang berpagar tertutup, menjaga privasi kehormatan muslimah dengan bimbingan fiqih nisa dan tahfidz.
        </p>
        <div class="islamic-divider"><i class="fa-solid fa-heart text-pink-600"></i></div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($asramaPutris as $item)
          <div id="{{ Str::slug($item->nama) }}" class="bg-gradient-to-b from-pink-50/40 to-white rounded-3xl p-6 sm:p-8 border border-pink-200 shadow-md flex flex-col justify-between space-y-6 scroll-mt-32">
            
            <div class="space-y-4">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <span class="px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-pink-700 text-white">
                    Asrama Putri
                  </span>
                  <h3 class="text-2xl font-extrabold text-slate-900 mt-1.5">{{ $item->nama }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-800 flex items-center justify-center text-xl shrink-0 shadow-xs">
                  <i class="fa-solid fa-building"></i>
                </div>
              </div>

              <div class="rounded-2xl overflow-hidden aspect-video border border-pink-200 shadow-sm relative group">
                <img src="{{ str_starts_with($item->foto ?? '', 'http') ? $item->foto : asset($item->foto ?? 'https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=800&q=80') }}" 
                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1596495577886-d920f1fb7238?auto=format&fit=crop&w=800&q=80';"
                     alt="{{ $item->nama }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute bottom-3 left-3 bg-slate-900/80 backdrop-blur-xs text-white text-[11px] font-bold px-2.5 py-1 rounded-lg">
                  <i class="fa-solid fa-bed text-pink-300 mr-1"></i> {{ $item->jumlah_kamar }}
                </div>
              </div>

              <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                {{ $item->deskripsi }}
              </p>

              <!-- Stats & Pembina -->
              <div class="grid grid-cols-2 gap-3 text-xs">
                <div class="p-3.5 bg-white rounded-xl border border-pink-100 shadow-2xs">
                  <span class="text-[10px] font-bold text-slate-400 uppercase">Kapasitas:</span>
                  <div class="font-bold text-slate-900 mt-0.5 text-sm">{{ $item->kapasitas }}</div>
                </div>
                <div class="p-3.5 bg-white rounded-xl border border-pink-100 shadow-2xs">
                  <span class="text-[10px] font-bold text-slate-400 uppercase">Pembina:</span>
                  <div class="font-bold text-slate-900 mt-0.5 line-clamp-1 text-xs">{{ $item->pembina }}</div>
                </div>
              </div>

              <!-- Fasilitas -->
              <div class="space-y-2 pt-2">
                <div class="text-[11px] font-extrabold text-pink-950 uppercase tracking-wider">Fasilitas Khusus Putri:</div>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                  @foreach($item->fasilitas ?? [] as $f)
                    <li class="flex items-center gap-2">
                      <i class="fa-solid fa-circle-check text-pink-600 shrink-0 text-xs"></i>
                      <span>{{ $f }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>

            <div class="pt-4 border-t border-pink-100 flex items-center justify-between">
              <span class="text-xs text-slate-500 font-medium"><i class="fa-solid fa-lock text-pink-600 mr-1"></i> Kompleks Berpagar Khusus</span>
              <a href="{{ route('psb') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-pink-700 hover:bg-pink-800 shadow-xs transition-colors">
                Daftar Asrama
              </a>
            </div>

          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- BAGIAN 3: JADWAL HARIAN 24 JAM -->
  <section id="jadwal" class="py-16 bg-white border-t border-slate-200/60 scroll-mt-32">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
          Disiplin & Rutinitas Santri
        </span>
        <h2 class="text-3xl font-extrabold text-emerald-950 mt-2">
          Jadwal Harian 24 Jam Santri Miftahul Ulum
        </h2>
        <div class="islamic-divider"><i class="fa-solid fa-clock text-amber-500"></i></div>
      </div>

      <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
        <div class="p-6 bg-emerald-950 text-white flex justify-between items-center">
          <div class="font-bold text-sm sm:text-base flex items-center gap-2">
            <i class="fa-solid fa-calendar-days text-amber-400"></i>
            <span>Rutinitas Harian Santri Mukim</span>
          </div>
          <span class="text-xs text-emerald-300 font-mono">Senin - Ahad</span>
        </div>

        <div class="divide-y divide-slate-100">
          @forelse($jadwals as $j)
            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-emerald-50/40 transition-colors">
              <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 font-extrabold text-sm shadow-xs">
                  <span>{{ $j->urutan }}</span>
                </div>
                <div>
                  <h4 class="font-bold text-sm text-slate-900 leading-snug">{{ $j->kegiatan }}</h4>
                  <p class="text-xs text-slate-500 mt-0.5">Agenda Rutin Santri Mukim</p>
                </div>
              </div>
              <div class="self-start sm:self-center font-mono font-bold text-xs px-3.5 py-1.5 rounded-lg bg-amber-100 text-amber-900 border border-amber-200 shrink-0 shadow-2xs">
                <i class="fa-regular fa-clock mr-1 text-amber-700"></i> {{ $j->waktu }}
              </div>
            </div>
          @empty
            <div class="p-8 text-center text-xs text-slate-400">Jadwal belum dikonfigurasi.</div>
          @endforelse
        </div>
      </div>

    </div>
  </section>

@endsection
