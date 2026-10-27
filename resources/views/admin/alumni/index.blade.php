@extends('layouts.admin')

@section('title', 'Data & Jumlah Alumni')
@section('header_title', 'Statistik & Data Jumlah Alumni')

@section('content')

  <div class="space-y-6">

    <!-- Navigasi Tab Alumni -->
    <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
      <a href="{{ route('admin.cerita-alumni.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-emerald-50 transition-colors flex items-center gap-2">
        <i class="fa-solid fa-quote-left"></i>
        <span>Cerita & Testimoni Alumni</span>
      </a>
      <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-emerald-800 text-white shadow-xs flex items-center gap-2">
        <i class="fa-solid fa-user-graduate text-amber-400"></i>
        <span>Database Jumlah Alumni</span>
      </a>
    </div>

    <!-- 1. STATISTIC CARDS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Alumni</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalAlumni) }}</div>
          <div class="text-[10px] text-cyan-600 font-semibold">Tercatat di Sistem</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-child"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Alumni Putra</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalAlumniPutra) }}</div>
          <div class="text-[10px] text-slate-400">Selamet & Rahayu</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-pink-100 text-pink-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-child-dress"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Alumni Putri</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalAlumniPutri) }}</div>
          <div class="text-[10px] text-slate-400">Al-Hidayah Lama & Baru</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-users"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Santri Aktif Saat Ini</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalSantriAktif) }}</div>
          <div class="text-[10px] text-emerald-600 font-semibold">Dalam Masa Pendidikan</div>
        </div>
      </div>
    </div>

    <!-- 2. FILTER & SEARCH BAR -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6">
      <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
        <div>
          <h3 class="font-extrabold text-base text-slate-900">Daftar Santri yang Telah Menjadi Alumni</h3>
          <p class="text-xs text-slate-500 mt-0.5">Data santri purna studi dan alumni Pondok Pesantren Miftahul Ulum Gunung Bubut</p>
        </div>
        <div class="flex items-center gap-2">
          <a href="{{ route('admin.santri.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold flex items-center gap-2 transition-colors">
            <i class="fa-solid fa-users-rectangle text-teal-600"></i>
            <span>Buka Database Santri</span>
          </a>
        </div>
      </div>

      <form method="GET" action="{{ route('admin.alumni.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
        <div>
          <label class="block text-[11px] font-bold text-slate-600 mb-1">Pencarian Alumni</label>
          <div class="relative">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama, NIS, jenjang..." class="w-full pl-9 pr-3 py-2 text-xs border border-slate-200 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-bold text-slate-600 mb-1">Asrama Terakhir</label>
          <select name="asrama_id" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
            <option value="">-- Semua Asrama --</option>
            @foreach($asramas as $asr)
              <option value="{{ $asr->id }}" {{ request('asrama_id') == $asr->id ? 'selected' : '' }}>
                {{ $asr->nama }} ({{ $asr->jenis }})
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-[11px] font-bold text-slate-600 mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
            <option value="">-- Semua Gender --</option>
            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Putra)</option>
            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Putri)</option>
          </select>
        </div>

        <div class="flex items-end gap-2">
          <button type="submit" class="flex-1 bg-cyan-700 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded-xl text-xs transition-colors flex items-center justify-center gap-2">
            <i class="fa-solid fa-filter"></i>
            <span>Filter Data</span>
          </button>
          @if(request()->anyFilled(['cari', 'asrama_id', 'jenis_kelamin']))
            <a href="{{ route('admin.alumni.index') }}" class="p-2 border border-slate-200 rounded-xl text-slate-500 hover:bg-slate-100 text-xs" title="Reset Filter">
              <i class="fa-solid fa-rotate-left"></i>
            </a>
          @endif
        </div>
      </form>

      <!-- TABEL DATA ALUMNI -->
      <div class="overflow-x-auto border border-slate-200 rounded-2xl">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase text-[10px] tracking-wider">
            <tr>
              <th class="py-3 px-4 w-12 text-center">No</th>
              <th class="py-3 px-4">Santri Alumni</th>
              <th class="py-3 px-4">Asrama Terakhir</th>
              <th class="py-3 px-4">Pendidikan</th>
              <th class="py-3 px-4">Wali & Kontak</th>
              <th class="py-3 px-4 text-center">Status</th>
              <th class="py-3 px-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-slate-700">
            @forelse($alumnis as $index => $alumni)
              <tr class="hover:bg-slate-50/80 transition-colors">
                <td class="py-3.5 px-4 text-center text-slate-400 font-semibold">
                  {{ $alumnis->firstItem() + $index }}
                </td>
                <td class="py-3.5 px-4">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden border border-slate-200 shrink-0 flex items-center justify-center text-slate-400">
                      @if($alumni->foto)
                        <img src="{{ asset($alumni->foto) }}" alt="{{ $alumni->nama }}" class="w-full h-full object-cover">
                      @else
                        <i class="fa-solid fa-user-graduate text-cyan-600 text-base"></i>
                      @endif
                    </div>
                    <div>
                      <div class="font-bold text-slate-900">{{ $alumni->nama }}</div>
                      <div class="text-[11px] text-slate-500 flex items-center gap-2 mt-0.5">
                        <span>NIS: {{ $alumni->nis ?? '-' }}</span>
                        <span>•</span>
                        <span class="{{ $alumni->jenis_kelamin == 'Laki-laki' ? 'text-sky-600' : 'text-pink-600' }}">
                          {{ $alumni->jenis_kelamin }}
                        </span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="py-3.5 px-4 font-semibold text-slate-800">
                  <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[11px] {{ $alumni->asrama->jenis == 'Putra' ? 'bg-sky-50 text-sky-700 border border-sky-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                    <i class="fa-solid fa-building text-[10px]"></i>
                    {{ $alumni->asrama->nama ?? '-' }}
                  </div>
                </td>
                <td class="py-3.5 px-4">
                  <div class="font-semibold text-slate-800">{{ $alumni->jenjang ?? '-' }}</div>
                  <div class="text-[10px] text-slate-400">Kelas: {{ $alumni->kelas ?? '-' }}</div>
                </td>
                <td class="py-3.5 px-4">
                  <div class="text-slate-800 font-medium">{{ $alumni->nama_wali ?? '-' }}</div>
                  <div class="text-[10px] text-slate-400">{{ $alumni->telepon_wali ?? '-' }}</div>
                </td>
                <td class="py-3.5 px-4 text-center">
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-cyan-100 text-cyan-800 border border-cyan-200">
                    <i class="fa-solid fa-graduation-cap text-[9px]"></i>
                    Alumni
                  </span>
                </td>
                <td class="py-3.5 px-4 text-right">
                  <a href="{{ route('admin.santri.index', ['cari' => $alumni->nis ?: $alumni->nama]) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 text-[11px] font-semibold transition-colors" title="Lihat di Database Santri">
                    <i class="fa-solid fa-pen-to-square text-teal-600"></i>
                    <span>Kelola</span>
                  </a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="py-12 text-center text-slate-400">
                  <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-2xl mb-3">
                    <i class="fa-solid fa-user-graduate"></i>
                  </div>
                  <div class="font-bold text-slate-700 text-sm">Belum ada data Alumni</div>
                  <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                    Data santri yang diubah statusnya menjadi <b>Alumni</b> di menu Database Santri akan otomatis tercatat dan dihitung di halaman ini.
                  </p>
                  <div class="mt-4">
                    <a href="{{ route('admin.santri.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-800 text-white text-xs font-bold hover:bg-emerald-900 transition-colors">
                      <i class="fa-solid fa-users"></i>
                      <span>Buka Database Santri</span>
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- PAGINASI -->
      @if($alumnis->hasPages())
        <div class="mt-4">
          {{ $alumnis->links() }}
        </div>
      @endif

    </div>

  </div>

@endsection
