@extends('layouts.admin')

@section('title', 'Database Santri')
@section('header_title', 'Database Santri Pondok Pesantren')

@section('content')

  <div class="space-y-6">

    <!-- 1. STATISTIC CARDS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-users"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Santri</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalSantri) }}</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-child"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Santri Putra</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalPutra) }}</div>
          <div class="text-[10px] text-slate-400">Selamet & Rahayu</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-pink-100 text-pink-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-child-dress"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Santri Putri</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalPutri) }}</div>
          <div class="text-[10px] text-slate-400">Al-Hidayah Lama & Baru</div>
        </div>
      </div>

      <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl shrink-0">
          <i class="fa-solid fa-user-check"></i>
        </div>
        <div>
          <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Santri Aktif</div>
          <div class="text-2xl font-extrabold text-slate-900 mt-0.5">{{ number_format($totalAktif) }}</div>
        </div>
      </div>
    </div>

    <!-- 2. FILTER & SEARCH BAR -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6">
      <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
        <div>
          <h3 class="font-extrabold text-base text-slate-900">Daftar Santri Mukim</h3>
          <p class="text-xs text-slate-500 mt-0.5">Filter dan kelola data santri per asrama putra & putri</p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
          <!-- Tombol Hapus Terpilih di Header (Muncul jika ada santri diceklis) -->
          <button type="button" id="btnHeaderBulkDelete" onclick="deleteSelected()" class="hidden items-center gap-2 px-3.5 py-2.5 rounded-xl font-bold text-xs text-rose-800 bg-rose-50 hover:bg-rose-100 border border-rose-200 shadow-2xs transition-all cursor-pointer">
            <i class="fa-solid fa-trash-can text-rose-600 text-sm"></i>
            <span id="btnHeaderBulkDeleteText">Hapus yang Dipilih</span>
          </button>

          <!-- Tombol Export Excel -->
          <a href="{{ route('admin.santri.export', request()->query()) }}" id="btnExportExcel" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl font-bold text-xs text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 shadow-2xs transition-all cursor-pointer">
            <i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i>
            <span>Export Excel</span>
          </a>

          <!-- Tombol Import Excel -->
          <button type="button" onclick="openImportModal()" class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl font-bold text-xs text-blue-800 bg-blue-50 hover:bg-blue-100 border border-blue-200 shadow-2xs transition-all cursor-pointer">
            <i class="fa-solid fa-file-arrow-up text-blue-600 text-sm"></i>
            <span>Import Excel</span>
          </button>

          <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs text-white bg-emerald-800 hover:bg-emerald-700 shadow-sm transition-all cursor-pointer">
            <i class="fa-solid fa-user-plus"></i>
            <span>Tambah Santri Baru</span>
          </button>
        </div>
      </div>

      <!-- Filter Controls -->
      <form action="{{ route('admin.santri.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 pt-2 border-t border-slate-100">
        
        <!-- Filter Asrama -->
        <div>
          <label class="block text-[11px] font-bold text-slate-600 mb-1">Pilih Asrama</label>
          <select name="asrama_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
            <option value="">Semua Asrama ({{ $totalSantri }})</option>
            @foreach($asramas as $asr)
              <option value="{{ $asr->id }}" {{ request('asrama_id') == $asr->id ? 'selected' : '' }}>
                {{ $asr->nama }} ({{ $asr->santris_count }})
              </option>
            @endforeach
          </select>
        </div>

        <!-- Filter Jenis Kelamin -->
        <div>
          <label class="block text-[11px] font-bold text-slate-600 mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
            <option value="">Semua Gender</option>
            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki (Putra)</option>
            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan (Putri)</option>
          </select>
        </div>

        <!-- Filter Status -->
        <div>
          <label class="block text-[11px] font-bold text-slate-600 mb-1">Status Santri</label>
          <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
            <option value="">Semua Status</option>
            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Alumni" {{ request('status') == 'Alumni' ? 'selected' : '' }}>Alumni</option>
            <option value="Mutasi" {{ request('status') == 'Mutasi' ? 'selected' : '' }}>Mutasi</option>
            <option value="Cuti" {{ request('status') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
          </select>
        </div>

        <!-- Search Input -->
        <div class="sm:col-span-2 lg:col-span-2 flex items-end gap-2">
          <div class="flex-1">
            <label class="block text-[11px] font-bold text-slate-600 mb-1">Pencarian Santri</label>
            <div class="relative">
              <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Ketik nama, NIS, atau kamar..." class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
              <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
            </div>
          </div>
          <button type="submit" class="px-4 py-2 text-xs font-bold rounded-xl bg-slate-800 text-white hover:bg-slate-700 cursor-pointer">
            Cari
          </button>
          @if(request()->hasAny(['asrama_id', 'jenis_kelamin', 'status', 'cari']))
            <a href="{{ route('admin.santri.index') }}" class="px-3 py-2 text-xs font-bold rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200" title="Reset Filter">
              <i class="fa-solid fa-rotate-left"></i>
            </a>
          @endif
        </div>

      </form>
    </div>

    <!-- 3. TABEL DATA SANTRI -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
              <th class="py-3.5 px-3 text-center w-10 select-none">
                <input type="checkbox" id="checkAllSantri" onchange="toggleSelectAll(this)" onclick="toggleSelectAll(this)" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300 cursor-pointer" title="Centang Semua Santri di Halaman Ini">
              </th>
              <th class="py-3.5 px-3 text-center w-12">No</th>
              <th class="py-3.5 px-4">Santri</th>
              <th class="py-3.5 px-4">Asrama & Kamar</th>
              <th class="py-3.5 px-4">Jenjang & Kelas</th>
              <th class="py-3.5 px-4">Wali Santri</th>
              <th class="py-3.5 px-4 text-center">Status</th>
              <th class="py-3.5 px-4 text-center w-36">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
            @forelse($santris as $index => $item)
              @php
                $photoUrl = $item->foto 
                  ? asset($item->foto) 
                  : ($item->jenis_kelamin === 'Perempuan' 
                      ? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80' 
                      : 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=400&q=80');
                
                $isPutra = $item->asrama && $item->asrama->tipe === 'putra';
              @endphp
              <tr class="hover:bg-slate-50/80 transition-colors baris-santri" data-id="{{ $item->id }}">
                <td class="py-3 px-3 text-center">
                  <input type="checkbox" value="{{ $item->id }}" onchange="handleCheckboxChange()" class="santri-checkbox w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300 cursor-pointer">
                </td>
                <td class="py-3 px-3 text-center font-bold text-slate-400">
                  {{ $santris->firstItem() + $index }}
                </td>
                <td class="py-3 px-4">
                  <div class="flex items-center gap-3">
                    <img src="{{ $photoUrl }}" alt="{{ $item->nama }}" class="w-10 h-10 rounded-full object-cover border border-slate-200 shrink-0">
                    <div>
                      <div class="font-bold text-slate-900">{{ $item->nama }}</div>
                      <div class="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                        <span class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-[10px] font-semibold text-slate-600">{{ $item->nis ?? '-' }}</span>
                        <span>&bull;</span>
                        <span class="{{ $item->jenis_kelamin === 'Laki-laki' ? 'text-sky-700' : 'text-pink-700' }} font-semibold">{{ $item->jenis_kelamin }}</span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4">
                  <div class="flex flex-col">
                    <span class="inline-flex items-center gap-1 font-bold text-[11px] {{ $isPutra ? 'text-emerald-800' : 'text-purple-800' }}">
                      <i class="fa-solid {{ $isPutra ? 'fa-hotel text-emerald-600' : 'fa-building text-purple-600' }} text-[10px]"></i>
                      {{ $item->asrama->nama ?? 'Belum Ditentukan' }}
                    </span>
                    <span class="text-[11px] text-slate-500 mt-0.5">{{ $item->kamar ?? 'Kamar belum ditentukan' }}</span>
                  </div>
                </td>
                <td class="py-3 px-4">
                  <div class="font-semibold text-slate-900">{{ $item->jenjang ?? '-' }}</div>
                  <div class="text-[11px] text-slate-500">{{ $item->kelas ? 'Kelas ' . $item->kelas : '-' }}</div>
                </td>
                <td class="py-3 px-4">
                  <div class="font-medium text-slate-900">{{ $item->nama_wali ?? '-' }}</div>
                  <div class="text-[11px] text-slate-500 font-mono">{{ $item->telepon_wali ?? '-' }}</div>
                </td>
                <td class="py-3 px-4 text-center">
                  @if($item->status === 'Aktif')
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Aktif</span>
                  @elseif($item->status === 'Alumni')
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800 border border-blue-200">Alumni</span>
                  @elseif($item->status === 'Mutasi')
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">Mutasi</span>
                  @else
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">{{ $item->status }}</span>
                  @endif
                </td>
                <td class="py-3 px-4 text-center">
                  <div class="flex items-center justify-center gap-1.5">
                    
                    <!-- 1. Tombol Lihat -->
                    <button type="button" 
                            class="p-1.5 rounded-lg text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition-colors cursor-pointer"
                            title="Lihat Detail"
                            data-santri='@json($item)'
                            data-asrama="{{ $item->asrama->nama ?? '-' }}"
                            data-photourl="{{ $photoUrl }}"
                            onclick="openDetailSantri(this)">
                      <i class="fa-solid fa-eye text-xs"></i>
                    </button>

                    <!-- 2. Tombol Edit -->
                    <button type="button" 
                            class="p-1.5 rounded-lg text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 transition-colors cursor-pointer"
                            title="Edit Data Santri"
                            data-santri='@json($item)'
                            data-photourl="{{ $photoUrl }}"
                            data-action="{{ route('admin.santri.update', $item->id) }}"
                            onclick="openEditSantri(this)">
                      <i class="fa-solid fa-pen-to-square text-xs"></i>
                    </button>

                    <!-- 3. Tombol Hapus -->
                    <form action="{{ route('admin.santri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data santri \'{{ addslashes($item->nama) }}\'?');" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="p-1.5 rounded-lg text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 transition-colors cursor-pointer" title="Hapus Santri">
                        <i class="fa-solid fa-trash text-xs"></i>
                      </button>
                    </form>

                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="py-12 text-center text-xs text-slate-400">
                  <i class="fa-solid fa-user-xmark text-3xl mb-2 text-slate-300 block"></i>
                  Tidak ditemukan data santri yang cocok dengan filter yang dipilih.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="p-4 border-t border-slate-100">
        {{ $santris->links() }}
      </div>
    </div>

  </div>

  <!-- ========================================== -->
  <!-- MODAL 1: DETAIL DATA SANTRI -->
  <!-- ========================================== -->
  <div id="modalDetailSantri" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative max-h-[90vh] overflow-y-auto">
      <button type="button" onclick="closeDetailSantri()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 p-2 text-sm rounded-full hover:bg-slate-100 cursor-pointer">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>

      <div class="text-center pb-4 border-b border-slate-100">
        <div class="w-24 h-24 mx-auto rounded-full p-1 bg-gradient-to-tr from-amber-400 via-emerald-600 to-emerald-950 shadow-md overflow-hidden mb-3">
          <img id="detailSantriFoto" src="" alt="Foto Santri" class="w-full h-full object-cover rounded-full">
        </div>
        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase bg-emerald-100 text-emerald-800" id="detailSantriStatus">
          Aktif
        </div>
        <h3 class="text-lg font-extrabold text-slate-900 mt-2" id="detailSantriNama">Nama Santri</h3>
        <p class="text-xs font-mono text-slate-500" id="detailSantriNis">NIS: -</p>
      </div>

      <div class="py-4 space-y-3 text-xs">
        <div class="grid grid-cols-2 gap-3 bg-slate-50 p-3.5 rounded-2xl border border-slate-200">
          <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase">Asrama:</span>
            <div class="font-bold text-emerald-900 mt-0.5" id="detailSantriAsrama">-</div>
          </div>
          <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase">Kamar:</span>
            <div class="font-bold text-slate-800 mt-0.5" id="detailSantriKamar">-</div>
          </div>
          <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase">Jenjang Pendidikan:</span>
            <div class="font-semibold text-slate-800 mt-0.5" id="detailSantriJenjang">-</div>
          </div>
          <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase">Kelas:</span>
            <div class="font-semibold text-slate-800 mt-0.5" id="detailSantriKelas">-</div>
          </div>
        </div>

        <div class="space-y-2 bg-slate-50 p-3.5 rounded-2xl border border-slate-200">
          <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase">TTL:</span>
            <div class="font-medium text-slate-800" id="detailSantriTtl">-</div>
          </div>
          <div>
            <span class="text-[10px] font-bold text-slate-400 uppercase">Alamat Asal & Wilayah:</span>
            <div class="text-slate-700 font-medium" id="detailSantriAlamat">-</div>
            <div class="text-xs text-emerald-700 font-semibold mt-1" id="detailSantriWilayah">-</div>
          </div>
          <div class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-200">
            <div>
              <span class="text-[10px] font-bold text-slate-400 uppercase">Nama Wali:</span>
              <div class="font-semibold text-slate-800" id="detailSantriWali">-</div>
            </div>
            <div>
              <span class="text-[10px] font-bold text-slate-400 uppercase">No. HP Wali:</span>
              <div class="font-mono text-slate-800" id="detailSantriHp">-</div>
            </div>
          </div>
        </div>
      </div>

      <div class="pt-2 flex justify-end">
        <button type="button" onclick="closeDetailSantri()" class="px-5 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- MODAL 2: TAMBAH DATA SANTRI BARU -->
  <!-- ========================================== -->
  <div id="modalCreateSantri" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative max-h-[90vh] overflow-y-auto">
      <button type="button" onclick="closeCreateModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 p-2 text-sm rounded-full hover:bg-slate-100 cursor-pointer">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>

      <div class="mb-5 pb-3 border-b border-slate-100">
        <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-user-plus text-emerald-700"></i> Tambah Data Santri Baru
        </h3>
        <p class="text-xs text-slate-500">Input informasi data diri dan penempatan asrama santri</p>
      </div>

      <form action="{{ route('admin.santri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Asrama Penempatan -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Penempatan Asrama *</label>
            <select name="asrama_id" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white font-semibold">
              <option value="">-- Pilih Asrama --</option>
              @foreach($asramas as $asr)
                <option value="{{ $asr->id }}">{{ $asr->nama }} ({{ ucfirst($asr->tipe) }})</option>
              @endforeach
            </select>
          </div>

          <!-- Kamar -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama / Nomor Kamar</label>
            <input type="text" name="kamar" placeholder="Contoh: Kamar 03 (Abu Bakar)" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Nama Lengkap -->
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Santri *</label>
            <input type="text" name="nama" required placeholder="Nama lengkap santri" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-semibold">
          </div>

          <!-- NIS -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">NIS / NISN</label>
            <input type="text" name="nis" placeholder="MU-2026-..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Gender -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin *</label>
            <select name="jenis_kelamin" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Laki-laki">Laki-laki (Putra)</option>
              <option value="Perempuan">Perempuan (Putri)</option>
            </select>
          </div>

          <!-- Jenjang -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Jenjang Pendidikan</label>
            <select name="jenjang" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="MTs Miftahul Ulum">MTs Miftahul Ulum</option>
              <option value="SMK Miftahul Ulum">SMK Miftahul Ulum</option>
              <option value="Pesantren Salafiyah">Pesantren Salafiyah</option>
              <option value="Tahfidz Al-Qur'an">Tahfidz Al-Qur'an</option>
            </select>
          </div>

          <!-- Kelas -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kelas</label>
            <input type="text" name="kelas" placeholder="VII-A / X TKJ 1" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" placeholder="Kota/Kabupaten kelahiran" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap Asal Santri</label>
          <textarea name="alamat" rows="2" placeholder="Nama kampung, RT/RW..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <!-- Asal Daerah Santri (Provinsi s/d Desa - Searchable & Dropdown) -->
        <div class="p-4 bg-emerald-50/60 rounded-2xl border border-emerald-200/80 space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold text-emerald-950 flex items-center gap-1.5">
              <i class="fa-solid fa-map-location-dot text-emerald-600"></i> Asal Daerah Santri
            </span>
            <span class="text-[10px] text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full font-semibold">
              Bisa diketik & pilih dari dropdown
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <!-- 1. Provinsi -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Provinsi</label>
              <div class="relative">
                <input type="text" 
                       id="createSantriProvinsi" 
                       name="provinsi" 
                       list="listProvinsiCreate" 
                       value="Jawa Barat"
                       placeholder="Pilih/ketik Provinsi..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listProvinsiCreate"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>

            <!-- 2. Kabupaten / Kota -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Kabupaten / Kota</label>
              <div class="relative">
                <input type="text" 
                       id="createSantriKabupaten" 
                       name="kabupaten" 
                       list="listKabupatenCreate" 
                       placeholder="Pilih/ketik Kab/Kota..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listKabupatenCreate"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>

            <!-- 3. Kecamatan -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Kecamatan</label>
              <div class="relative">
                <input type="text" 
                       id="createSantriKecamatan" 
                       name="kecamatan" 
                       list="listKecamatanCreate" 
                       placeholder="Pilih/ketik Kecamatan..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listKecamatanCreate"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>

            <!-- 4. Desa / Kelurahan -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Desa / Kelurahan</label>
              <div class="relative">
                <input type="text" 
                       id="createSantriDesa" 
                       name="desa" 
                       list="listDesaCreate" 
                       placeholder="Pilih/ketik Desa..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listDesaCreate"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Orang Tua / Wali</label>
            <input type="text" name="nama_wali" placeholder="Nama ayah/ibu/wali" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Wali</label>
            <input type="text" name="telepon_wali" placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Status Santri *</label>
            <select name="status" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Aktif">Aktif</option>
              <option value="Alumni">Alumni</option>
              <option value="Mutasi">Mutasi</option>
              <option value="Cuti">Cuti</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Foto Santri (Opsional)</label>
          <input type="file" name="foto_file" accept="image/*" class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 bg-slate-50">
          <p class="text-[10px] text-slate-400 mt-0.5">Format JPG/PNG/WebP, maksimal 2MB.</p>
        </div>

        <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
          <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-emerald-800 hover:bg-emerald-700 shadow-md flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-save"></i> Simpan Data Santri
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- MODAL 3: EDIT DATA SANTRI -->
  <!-- ========================================== -->
  <div id="modalEditSantri" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative max-h-[90vh] overflow-y-auto">
      <button type="button" onclick="closeEditSantri()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 p-2 text-sm rounded-full hover:bg-slate-100 cursor-pointer">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>

      <div class="mb-5 pb-3 border-b border-slate-100">
        <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-pen-to-square text-amber-600"></i> Edit Data Santri
        </h3>
        <p class="text-xs text-slate-500">Perbarui informasi data diri atau kamar asrama santri</p>
      </div>

      <form id="editSantriForm" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Asrama Penempatan -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Penempatan Asrama *</label>
            <select id="editSantriAsrama" name="asrama_id" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white font-semibold">
              <option value="">-- Pilih Asrama --</option>
              @foreach($asramas as $asr)
                <option value="{{ $asr->id }}">{{ $asr->nama }} ({{ ucfirst($asr->tipe) }})</option>
              @endforeach
            </select>
          </div>

          <!-- Kamar -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama / Nomor Kamar</label>
            <input type="text" id="editSantriKamar" name="kamar" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Nama Lengkap -->
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Santri *</label>
            <input type="text" id="editSantriNama" name="nama" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-semibold">
          </div>

          <!-- NIS -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">NIS / NISN</label>
            <input type="text" id="editSantriNis" name="nis" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Gender -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin *</label>
            <select id="editSantriGender" name="jenis_kelamin" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Laki-laki">Laki-laki (Putra)</option>
              <option value="Perempuan">Perempuan (Putri)</option>
            </select>
          </div>

          <!-- Jenjang -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Jenjang Pendidikan</label>
            <select id="editSantriJenjang" name="jenjang" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="MTs Miftahul Ulum">MTs Miftahul Ulum</option>
              <option value="SMK Miftahul Ulum">SMK Miftahul Ulum</option>
              <option value="Pesantren Salafiyah">Pesantren Salafiyah</option>
              <option value="Tahfidz Al-Qur'an">Tahfidz Al-Qur'an</option>
            </select>
          </div>

          <!-- Kelas -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kelas</label>
            <input type="text" id="editSantriKelas" name="kelas" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Tempat Lahir</label>
            <input type="text" id="editSantriTempatLahir" name="tempat_lahir" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Lahir</label>
            <input type="date" id="editSantriTglLahir" name="tanggal_lahir" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap Asal Santri</label>
          <textarea id="editSantriAlamat" name="alamat" rows="2" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <!-- Asal Daerah Santri (Provinsi s/d Desa - Searchable & Dropdown) -->
        <div class="p-4 bg-emerald-50/60 rounded-2xl border border-emerald-200/80 space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold text-emerald-950 flex items-center gap-1.5">
              <i class="fa-solid fa-map-location-dot text-emerald-600"></i> Asal Daerah Santri
            </span>
            <span class="text-[10px] text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full font-semibold">
              Bisa diketik & pilih dari dropdown
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <!-- 1. Provinsi -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Provinsi</label>
              <div class="relative">
                <input type="text" 
                       id="editSantriProvinsi" 
                       name="provinsi" 
                       list="listProvinsiEdit" 
                       placeholder="Pilih/ketik Provinsi..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listProvinsiEdit"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>

            <!-- 2. Kabupaten / Kota -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Kabupaten / Kota</label>
              <div class="relative">
                <input type="text" 
                       id="editSantriKabupaten" 
                       name="kabupaten" 
                       list="listKabupatenEdit" 
                       placeholder="Pilih/ketik Kab/Kota..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listKabupatenEdit"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>

            <!-- 3. Kecamatan -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Kecamatan</label>
              <div class="relative">
                <input type="text" 
                       id="editSantriKecamatan" 
                       name="kecamatan" 
                       list="listKecamatanEdit" 
                       placeholder="Pilih/ketik Kecamatan..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listKecamatanEdit"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>

            <!-- 4. Desa / Kelurahan -->
            <div>
              <label class="block text-[11px] font-bold text-slate-700 mb-1">Desa / Kelurahan</label>
              <div class="relative">
                <input type="text" 
                       id="editSantriDesa" 
                       name="desa" 
                       list="listDesaEdit" 
                       placeholder="Pilih/ketik Desa..." 
                       class="w-full pl-3 pr-7 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white shadow-2xs font-medium" 
                       autocomplete="off">
                <datalist id="listDesaEdit"></datalist>
                <div class="absolute right-2.5 top-2.5 pointer-events-none text-slate-400 text-[10px]">
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Orang Tua / Wali</label>
            <input type="text" id="editSantriWali" name="nama_wali" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Wali</label>
            <input type="text" id="editSantriHp" name="telepon_wali" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Status Santri *</label>
            <select id="editSantriStatus" name="status" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Aktif">Aktif</option>
              <option value="Alumni">Alumni</option>
              <option value="Mutasi">Mutasi</option>
              <option value="Cuti">Cuti</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Ganti Foto Santri</label>
          <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
            <img id="editSantriFotoPreview" src="" alt="Foto" class="w-12 h-12 rounded-full object-cover border border-emerald-600 shrink-0">
            <div class="flex-1 min-w-0">
              <input type="file" name="foto_file" accept="image/*" class="w-full px-2 py-1 text-xs rounded-lg border border-slate-300 bg-white">
              <p class="text-[10px] text-slate-400 mt-0.5">Biarkan kosong jika tidak ingin mengubah foto santri.</p>
            </div>
          </div>
        </div>

        <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
          <button type="button" onclick="closeEditSantri()" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-emerald-800 hover:bg-emerald-700 shadow-md flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-check"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- FLOATING BULK ACTION BAR -->
  <div id="bulkActionBar" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-slate-900/95 text-white px-5 py-3 rounded-2xl shadow-2xl backdrop-blur-md border border-slate-700 flex items-center gap-3 transition-all duration-300 hidden max-w-[95vw] flex-wrap justify-center">
    <div class="flex items-center gap-2 text-xs font-bold">
      <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
      <span id="bulkCountText">0 santri dipilih</span>
    </div>
    <div class="h-4 w-px bg-slate-700 hidden sm:block"></div>
    <div class="flex items-center gap-2 flex-wrap">
      <!-- Tombol Pilih Semua yang Tampil -->
      <button type="button" onclick="selectAllVisible()" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs flex items-center gap-1.5 transition-colors cursor-pointer" title="Centang semua santri di halaman ini">
        <i class="fa-solid fa-square-check text-amber-400"></i>
        <span>Pilih Semua</span>
      </button>

      <!-- Tombol Export Terpilih -->
      <button type="button" onclick="exportSelected()" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-colors cursor-pointer">
        <i class="fa-solid fa-file-excel"></i>
        <span>Export Terpilih</span>
      </button>

      <!-- Tombol Hapus yang Dipilih -->
      <button type="button" onclick="deleteSelected()" class="px-3.5 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-sm transition-colors cursor-pointer">
        <i class="fa-solid fa-trash-can"></i>
        <span>Hapus yang Dipilih</span>
      </button>

      <!-- Tombol Hapus Semua -->
      <button type="button" onclick="deleteAllSantri()" class="px-3 py-1.5 rounded-xl bg-red-950/80 hover:bg-red-900 text-red-300 hover:text-white border border-red-700/60 font-bold text-xs flex items-center gap-1.5 transition-colors cursor-pointer" title="Hapus seluruh data santri di database">
        <i class="fa-solid fa-triangle-exclamation text-amber-400"></i>
        <span>Hapus Semua</span>
      </button>

      <!-- Tombol Batal Pilihan -->
      <button type="button" onclick="clearSelection()" class="px-2.5 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white font-medium text-xs transition-colors cursor-pointer">
        Batal
      </button>
    </div>
  </div>

  <!-- MODAL IMPORT SANTRI EXCEL -->
  <div id="modalImportSantri" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-8 space-y-5 animate-fade-in">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Import Data Santri (Excel)</h3>
          <p class="text-xs text-slate-500">Unggah berkas spreadsheet .xlsx atau .csv</p>
        </div>
        <button type="button" onclick="closeImportModal()" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <!-- Template Info Card -->
      <div class="p-4 rounded-2xl bg-emerald-50/80 border border-emerald-200 space-y-2">
        <div class="flex items-center justify-between">
          <span class="text-xs font-bold text-emerald-950 flex items-center gap-1.5">
            <i class="fa-solid fa-file-excel text-emerald-600"></i> Format Template Resmi
          </span>
          <a href="{{ route('admin.santri.template') }}" class="px-3 py-1 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-[11px] font-bold shadow-2xs flex items-center gap-1 transition-colors">
            <i class="fa-solid fa-download"></i> Unduh Template
          </a>
        </div>
        <p class="text-[11px] text-emerald-800 leading-relaxed">
          Gunakan format template di atas agar kolom NIS, Nama, Asrama, Kamar, dan Tanggal Lahir terpetakan dengan benar.
        </p>
      </div>

      <!-- Aturan Duplikasi NIS -->
      <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-[11px] text-amber-800 flex items-start gap-2">
        <i class="fa-solid fa-circle-info text-amber-600 mt-0.5"></i>
        <span>Bila NIS santri sudah ada di sistem, data santri tersebut akan <strong>diperbarui (update)</strong> secara otomatis. Baris dengan NIS baru akan ditambahkan sebagai santri baru.</span>
      </div>

      <!-- Form Upload -->
      <form action="{{ route('admin.santri.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
        @csrf
        <div>
          <label class="block font-bold text-slate-700 mb-1.5">Pilih Berkas Excel / CSV *</label>
          <input type="file" name="file" required accept=".xlsx,.xls,.csv" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-slate-50 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800">
          <p class="text-[10px] text-slate-400 mt-1">Ekstensi yang didukung: .xlsx, .xls, .csv (Maksimal 10 MB)</p>
        </div>

        <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="closeImportModal()" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
            Batal
          </button>
          <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold shadow-sm flex items-center gap-1.5 transition-colors">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <span>Mulai Import Data</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Hidden Form Bulk Delete & Export -->
  <form id="formBulkDelete" action="{{ route('admin.santri.bulk-delete') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="ids" id="bulkDeleteIds">
    <input type="hidden" name="mode" id="bulkDeleteMode" value="selected">
  </form>

  <form id="formBulkExport" action="{{ route('admin.santri.export') }}" method="GET" class="hidden">
    <input type="hidden" name="ids" id="bulkExportIds">
  </form>

  <script>
    // CHECKBOX & BULK ACTIONS
    function toggleSelectAll(master) {
      const checkboxes = document.querySelectorAll('.santri-checkbox');
      const isChecked = master ? master.checked : true;
      checkboxes.forEach(cb => {
        cb.checked = isChecked;
        const row = cb.closest('tr');
        if (row) {
          if (isChecked) {
            row.classList.add('bg-emerald-50/60');
          } else {
            row.classList.remove('bg-emerald-50/60');
          }
        }
      });
      if (master) master.checked = isChecked;
      updateBulkActionBar();
    }

    function selectAllVisible() {
      const master = document.getElementById('checkAllSantri');
      if (master) master.checked = true;
      toggleSelectAll(master);
    }

    function handleCheckboxChange() {
      const checkboxes = document.querySelectorAll('.santri-checkbox');
      const allChecked = Array.from(checkboxes).length > 0 && Array.from(checkboxes).every(cb => cb.checked);
      const master = document.getElementById('checkAllSantri');
      if (master) master.checked = allChecked;

      checkboxes.forEach(cb => {
        const row = cb.closest('tr');
        if (row) {
          if (cb.checked) {
            row.classList.add('bg-emerald-50/60');
          } else {
            row.classList.remove('bg-emerald-50/60');
          }
        }
      });

      updateBulkActionBar();
    }

    function getSelectedIds() {
      const checkboxes = document.querySelectorAll('.santri-checkbox:checked');
      return Array.from(checkboxes).map(cb => cb.value);
    }

    function updateBulkActionBar() {
      const selected = getSelectedIds();
      const bar = document.getElementById('bulkActionBar');
      const text = document.getElementById('bulkCountText');
      const btnExport = document.getElementById('btnExportExcel');
      const btnHeaderDelete = document.getElementById('btnHeaderBulkDelete');
      const btnHeaderDeleteText = document.getElementById('btnHeaderBulkDeleteText');

      if (selected.length > 0) {
        if (bar) bar.classList.remove('hidden');
        if (text) text.innerText = selected.length + ' santri dipilih';
        if (btnHeaderDelete) {
          btnHeaderDelete.classList.remove('hidden');
          btnHeaderDelete.classList.add('inline-flex');
          if (btnHeaderDeleteText) {
            btnHeaderDeleteText.innerText = 'Hapus yang Dipilih (' + selected.length + ')';
          }
        }
        if (btnExport) {
          btnExport.innerHTML = '<i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i> <span>Export Terpilih (' + selected.length + ')</span>';
          btnExport.href = "{{ route('admin.santri.export') }}?ids=" + selected.join(',');
        }
      } else {
        if (bar) bar.classList.add('hidden');
        if (btnHeaderDelete) {
          btnHeaderDelete.classList.add('hidden');
          btnHeaderDelete.classList.remove('inline-flex');
        }
        if (btnExport) {
          const currentQuery = new URLSearchParams(window.location.search).toString();
          btnExport.innerHTML = '<i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i> <span>Export Excel</span>';
          btnExport.href = "{{ route('admin.santri.export') }}" + (currentQuery ? '?' + currentQuery : '');
        }
      }
    }

    function clearSelection() {
      const master = document.getElementById('checkAllSantri');
      if (master) master.checked = false;
      const checkboxes = document.querySelectorAll('.santri-checkbox');
      checkboxes.forEach(cb => {
        cb.checked = false;
        const row = cb.closest('tr');
        if (row) row.classList.remove('bg-emerald-50/60');
      });
      updateBulkActionBar();
    }

    function exportSelected() {
      const ids = getSelectedIds();
      if (ids.length === 0) {
        alert('Silakan pilih minimal 1 data santri untuk diexport.');
        return;
      }
      document.getElementById('bulkExportIds').value = ids.join(',');
      document.getElementById('formBulkExport').submit();
    }

    function deleteSelected() {
      const ids = getSelectedIds();
      if (ids.length === 0) {
        alert('Silakan pilih data santri yang ingin dihapus dengan mencentang kotak checklist.');
        return;
      }
      if (confirm(`Apakah Anda yakin ingin menghapus ${ids.length} santri yang dipilih secara permanen? Data yang telah dihapus tidak dapat dikembalikan.`)) {
        document.getElementById('bulkDeleteMode').value = 'selected';
        document.getElementById('bulkDeleteIds').value = ids.join(',');
        document.getElementById('formBulkDelete').submit();
      }
    }

    function deleteAllSantri() {
      const total = {{ $totalSantri }};
      if (total === 0) {
        alert('Tidak ada data santri di database.');
        return;
      }
      if (confirm(`⚠️ PERINGATAN BESAR!\nApakah Anda benar-benar yakin ingin MENGHAPUS SEMUA (${total}) DATA SANTRI di database?\n\nTindakan ini akan mengosongkan seluruh tabel santri secara permanen!`)) {
        const ketik = prompt(`Untuk konfirmasi akhir penghapusan massal, ketik kata "HAPUS SEMUA" di bawah ini:`);
        if (ketik && ketik.trim().toUpperCase() === 'HAPUS SEMUA') {
          document.getElementById('bulkDeleteMode').value = 'all';
          document.getElementById('bulkDeleteIds').value = '';
          document.getElementById('formBulkDelete').submit();
        } else if (ketik !== null) {
          alert('Konfirmasi dibatalkan. Teks yang dimasukkan tidak cocok.');
        }
      }
    }

    function openImportModal() {
      document.getElementById('modalImportSantri').classList.remove('hidden');
    }

    function closeImportModal() {
      document.getElementById('modalImportSantri').classList.add('hidden');
    }

    // ==========================================
    // AUTOCOMPLETE & DROPDOWN WILAYAH (PROVINSI, KABUPATEN, KECAMATAN, DESA)
    // ==========================================
    const WilayahManager = (function() {
      const BASE_URL = 'https://www.emsifa.com/api-wilayah-indonesia/api';

      const cache = {
        provinces: [],
        regencies: {},
        districts: {},
        villages: {}
      };

      // Fallback Data Resmi (Terjamin saat offline / jaringan lambat)
      const fallbackProvinces = [
        { id: "32", name: "JAWA BARAT" },
        { id: "31", name: "DKI JAKARTA" },
        { id: "33", name: "JAWA TENGAH" },
        { id: "35", name: "JAWA TIMUR" },
        { id: "36", name: "BANTEN" },
        { id: "34", name: "DI YOGYAKARTA" },
        { id: "18", name: "LAMPUNG" },
        { id: "16", name: "SUMATERA SELATAN" },
        { id: "12", name: "SUMATERA UTARA" },
        { id: "13", name: "SUMATERA BARAT" },
        { id: "14", name: "RIAU" },
        { id: "15", name: "JAMBI" }
      ];

      const fallbackJabarRegencies = [
        { id: "3206", name: "KABUPATEN TASIKMALAYA" },
        { id: "3278", name: "KOTA TASIKMALAYA" },
        { id: "3205", name: "KABUPATEN GARUT" },
        { id: "3207", name: "KABUPATEN CIAMIS" },
        { id: "3218", name: "KABUPATEN PANGANDARAN" },
        { id: "3279", name: "KOTA BANJAR" },
        { id: "3204", name: "KABUPATEN BANDUNG" },
        { id: "3217", name: "KABUPATEN BANDUNG BARAT" },
        { id: "3273", name: "KOTA BANDUNG" },
        { id: "3211", name: "KABUPATEN SUMEDANG" },
        { id: "3210", name: "KABUPATEN MAJALENGKA" },
        { id: "3208", name: "KABUPATEN KUNINGAN" },
        { id: "3209", name: "KABUPATEN CIREBON" },
        { id: "3274", name: "KOTA CIREBON" },
        { id: "3201", name: "KABUPATEN BOGOR" },
        { id: "3271", name: "KOTA BOGOR" },
        { id: "3202", name: "KABUPATEN SUKABUMI" },
        { id: "3272", name: "KOTA SUKABUMI" },
        { id: "3203", name: "KABUPATEN CIANJUR" },
        { id: "3212", name: "KABUPATEN INDRAMAYU" },
        { id: "3213", name: "KABUPATEN SUBANG" },
        { id: "3214", name: "KABUPATEN PURWAKARTA" },
        { id: "3215", name: "KABUPATEN KARAWANG" },
        { id: "3216", name: "KABUPATEN BEKASI" },
        { id: "3275", name: "KOTA BEKASI" },
        { id: "3276", name: "KOTA DEPOK" },
        { id: "3277", name: "KOTA CIMAHI" }
      ];

      const fallbackTasikDistricts = [
        { id: "3206090", name: "SODONGHILIR" },
        { id: "3206100", name: "TARAJU" },
        { id: "3206080", name: "BOJONGGAMBIR" },
        { id: "3206070", name: "BANTARKALONG" },
        { id: "3206071", name: "BOJONGASIH" },
        { id: "3206072", name: "CULAMEGA" },
        { id: "3206050", name: "CIKATOMAS" },
        { id: "3206060", name: "CIBALONG" },
        { id: "3206061", name: "PARUNGPONTENG" },
        { id: "3206010", name: "CIPATUJAH" },
        { id: "3206020", name: "KARANGNUNGGAL" },
        { id: "3206030", name: "CIKALONG" },
        { id: "3206040", name: "PANCATENGAH" },
        { id: "3206110", name: "SALAWU" },
        { id: "3206111", name: "PUSPAHIANG" },
        { id: "3206120", name: "TANJUNGJAYA" },
        { id: "3206130", name: "SUKARAJA" },
        { id: "3206140", name: "SALOPA" },
        { id: "3206141", name: "JATIWARAS" },
        { id: "3206150", name: "CINEAM" },
        { id: "3206151", name: "KARANGJAYA" },
        { id: "3206160", name: "MANONJAYA" },
        { id: "3206161", name: "GUNUNGTANJUNG" },
        { id: "3206190", name: "SINGAPARNA" },
        { id: "3206191", name: "SUKARAME" },
        { id: "3206192", name: "MANGUNREJA" },
        { id: "3206200", name: "CIGALONTANG" },
        { id: "3206210", name: "LEUWISARI" },
        { id: "3206211", name: "SARIWANGI" },
        { id: "3206212", name: "PADAKEMBANG" },
        { id: "3206221", name: "SUKARATU" },
        { id: "3206230", name: "CISAYONG" },
        { id: "3206231", name: "SUKAHENING" },
        { id: "3206240", name: "RAJAPOLAH" },
        { id: "3206250", name: "JAMANIS" },
        { id: "3206260", name: "CIAWI" },
        { id: "3206261", name: "KADIPATEN" },
        { id: "3206270", name: "PAGERAGEUNG" },
        { id: "3206271", name: "SUKARESIK" }
      ];

      const fallbackSodongVillages = [
        { id: "3206090001", name: "CUKANGJAYAGUNA" },
        { id: "3206090002", name: "SUKABAKTI" },
        { id: "3206090003", name: "PARUMASAN" },
        { id: "3206090004", name: "SEPATNUNGGAL" },
        { id: "3206090005", name: "RAKSAJAYA" },
        { id: "3206090006", name: "SODONGHILIR" },
        { id: "3206090007", name: "CUKANGKAWUNG" },
        { id: "3206090008", name: "CIKALONG" },
        { id: "3206090009", name: "CIPAINGEUN" },
        { id: "3206090010", name: "PAKALONGAN" },
        { id: "3206090011", name: "LEUWIDULANG" },
        { id: "3206090012", name: "MUNCANG" }
      ];

      function toTitleCase(str) {
        if (!str) return '';
        return str.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
      }

      function populateDatalist(datalistId, items) {
        const dl = document.getElementById(datalistId);
        if (!dl) return;
        dl.innerHTML = '';
        if (!Array.isArray(items)) return;
        items.forEach(item => {
          const opt = document.createElement('option');
          opt.value = toTitleCase(item.name);
          dl.appendChild(opt);
        });
      }

      async function fetchWithFallback(url, fallback) {
        try {
          const ctrl = new AbortController();
          const timer = setTimeout(() => ctrl.abort(), 4000);
          const res = await fetch(url, { signal: ctrl.signal });
          clearTimeout(timer);
          if (res.ok) {
            const data = await res.json();
            if (Array.isArray(data) && data.length > 0) return data;
          }
        } catch (e) {
          // offline fallback
        }
        return fallback;
      }

      async function getProvinces() {
        if (cache.provinces && cache.provinces.length > 0) return cache.provinces;
        const res = await fetchWithFallback(`${BASE_URL}/provinces.json`, fallbackProvinces);
        cache.provinces = res;
        return res;
      }

      async function getRegencies(provinceId) {
        if (!provinceId) return [];
        if (cache.regencies[provinceId]) return cache.regencies[provinceId];
        const fallback = (provinceId === '32') ? fallbackJabarRegencies : [];
        const res = await fetchWithFallback(`${BASE_URL}/regencies/${provinceId}.json`, fallback);
        cache.regencies[provinceId] = res;
        return res;
      }

      async function getDistricts(regencyId) {
        if (!regencyId) return [];
        if (cache.districts[regencyId]) return cache.districts[regencyId];
        const fallback = (regencyId === '3206') ? fallbackTasikDistricts : [];
        const res = await fetchWithFallback(`${BASE_URL}/districts/${regencyId}.json`, fallback);
        cache.districts[regencyId] = res;
        return res;
      }

      async function getVillages(districtId) {
        if (!districtId) return [];
        if (cache.villages[districtId]) return cache.villages[districtId];
        const fallback = (districtId === '3206090') ? fallbackSodongVillages : [];
        const res = await fetchWithFallback(`${BASE_URL}/villages/${districtId}.json`, fallback);
        cache.villages[districtId] = res;
        return res;
      }

      function findMatch(items, search) {
        if (!search || !Array.isArray(items)) return null;
        const s = search.trim().toLowerCase().replace(/^(kabupaten|kota|kecamatan|desa|kelurahan)\s+/i, '');
        return items.find(it => {
          const itName = it.name.toLowerCase().replace(/^(kabupaten|kota|kecamatan|desa|kelurahan)\s+/i, '');
          return itName === s || it.name.toLowerCase() === search.trim().toLowerCase();
        }) || null;
      }

      function setupInstance(prefix, dlSuffix) {
        const inpProv = document.getElementById(`${prefix}Provinsi`);
        const inpKab = document.getElementById(`${prefix}Kabupaten`);
        const inpKec = document.getElementById(`${prefix}Kecamatan`);
        const inpDesa = document.getElementById(`${prefix}Desa`);

        const dlProv = `listProvinsi${dlSuffix}`;
        const dlKab = `listKabupaten${dlSuffix}`;
        const dlKec = `listKecamatan${dlSuffix}`;
        const dlDesa = `listDesa${dlSuffix}`;

        let currentProvId = null;
        let currentRegId = null;
        let currentDistId = null;

        // Init Provinces
        getProvinces().then(provinces => {
          populateDatalist(dlProv, provinces);
          if (inpProv && inpProv.value) {
            const found = findMatch(provinces, inpProv.value);
            if (found) {
              currentProvId = found.id;
              getRegencies(found.id).then(regs => {
                populateDatalist(dlKab, regs);
                if (inpKab && inpKab.value) {
                  const regFound = findMatch(regs, inpKab.value);
                  if (regFound) {
                    currentRegId = regFound.id;
                    getDistricts(regFound.id).then(dists => {
                      populateDatalist(dlKec, dists);
                      if (inpKec && inpKec.value) {
                        const distFound = findMatch(dists, inpKec.value);
                        if (distFound) {
                          currentDistId = distFound.id;
                          getVillages(distFound.id).then(vills => {
                            populateDatalist(dlDesa, vills);
                          });
                        }
                      }
                    });
                  }
                }
              });
            }
          }
        });

        // Event: Provinsi changes
        async function handleProvChange() {
          const provinces = await getProvinces();
          const match = findMatch(provinces, inpProv.value);
          if (match) {
            currentProvId = match.id;
            const regencies = await getRegencies(match.id);
            populateDatalist(dlKab, regencies);
          }
        }

        if (inpProv) {
          inpProv.addEventListener('input', handleProvChange);
          inpProv.addEventListener('change', handleProvChange);
        }

        // Event: Kabupaten changes
        async function handleKabChange() {
          const provId = currentProvId || '32';
          const regencies = await getRegencies(provId);
          const match = findMatch(regencies, inpKab.value);
          if (match) {
            currentRegId = match.id;
            const districts = await getDistricts(match.id);
            populateDatalist(dlKec, districts);
          }
        }

        if (inpKab) {
          inpKab.addEventListener('input', handleKabChange);
          inpKab.addEventListener('change', handleKabChange);
        }

        // Event: Kecamatan changes
        async function handleKecChange() {
          const regId = currentRegId || '3206';
          const districts = await getDistricts(regId);
          const match = findMatch(districts, inpKec.value);
          if (match) {
            currentDistId = match.id;
            const villages = await getVillages(match.id);
            populateDatalist(dlDesa, villages);
          }
        }

        if (inpKec) {
          inpKec.addEventListener('input', handleKecChange);
          inpKec.addEventListener('change', handleKecChange);
        }
      }

      return {
        init: function() {
          setupInstance('createSantri', 'Create');
          setupInstance('editSantri', 'Edit');
        },
        initCreate: async function() {
          const provInp = document.getElementById('createSantriProvinsi');
          if (provInp && !provInp.value) {
            provInp.value = 'Jawa Barat';
          }
          const provinces = await getProvinces();
          populateDatalist('listProvinsiCreate', provinces);
          const jabarRegs = await getRegencies('32');
          populateDatalist('listKabupatenCreate', jabarRegs);
        },
        populateForEdit: async function(prov, kab, kec, desa) {
          const provinces = await getProvinces();
          populateDatalist('listProvinsiEdit', provinces);
          const provFound = findMatch(provinces, prov) || { id: '32' };
          const regencies = await getRegencies(provFound.id);
          populateDatalist('listKabupatenEdit', regencies);
          
          if (kab) {
            const regFound = findMatch(regencies, kab) || { id: '3206' };
            const districts = await getDistricts(regFound.id);
            populateDatalist('listKecamatanEdit', districts);

            if (kec) {
              const distFound = findMatch(districts, kec) || { id: '3206090' };
              const villages = await getVillages(distFound.id);
              populateDatalist('listDesaEdit', villages);
            }
          }
        }
      };
    })();

    // Initialize Wilayah Manager
    document.addEventListener('DOMContentLoaded', function() {
      WilayahManager.init();
    });

    // Modal Details, Create & Edit
    function openCreateModal() {
      document.getElementById('modalCreateSantri').classList.remove('hidden');
      if (window.WilayahManager) {
        WilayahManager.initCreate();
      }
    }

    function closeCreateModal() {
      document.getElementById('modalCreateSantri').classList.add('hidden');
    }

    function openDetailSantri(button) {
      try {
        const data = JSON.parse(button.getAttribute('data-santri'));
        const asramaNama = button.getAttribute('data-asrama');
        const photoUrl = button.getAttribute('data-photourl');

        document.getElementById('detailSantriNama').innerText = data.nama || '-';
        document.getElementById('detailSantriNis').innerText = 'NIS: ' + (data.nis || '-');
        document.getElementById('detailSantriStatus').innerText = data.status || 'Aktif';
        document.getElementById('detailSantriAsrama').innerText = asramaNama || '-';
        document.getElementById('detailSantriKamar').innerText = data.kamar || '-';
        document.getElementById('detailSantriJenjang').innerText = data.jenjang || '-';
        document.getElementById('detailSantriKelas').innerText = data.kelas || '-';
        
        let ttl = '';
        if (data.tempat_lahir) ttl += data.tempat_lahir;
        if (data.tanggal_lahir) ttl += (ttl ? ', ' : '') + data.tanggal_lahir;
        document.getElementById('detailSantriTtl').innerText = ttl || '-';

        document.getElementById('detailSantriAlamat').innerText = data.alamat || '-';
        let wilayahParts = [];
        if (data.desa) wilayahParts.push('Desa ' + data.desa);
        if (data.kecamatan) wilayahParts.push('Kec. ' + data.kecamatan);
        if (data.kabupaten) wilayahParts.push(data.kabupaten);
        document.getElementById('detailSantriWilayah').innerText = wilayahParts.length > 0 ? ('📍 ' + wilayahParts.join(', ')) : '-';
        document.getElementById('detailSantriWali').innerText = data.nama_wali || '-';
        document.getElementById('detailSantriHp').innerText = data.telepon_wali || '-';
        document.getElementById('detailSantriFoto').src = photoUrl;

        document.getElementById('modalDetailSantri').classList.remove('hidden');
      } catch (e) {
        console.error(e);
      }
    }

    function closeDetailSantri() {
      document.getElementById('modalDetailSantri').classList.add('hidden');
    }

    function openEditSantri(button) {
      try {
        const data = JSON.parse(button.getAttribute('data-santri'));
        const photoUrl = button.getAttribute('data-photourl');
        const actionUrl = button.getAttribute('data-action');

        document.getElementById('editSantriForm').action = actionUrl;
        document.getElementById('editSantriNama').value = data.nama || '';
        document.getElementById('editSantriNis').value = data.nis || '';
        document.getElementById('editSantriAsrama').value = data.asrama_id || '';
        document.getElementById('editSantriKamar').value = data.kamar || '';
        document.getElementById('editSantriGender').value = data.jenis_kelamin || 'Laki-laki';
        document.getElementById('editSantriJenjang').value = data.jenjang || '';
        document.getElementById('editSantriKelas').value = data.kelas || '';
        document.getElementById('editSantriTempatLahir').value = data.tempat_lahir || '';
        document.getElementById('editSantriTglLahir').value = data.tanggal_lahir ? data.tanggal_lahir.split('T')[0] : '';
        document.getElementById('editSantriAlamat').value = data.alamat || '';
        document.getElementById('editSantriProvinsi').value = data.provinsi || 'Jawa Barat';
        document.getElementById('editSantriKabupaten').value = data.kabupaten || '';
        document.getElementById('editSantriKecamatan').value = data.kecamatan || '';
        document.getElementById('editSantriDesa').value = data.desa || '';
        document.getElementById('editSantriWali').value = data.nama_wali || '';
        document.getElementById('editSantriHp').value = data.telepon_wali || '';
        document.getElementById('editSantriStatus').value = data.status || 'Aktif';
        document.getElementById('editSantriFotoPreview').src = photoUrl;

        if (window.WilayahManager) {
          WilayahManager.populateForEdit(data.provinsi || 'Jawa Barat', data.kabupaten, data.kecamatan, data.desa);
        }

        document.getElementById('modalEditSantri').classList.remove('hidden');
      } catch (e) {
        console.error(e);
      }
    }

    function closeEditSantri() {
      document.getElementById('modalEditSantri').classList.add('hidden');
    }

    // Close on outside click
    window.addEventListener('click', function(e) {
      const m1 = document.getElementById('modalDetailSantri');
      const m2 = document.getElementById('modalCreateSantri');
      const m3 = document.getElementById('modalEditSantri');
      const m4 = document.getElementById('modalImportSantri');
      if (e.target === m1) closeDetailSantri();
      if (e.target === m2) closeCreateModal();
      if (e.target === m3) closeEditSantri();
      if (e.target === m4) closeImportModal();
    });

    // Close on Escape
    window.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeDetailSantri();
        closeCreateModal();
        closeEditSantri();
        closeImportModal();
      }
    });
  </script>

@endsection
