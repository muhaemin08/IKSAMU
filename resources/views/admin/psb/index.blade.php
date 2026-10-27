@extends('layouts.admin')

@section('title', 'Pendaftaran Santri Baru (PSB)')
@section('header_title', 'Database Pendaftaran Calon Santri Baru (PSB)')

@section('content')

  <!-- STATS CARDS -->
  <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-6">
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
      <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Pendaftar</div>
      <div class="text-2xl font-black text-slate-900 mt-1">{{ $stats['total'] ?? 0 }}</div>
      <div class="text-[10px] text-slate-500 mt-0.5">Semua Calon Santri</div>
    </div>
    <div class="bg-amber-50/70 p-4 rounded-2xl border border-amber-200 shadow-2xs">
      <div class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Pending</div>
      <div class="text-2xl font-black text-amber-900 mt-1">{{ $stats['pending'] ?? 0 }}</div>
      <div class="text-[10px] text-amber-700/80 mt-0.5">Menunggu Verifikasi</div>
    </div>
    <div class="bg-blue-50/70 p-4 rounded-2xl border border-blue-200 shadow-2xs">
      <div class="text-[11px] font-bold text-blue-700 uppercase tracking-wider">Diverifikasi</div>
      <div class="text-2xl font-black text-blue-900 mt-1">{{ $stats['diverifikasi'] ?? 0 }}</div>
      <div class="text-[10px] text-blue-700/80 mt-0.5">Berkas Lengkap</div>
    </div>
    <div class="bg-emerald-50/70 p-4 rounded-2xl border border-emerald-200 shadow-2xs">
      <div class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Diterima</div>
      <div class="text-2xl font-black text-emerald-900 mt-1">{{ $stats['diterima'] ?? 0 }}</div>
      <div class="text-[10px] text-emerald-700/80 mt-0.5">Masuk Database Santri</div>
    </div>
    <div class="bg-red-50/70 p-4 rounded-2xl border border-red-200 shadow-2xs col-span-2 sm:col-span-1">
      <div class="text-[11px] font-bold text-red-700 uppercase tracking-wider">Ditolak</div>
      <div class="text-2xl font-black text-red-900 mt-1">{{ $stats['ditolak'] ?? 0 }}</div>
      <div class="text-[10px] text-red-700/80 mt-0.5">Tidak Memenuhi Syarat</div>
    </div>
  </div>

  <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
    
    <!-- Action Bar & Filter -->
    <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
      
      <!-- Filter Status & Search -->
      <div class="flex flex-wrap items-center gap-2 text-xs font-bold w-full lg:w-auto">
        <span class="text-slate-400">Filter:</span>
        <a href="{{ route('admin.psb.index') }}" class="px-3 py-1.5 rounded-full {{ !request('status') ? 'bg-emerald-800 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Semua ({{ $stats['total'] }})</a>
        <a href="{{ route('admin.psb.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-full {{ request('status') === 'pending' ? 'bg-amber-600 text-white' : 'bg-amber-100 text-amber-800 hover:bg-amber-200' }}">Pending</a>
        <a href="{{ route('admin.psb.index', ['status' => 'diverifikasi']) }}" class="px-3 py-1.5 rounded-full {{ request('status') === 'diverifikasi' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">Diverifikasi</a>
        <a href="{{ route('admin.psb.index', ['status' => 'diterima']) }}" class="px-3 py-1.5 rounded-full {{ request('status') === 'diterima' ? 'bg-emerald-600 text-white' : 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' }}">Diterima</a>
      </div>

      <div class="flex items-center gap-3 w-full lg:w-auto justify-between lg:justify-end">
        <!-- Search -->
        <form method="GET" action="{{ route('admin.psb.index') }}" class="relative">
          @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
          @endif
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / wali / HP..." class="pl-8 pr-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 w-44 sm:w-56">
          <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-xs"></i>
        </form>

        <!-- Tambah Manual Button -->
        <button onclick="document.getElementById('modalTambahPsb').classList.remove('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm flex items-center gap-1.5 transition-all shrink-0">
          <i class="fa-solid fa-user-plus"></i>
          <span>Tambah Calon Santri</span>
        </button>
      </div>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
            <th class="p-4">No. Reg</th>
            <th class="p-4">Nama Calon Santri</th>
            <th class="p-4">Pilihan Pendidikan & Asrama</th>
            <th class="p-4">Orang Tua / Wali</th>
            <th class="p-4">Asal Daerah</th>
            <th class="p-4">Status Database</th>
            <th class="p-4 text-center">Aksi & Verifikasi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($registrations as $r)
            <tr class="hover:bg-slate-50/80 transition-colors">
              <td class="p-4 font-mono font-bold text-slate-600">
                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[11px]">
                  #PSB-{{ str_pad($r->id, 4, '0', STR_PAD_LEFT) }}
                </span>
                <div class="text-[10px] text-slate-400 mt-1 font-normal">
                  {{ $r->created_at ? $r->created_at->format('d/m/Y H:i') : '-' }}
                </div>
              </td>
              <td class="p-4">
                <div class="font-extrabold text-sm text-slate-900">{{ $r->nama_santri }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 flex items-center gap-1">
                  @if(str_contains(strtolower($r->jenis_kelamin), 'putri') || str_contains(strtolower($r->jenis_kelamin), 'perempuan'))
                    <span class="px-1.5 py-0.2 rounded bg-pink-100 text-pink-700 text-[10px] font-bold">Putri</span>
                  @else
                    <span class="px-1.5 py-0.2 rounded bg-blue-100 text-blue-700 text-[10px] font-bold">Putra</span>
                  @endif
                </div>
              </td>
              <td class="p-4">
                <div class="font-bold text-emerald-950">{{ $r->pilihan_pendidikan }}</div>
                <div class="text-[11px] text-slate-500 flex items-center gap-1 mt-0.5">
                  <i class="fa-solid fa-hotel text-slate-400 text-[10px]"></i> {{ $r->pilihan_asrama }}
                </div>
              </td>
              <td class="p-4">
                <div class="font-bold text-slate-800">{{ $r->nama_wali }}</div>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $r->no_hp) }}" target="_blank" class="text-emerald-700 hover:text-emerald-900 flex items-center gap-1 font-semibold text-[11px] mt-0.5" title="Chat WhatsApp Wali">
                  <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i> {{ $r->no_hp }}
                </a>
              </td>
              <td class="p-4 text-slate-700 font-medium">
                <div class="max-w-xs line-clamp-2">{{ $r->alamat_asal }}</div>
              </td>
              <td class="p-4">
                <form action="{{ route('admin.psb.status', $r->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <select name="status" onchange="this.form.submit()" class="px-2.5 py-1 text-[11px] font-extrabold rounded-lg border focus:outline-none cursor-pointer transition-colors
                    {{ $r->status === 'diterima' ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : '' }}
                    {{ $r->status === 'diverifikasi' ? 'bg-blue-100 text-blue-800 border-blue-300' : '' }}
                    {{ $r->status === 'pending' ? 'bg-amber-100 text-amber-800 border-amber-300' : '' }}
                    {{ $r->status === 'ditolak' ? 'bg-red-100 text-red-800 border-red-300' : '' }}
                  ">
                    <option value="pending" {{ $r->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diverifikasi" {{ $r->status === 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                    <option value="diterima" {{ $r->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ $r->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                  </select>
                </form>
              </td>
              <td class="p-4 text-center">
                <div class="flex items-center justify-center gap-1.5">
                  @if($r->status !== 'diterima')
                    <form action="{{ route('admin.psb.terima', $r->id) }}" method="POST" onsubmit="return confirm('Terima calon santri ini dan masukkan langsung ke Database Santri Aktif?');">
                      @csrf
                      <button type="submit" class="px-2.5 py-1 rounded-lg text-[11px] font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-2xs flex items-center gap-1" title="Terima dan Masukkan ke Database Santri">
                        <i class="fa-solid fa-check"></i>
                        <span class="hidden sm:inline">Terima</span>
                      </button>
                    </form>
                  @else
                    <span class="px-2 py-1 rounded-lg text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200">
                      <i class="fa-solid fa-circle-check mr-1"></i> Santri Aktif
                    </span>
                  @endif

                  <button type="button" onclick="bukaModalDetail({{ json_encode($r) }})" class="p-1.5 text-slate-500 hover:text-emerald-700 rounded-lg hover:bg-slate-100" title="Lihat Detail Lengkap">
                    <i class="fa-solid fa-eye text-sm"></i>
                  </button>

                  <form action="{{ route('admin.psb.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Hapus data pendaftaran {{ $r->nama_santri }} dari database?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50" title="Hapus Data">
                      <i class="fa-solid fa-trash text-sm"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="p-10 text-center text-slate-400">
                <i class="fa-solid fa-inbox text-3xl mb-2 block text-slate-300"></i>
                <span>Belum ada data calon santri baru di database.</span>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($registrations->hasPages())
      <div class="p-4 border-t border-slate-100">
        {{ $registrations->links() }}
      </div>
    @endif

  </div>

  <!-- MODAL TAMBAH CALON SANTRI MANUAL -->
  <div id="modalTambahPsb" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-xl w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Input Pendaftar Santri Baru (Manual)</h3>
          <p class="text-xs text-slate-500">Pendaftaran santri yang datang langsung (offline) ke pesantren</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahPsb').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <form action="{{ route('admin.psb.store') }}" method="POST" class="space-y-4 text-xs">
        @csrf

        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Santri *</label>
          <input type="text" name="nama_santri" required placeholder="Contoh: Ahmad Fauzan" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Jenis Kelamin *</label>
            <select name="jenis_kelamin" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Laki-laki (Santri Putra)">Laki-laki (Santri Putra)</option>
              <option value="Perempuan (Santri Putri)">Perempuan (Santri Putri)</option>
            </select>
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Status Awal</label>
            <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white font-bold">
              <option value="pending">Pending</option>
              <option value="diverifikasi">Diverifikasi</option>
              <option value="diterima">Langsung Diterima</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Pilihan Jenjang Formal *</label>
            <select name="pilihan_pendidikan" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="MTs Miftahul Ulum (Setingkat SMP)">MTs Miftahul Ulum</option>
              <option value="SMK YAPIM KAB. TASIKMALAYA - TKJ">SMK YAPIM - TKJ</option>
              <option value="SMK YAPIM KAB. TASIKMALAYA - RPL">SMK YAPIM - RPL</option>
              <option value="SMK YAPIM KAB. TASIKMALAYA - TBSM">SMK YAPIM - TBSM</option>
              <option value="Pengajian Kitab Kuning Salafiyah Saja">Pengajian Kitab Salaf Saja</option>
            </select>
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Pilihan Asrama *</label>
            <select name="pilihan_asrama" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Asrama Selamet (Putra)">Asrama Selamet (Putra)</option>
              <option value="Asrama Rahayu (Putra)">Asrama Rahayu (Putra)</option>
              <option value="Asrama Al-Hidayah Lama (Putri)">Asrama Al-Hidayah Lama (Putri)</option>
              <option value="Asrama Al-Hidayah Baru (Putri)">Asrama Al-Hidayah Baru (Putri)</option>
              <option value="Santri Kalong / Non-Mukim (Warga Sekitar)">Santri Kalong / Non-Mukim</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Nama Orang Tua / Wali *</label>
            <input type="text" name="nama_wali" required placeholder="Nama Ayah / Ibu / Wali" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">No. WhatsApp / HP *</label>
            <input type="tel" name="no_hp" required placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Alamat Asal Santri *</label>
          <textarea name="alamat_asal" rows="2" required placeholder="Alamat lengkap calon santri..." class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div class="pt-2 flex justify-end gap-2">
          <button type="button" onclick="document.getElementById('modalTambahPsb').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm">
            Simpan ke Database
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL DETAIL PENDAFTAR -->
  <div id="modalDetailPsb" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-2xl w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <span id="detailNoReg" class="font-mono font-bold text-xs text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded">#PSB-0000</span>
          <h3 id="detailNama" class="text-base sm:text-lg font-extrabold text-slate-900 mt-1">Nama Santri</h3>
        </div>
        <button type="button" onclick="document.getElementById('modalDetailPsb').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <div class="space-y-4 text-xs text-slate-700">
        <!-- Identitas Santri -->
        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-2.5">
          <h4 class="font-bold text-slate-800 uppercase tracking-wider text-[11px] text-emerald-800 flex items-center gap-1.5">
            <i class="fa-solid fa-user"></i> Identitas Calon Santri
          </h4>
          <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <div>
              <span class="text-slate-400 block text-[11px]">Jenis Kelamin:</span>
              <span id="detailJk" class="font-bold text-slate-900">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Status Database:</span>
              <span id="detailStatus" class="font-bold uppercase text-[10px] px-2 py-0.5 rounded-full bg-slate-200">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Jalur Pendaftaran:</span>
              <span id="detailJalur" class="font-bold text-amber-700">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">NISN / NIK:</span>
              <span id="detailNisnNik" class="font-mono font-semibold text-slate-900">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Tempat, Tgl Lahir:</span>
              <span id="detailTtl" class="font-semibold text-slate-900">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Anak ke / Saudara:</span>
              <span id="detailAnakKe" class="font-semibold text-slate-900">-</span>
            </div>
            <div class="sm:col-span-2">
              <span class="text-slate-400 block text-[11px]">Asal Sekolah / Madrasah:</span>
              <span id="detailAsalSekolah" class="font-bold text-slate-900">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Pilihan Jenjang & Asrama:</span>
              <span id="detailJenjang" class="font-bold text-emerald-950">-</span>
            </div>
            <div class="col-span-2 sm:col-span-3">
              <span class="text-slate-400 block text-[11px]">Alamat Domisili:</span>
              <span id="detailAlamat" class="font-medium text-slate-800">-</span>
            </div>
          </div>
        </div>

        <!-- Orang Tua & Pembiayaan -->
        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-2.5">
          <h4 class="font-bold text-slate-800 uppercase tracking-wider text-[11px] text-emerald-800 flex items-center gap-1.5">
            <i class="fa-solid fa-users"></i> Orang Tua / Wali & Keuangan
          </h4>
          <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <div>
              <span class="text-slate-400 block text-[11px]">Ayah Kandung:</span>
              <span id="detailAyah" class="font-bold text-slate-900">-</span>
              <span id="detailPekerjaanAyah" class="text-[10px] text-slate-500 block">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Ibu Kandung:</span>
              <span id="detailIbu" class="font-bold text-slate-900">-</span>
              <span id="detailPekerjaanIbu" class="text-[10px] text-slate-500 block">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Wali / Kontak Utama:</span>
              <span id="detailWali" class="font-bold text-slate-900">-</span>
              <span id="detailHp" class="font-mono text-[11px] text-emerald-700 block">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Penghasilan Ortu:</span>
              <span id="detailPenghasilan" class="font-semibold text-slate-800">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Infaq / Wakaf Sukarela:</span>
              <span id="detailInfaq" class="font-mono font-bold text-amber-700">-</span>
            </div>
            <div>
              <span class="text-slate-400 block text-[11px]">Total Estimasi Biaya:</span>
              <span id="detailTotalBiaya" class="font-mono font-black text-emerald-700 text-sm">-</span>
            </div>
            <div class="col-span-2 sm:col-span-3">
              <span class="text-slate-400 block text-[11px]">Sumber Mengetahui Pesantren:</span>
              <span id="detailSumberInfo" class="font-medium text-slate-800">-</span>
            </div>
          </div>
        </div>
      </div>

      <div class="flex justify-between items-center gap-2 pt-2 border-t border-slate-100">
        <a id="detailWaBtn" href="#" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-1.5 shadow-xs">
          <i class="fa-brands fa-whatsapp text-sm"></i>
          <span>Hubungi via WhatsApp</span>
        </a>
        <button type="button" onclick="document.getElementById('modalDetailPsb').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold text-xs">
          Tutup
        </button>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  function formatRupiahAdmin(angka) {
    if (!angka) return 'Rp 0';
    return 'Rp ' + Number(angka).toLocaleString('id-ID');
  }

  function bukaModalDetail(data) {
    document.getElementById('detailNoReg').innerText = '#PSB-' + String(data.id).padStart(4, '0');
    document.getElementById('detailNama').innerText = data.nama_santri;
    document.getElementById('detailJk').innerText = data.jenis_kelamin || '-';
    document.getElementById('detailStatus').innerText = data.status || 'Pending';
    document.getElementById('detailJalur').innerText = data.jalur_pendaftaran || 'Reguler';
    document.getElementById('detailNisnNik').innerText = (data.nisn || '-') + ' / ' + (data.nik || '-');

    const ttl = (data.tempat_lahir || '') + (data.tanggal_lahir ? ', ' + data.tanggal_lahir : '');
    document.getElementById('detailTtl').innerText = ttl.trim() || '-';
    document.getElementById('detailAnakKe').innerText = (data.anak_ke || 1) + ' dari ' + (data.jumlah_saudara || 1) + ' bersaudara';
    document.getElementById('detailAsalSekolah').innerText = data.asal_sekolah || '-';
    document.getElementById('detailJenjang').innerText = (data.pilihan_pendidikan || '-') + ' (' + (data.pilihan_asrama || '-') + ')';
    document.getElementById('detailAlamat').innerText = data.alamat_asal || '-';

    document.getElementById('detailAyah').innerText = data.nama_ayah || '-';
    document.getElementById('detailPekerjaanAyah').innerText = (data.pekerjaan_ayah || '-') + (data.no_hp_ayah ? ' • ' + data.no_hp_ayah : '');
    document.getElementById('detailIbu').innerText = data.nama_ibu || '-';
    document.getElementById('detailPekerjaanIbu').innerText = (data.pekerjaan_ibu || '-') + (data.no_hp_ibu ? ' • ' + data.no_hp_ibu : '');

    document.getElementById('detailWali').innerText = data.nama_wali || data.nama_ayah || '-';
    document.getElementById('detailHp').innerText = data.no_hp || '-';
    document.getElementById('detailPenghasilan').innerText = data.penghasilan_ortu || '-';
    document.getElementById('detailInfaq').innerText = formatRupiahAdmin(data.infaq_sukarela);
    document.getElementById('detailTotalBiaya').innerText = formatRupiahAdmin(data.total_biaya);
    document.getElementById('detailSumberInfo').innerText = data.sumber_info || '-';

    const cleanHp = String(data.no_hp).replace(/[^0-9]/g, '');
    const namaKontak = data.nama_ayah || data.nama_wali || 'Bapak/Ibu';
    const waUrl = 'https://wa.me/' + cleanHp + '?text=Assalamu%27alaikum%20Bpk%2FIbu%20' + encodeURIComponent(namaKontak) + ',%20kami%20dari%20Panitia%20PSB%20Pondok%20Pesantren%20Miftahul%20Ulum%20Gunung%20Bubut%20mengenai%20pendaftaran%20an.%20' + encodeURIComponent(data.nama_santri);
    document.getElementById('detailWaBtn').href = waUrl;

    document.getElementById('modalDetailPsb').classList.remove('hidden');
  }
</script>
@endpush
