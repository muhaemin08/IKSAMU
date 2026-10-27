@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Ringkasan Dashboard Pesantren')

@section('content')

  <!-- Stat Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
    
    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex items-center justify-between">
      <div>
        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Publikasi</div>
        <div class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalArticles }}</div>
        <div class="text-[10px] text-emerald-700 font-semibold mt-0.5">Artikel & Kegiatan</div>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl">
        <i class="fa-solid fa-newspaper"></i>
      </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex items-center justify-between">
      <div>
        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Santri Mukim</div>
        <div class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalSantri ?? 0 }}</div>
        <div class="text-[10px] text-teal-700 font-semibold mt-0.5">Per 4 Asrama</div>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-800 flex items-center justify-center text-xl">
        <i class="fa-solid fa-users-rectangle"></i>
      </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex items-center justify-between">
      <div>
        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pendaftar PSB</div>
        <div class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalPsb }}</div>
        <div class="text-[10px] text-amber-700 font-semibold mt-0.5">Santri Baru</div>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl">
        <i class="fa-solid fa-user-graduate"></i>
      </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex items-center justify-between">
      <div>
        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Dewan Masayikh</div>
        <div class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalMasayikh }}</div>
        <div class="text-[10px] text-purple-700 font-semibold mt-0.5">Pengasuh</div>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-800 flex items-center justify-center text-xl">
        <i class="fa-solid fa-user-tie"></i>
      </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-xs flex items-center justify-between">
      <div>
        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Pembaca</div>
        <div class="text-2xl font-extrabold text-slate-900 mt-1">{{ number_format($totalViews) }}</div>
        <div class="text-[10px] text-blue-700 font-semibold mt-0.5">Views Publikasi</div>
      </div>
      <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-800 flex items-center justify-center text-xl">
        <i class="fa-solid fa-eye"></i>
      </div>
    </div>

  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Recent Articles Table -->
    <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
      <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-extrabold text-base text-slate-900">Publikasi Terakhir</h3>
        <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">Kelola Semua</a>
      </div>
      <div class="divide-y divide-slate-100">
        @forelse($recentArticles as $a)
          <div class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors">
            <div class="min-w-0 flex-1">
              <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $a->category->badge_class ?? 'bg-slate-100' }}">
                {{ $a->category->nama ?? 'Artikel' }}
              </span>
              <h4 class="font-bold text-xs text-slate-900 truncate mt-1">{{ $a->judul }}</h4>
              <div class="text-[11px] text-slate-400 mt-0.5">Penulis: {{ $a->penulis }} • {{ $a->created_at->diffForHumans() }}</div>
            </div>
            <a href="{{ route('admin.articles.edit', $a->id) }}" class="p-2 text-slate-400 hover:text-emerald-700">
              <i class="fa-solid fa-pen-to-square"></i>
            </a>
          </div>
        @empty
          <div class="p-8 text-center text-xs text-slate-400">Belum ada publikasi artikel.</div>
        @endforelse
      </div>
    </div>

    <!-- Recent PSB Registrations -->
    <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
      <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-extrabold text-base text-slate-900">Pendaftar PSB Terkini</h3>
        <a href="{{ route('admin.psb.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">Lihat Semua</a>
      </div>
      <div class="divide-y divide-slate-100">
        @forelse($recentPsb as $p)
          <div class="p-4 space-y-1 hover:bg-slate-50 transition-colors">
            <div class="flex justify-between items-center">
              <h5 class="font-bold text-xs text-slate-900">{{ $p->nama_santri }}</h5>
              <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase bg-amber-100 text-amber-800">
                {{ $p->status }}
              </span>
            </div>
            <div class="text-[11px] text-slate-500">{{ $p->pilihan_pendidikan }} • Wali: {{ $p->nama_wali }}</div>
            <div class="text-[10px] text-slate-400"><i class="fa-brands fa-whatsapp text-emerald-600 mr-1"></i> {{ $p->no_hp }}</div>
          </div>
        @empty
          <div class="p-8 text-center text-xs text-slate-400">Belum ada pendaftar PSB baru.</div>
        @endforelse
      </div>
    </div>

  </div>

  <!-- STATISTIK ASAL DAERAH SANTRI (DESA, KECAMATAN, KABUPATEN) -->
  <div class="mt-8 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gradient-to-r from-slate-50 via-emerald-50/20 to-white">
      <div>
        <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 uppercase tracking-wider mb-1">
          <i class="fa-solid fa-map-location-dot"></i> Demografi & Sebaran Wilayah
        </div>
        <h3 class="font-extrabold text-lg text-slate-900">Statistik Asal Daerah Santri</h3>
        <p class="text-xs text-slate-500 mt-0.5">Analisis persebaran domisili santri mukim berdasarkan tingkat Desa, Kecamatan, dan Kabupaten.</p>
      </div>

      <!-- Quick Summary Badges -->
      <div class="flex items-center gap-2 flex-wrap">
        <div class="px-3.5 py-1.5 rounded-xl bg-emerald-100/70 border border-emerald-200 text-emerald-900 text-xs font-bold flex items-center gap-1.5">
          <i class="fa-solid fa-city text-emerald-700"></i>
          <span>{{ $statistikWilayah['total_kabupaten'] }} Kabupaten/Kota</span>
        </div>
        <div class="px-3.5 py-1.5 rounded-xl bg-blue-100/70 border border-blue-200 text-blue-900 text-xs font-bold flex items-center gap-1.5">
          <i class="fa-solid fa-signs-post text-blue-700"></i>
          <span>{{ $statistikWilayah['total_kecamatan'] }} Kecamatan</span>
        </div>
        <div class="px-3.5 py-1.5 rounded-xl bg-amber-100/70 border border-amber-200 text-amber-900 text-xs font-bold flex items-center gap-1.5">
          <i class="fa-solid fa-tree-city text-amber-700"></i>
          <span>{{ $statistikWilayah['total_desa'] }} Desa</span>
        </div>
      </div>
    </div>

    <!-- Tab Buttons -->
    <div class="px-6 pt-4 border-b border-slate-100 flex items-center gap-2">
      <button type="button" onclick="switchWilayahTab('kabupaten')" id="btnTabKabupaten" class="px-4 py-2 text-xs font-bold rounded-t-xl border-b-2 border-emerald-700 text-emerald-800 bg-emerald-50/60 transition-all flex items-center gap-1.5">
        <i class="fa-solid fa-city"></i> Tingkat Kabupaten / Kota
      </button>
      <button type="button" onclick="switchWilayahTab('kecamatan')" id="btnTabKecamatan" class="px-4 py-2 text-xs font-bold rounded-t-xl border-b-2 border-transparent text-slate-500 hover:text-slate-800 transition-all flex items-center gap-1.5">
        <i class="fa-solid fa-signs-post"></i> Tingkat Kecamatan
      </button>
      <button type="button" onclick="switchWilayahTab('desa')" id="btnTabDesa" class="px-4 py-2 text-xs font-bold rounded-t-xl border-b-2 border-transparent text-slate-500 hover:text-slate-800 transition-all flex items-center gap-1.5">
        <i class="fa-solid fa-tree-city"></i> Tingkat Desa / Kelurahan
      </button>
    </div>

    <!-- Tab Contents -->
    <div class="p-6">
      <!-- 1. Tab Kabupaten -->
      <div id="contentTabKabupaten" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @forelse($statistikWilayah['kabupaten'] as $idx => $item)
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2 hover:bg-slate-100/60 transition-colors">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <span class="w-6 h-6 rounded-lg bg-emerald-700 text-white font-extrabold text-[11px] flex items-center justify-center">
                    {{ $idx + 1 }}
                  </span>
                  <span class="font-extrabold text-sm text-slate-900">{{ $item->nama_wilayah }}</span>
                </div>
                <div class="text-right">
                  <span class="font-bold text-xs text-emerald-950">{{ $item->total }} Santri</span>
                  <span class="text-[10px] text-slate-400 font-mono ml-1">({{ $item->persentase }}%)</span>
                </div>
              </div>
              <!-- Progress Bar -->
              <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-500 h-2 rounded-full transition-all duration-500" style="width: {{ $item->persentase }}%"></div>
              </div>
            </div>
          @empty
            <div class="col-span-2 p-8 text-center text-xs text-slate-400">Belum ada data wilayah kabupaten santri.</div>
          @endforelse
        </div>
      </div>

      <!-- 2. Tab Kecamatan -->
      <div id="contentTabKecamatan" class="space-y-4 hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @forelse($statistikWilayah['kecamatan'] as $idx => $item)
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2 hover:bg-slate-100/60 transition-colors">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <span class="w-6 h-6 rounded-lg bg-blue-700 text-white font-extrabold text-[11px] flex items-center justify-center">
                    {{ $idx + 1 }}
                  </span>
                  <div>
                    <div class="font-extrabold text-sm text-slate-900">Kec. {{ $item->nama_wilayah }}</div>
                    <div class="text-[11px] text-slate-400">{{ $item->nama_kabupaten }}</div>
                  </div>
                </div>
                <div class="text-right">
                  <span class="font-bold text-xs text-blue-950">{{ $item->total }} Santri</span>
                  <span class="text-[10px] text-slate-400 font-mono ml-1">({{ $item->persentase }}%)</span>
                </div>
              </div>
              <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-500 h-2 rounded-full transition-all duration-500" style="width: {{ $item->persentase }}%"></div>
              </div>
            </div>
          @empty
            <div class="col-span-2 p-8 text-center text-xs text-slate-400">Belum ada data wilayah kecamatan santri.</div>
          @endforelse
        </div>
      </div>

      <!-- 3. Tab Desa -->
      <div id="contentTabDesa" class="space-y-4 hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          @forelse($statistikWilayah['desa'] as $idx => $item)
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2 hover:bg-slate-100/60 transition-colors">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <span class="w-6 h-6 rounded-lg bg-amber-700 text-white font-extrabold text-[11px] flex items-center justify-center">
                    {{ $idx + 1 }}
                  </span>
                  <div>
                    <div class="font-extrabold text-xs text-slate-900">Desa {{ $item->nama_wilayah }}</div>
                    <div class="text-[10px] text-slate-400">Kec. {{ $item->nama_kecamatan }}</div>
                  </div>
                </div>
                <div class="text-right">
                  <span class="font-bold text-xs text-amber-950">{{ $item->total }}</span>
                  <span class="text-[10px] text-slate-400 font-mono block">({{ $item->persentase }}%)</span>
                </div>
              </div>
              <div class="w-full bg-slate-200 rounded-full h-1.5 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-600 to-orange-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $item->persentase }}%"></div>
              </div>
            </div>
          @empty
            <div class="col-span-3 p-8 text-center text-xs text-slate-400">Belum ada data wilayah desa santri.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <script>
    function switchWilayahTab(tab) {
      const tabs = ['kabupaten', 'kecamatan', 'desa'];
      tabs.forEach(t => {
        const btn = document.getElementById('btnTab' + t.charAt(0).toUpperCase() + t.slice(1));
        const content = document.getElementById('contentTab' + t.charAt(0).toUpperCase() + t.slice(1));
        if (t === tab) {
          btn.className = 'px-4 py-2 text-xs font-bold rounded-t-xl border-b-2 border-emerald-700 text-emerald-800 bg-emerald-50/60 transition-all flex items-center gap-1.5';
          content.classList.remove('hidden');
        } else {
          btn.className = 'px-4 py-2 text-xs font-bold rounded-t-xl border-b-2 border-transparent text-slate-500 hover:text-slate-800 transition-all flex items-center gap-1.5';
          content.classList.add('hidden');
        }
      });
    }
  </script>

@endsection
