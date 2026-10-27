@extends('layouts.admin')

@section('title', 'Pengaturan Biaya PSB - Admin Panel')

@section('content')
<div class="space-y-6">

  <!-- Header & Action -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
    <div>
      <div class="flex items-center gap-2 text-xs font-semibold text-emerald-700 uppercase tracking-wider mb-1">
        <i class="fa-solid fa-coins"></i> Keuangan & Penerimaan Santri
      </div>
      <h1 class="text-2xl font-bold text-slate-800">Pengaturan Biaya PSB</h1>
      <p class="text-sm text-slate-500 mt-1">
        Atur rincian biaya daftar ulang calon santri baru untuk jenjang MTs dan SMK. Perubahan nominal langsung tersinkronisasi ke formulir pendaftaran publik.
      </p>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('psb') }}" target="_blank" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Formulir Publik
      </a>
      <button onclick="bukaModalTambah()" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold rounded-xl flex items-center gap-2 shadow-sm transition-all hover:shadow-md">
        <i class="fa-solid fa-plus"></i> Tambah Komponen Biaya
      </button>
    </div>
  </div>

  @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm flex items-center gap-3">
      <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  <!-- Ringkasan Total Biaya -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="bg-gradient-to-br from-emerald-800 to-teal-900 rounded-2xl p-5 text-white shadow-sm relative overflow-hidden">
      <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-emerald-200 uppercase tracking-wider">Total Biaya MTs</span>
        <div class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center text-emerald-200">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
      </div>
      <div class="text-2xl font-extrabold text-white">
        Rp {{ number_format($totalMts, 0, ',', '.') }}
      </div>
      <p class="text-xs text-emerald-200/80 mt-1">Daftar ulang santri baru jenjang MTs (Komponen Aktif)</p>
    </div>

    <div class="bg-gradient-to-br from-blue-800 to-indigo-900 rounded-2xl p-5 text-white shadow-sm relative overflow-hidden">
      <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Total Biaya SMK</span>
        <div class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center text-blue-200">
          <i class="fa-solid fa-laptop-code"></i>
        </div>
      </div>
      <div class="text-2xl font-extrabold text-white">
        Rp {{ number_format($totalSmk, 0, ',', '.') }}
      </div>
      <p class="text-xs text-blue-200/80 mt-1">Daftar ulang santri baru jenjang SMK (Komponen Aktif)</p>
    </div>

    <div class="bg-gradient-to-br from-amber-600 to-amber-700 rounded-2xl p-5 text-white shadow-sm relative overflow-hidden">
      <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
      <div class="flex items-center justify-between mb-3">
        <span class="text-xs font-semibold text-amber-200 uppercase tracking-wider">Komponen Biaya Aktif</span>
        <div class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center text-amber-200">
          <i class="fa-solid fa-list-check"></i>
        </div>
      </div>
      <div class="text-2xl font-extrabold text-white">
        {{ $biayas->where('is_active', true)->count() }} <span class="text-base font-normal text-amber-200">/ {{ $biayas->count() }} Item</span>
      </div>
      <p class="text-xs text-amber-200/80 mt-1">Komponen yang dimasukkan dalam kalkulasi otomatis</p>
    </div>
  </div>

  <!-- Form Batch Update Nominal Biaya -->
  <form action="{{ route('admin.psb.biaya.batch') }}" method="POST">
    @csrf
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
      <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/60">
        <div>
          <h2 class="font-bold text-slate-800 text-base">Rincian Komponen Biaya Pendaftaran</h2>
          <p class="text-xs text-slate-500">Ubah nominal secara langsung pada tabel di bawah ini lalu klik tombol Simpan Perubahan.</p>
        </div>
        <button type="submit" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm rounded-xl shadow-sm transition-colors flex items-center justify-center gap-2">
          <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
        </button>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
          <thead>
            <tr class="bg-slate-100/80 text-slate-700 font-semibold border-b border-slate-200 text-xs uppercase tracking-wider">
              <th class="py-3.5 px-4 w-12 text-center">Aktif</th>
              <th class="py-3.5 px-4 w-12 text-center">Urutan</th>
              <th class="py-3.5 px-4">Nama Komponen Biaya</th>
              <th class="py-3.5 px-4">Kategori</th>
              <th class="py-3.5 px-4 w-44">Nominal MTs (Rp)</th>
              <th class="py-3.5 px-4 w-44">Nominal SMK (Rp)</th>
              <th class="py-3.5 px-4">Keterangan</th>
              <th class="py-3.5 px-4 w-28 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-slate-700">
            @forelse($biayas as $b)
              <tr class="hover:bg-slate-50/80 transition-colors {{ !$b->is_active ? 'opacity-60 bg-slate-50/40' : '' }}">
                <td class="py-3 px-4 text-center">
                  <input type="checkbox" name="biaya[{{ $b->id }}][is_active]" value="1" {{ $b->is_active ? 'checked' : '' }} class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                </td>
                <td class="py-3 px-4 text-center font-bold text-slate-400 text-xs">
                  {{ $b->urutan }}
                </td>
                <td class="py-3 px-4">
                  <div class="font-bold text-slate-800">{{ $b->nama_biaya }}</div>
                </td>
                <td class="py-3 px-4">
                  <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                    {{ $b->kategori }}
                  </span>
                </td>
                <td class="py-3 px-4">
                  <div class="relative rounded-lg shadow-sm">
                    <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-xs text-slate-400 font-semibold">Rp</span>
                    <input type="number" step="1000" name="biaya[{{ $b->id }}][nominal_mts]" value="{{ $b->nominal_mts }}" class="w-full pl-8 pr-2 py-1.5 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-mono">
                  </div>
                </td>
                <td class="py-3 px-4">
                  <div class="relative rounded-lg shadow-sm">
                    <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-xs text-slate-400 font-semibold">Rp</span>
                    <input type="number" step="1000" name="biaya[{{ $b->id }}][nominal_smk]" value="{{ $b->nominal_smk }}" class="w-full pl-8 pr-2 py-1.5 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-mono">
                  </div>
                </td>
                <td class="py-3 px-4">
                  <input type="text" name="biaya[{{ $b->id }}][keterangan]" value="{{ $b->keterangan }}" placeholder="Mis: Sekali di awal, Per bulan, dll" class="w-full px-2.5 py-1.5 text-xs border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </td>
                <td class="py-3 px-4 text-center">
                  <div class="flex items-center justify-center gap-1.5">
                    <button type="button" onclick="bukaModalEdit({{ json_encode($b) }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Rincian">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" onclick="konfirmasiHapus('{{ route('admin.psb-biaya-item.destroy', $b->id) }}', '{{ $b->nama_biaya }}')" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="py-8 text-center text-slate-400">
                  Belum ada data komponen biaya PSB. Silakan klik tombol "Tambah Komponen Biaya".
                </td>
              </tr>
            @endforelse
          </tbody>
          <tfoot>
            <tr class="bg-slate-50 font-bold text-slate-800 border-t-2 border-slate-300">
              <td colspan="4" class="py-3.5 px-4 text-right">TOTAL ESTIMASI BIAYA AKTIF:</td>
              <td class="py-3.5 px-4 font-mono text-emerald-700 text-sm">
                Rp {{ number_format($totalMts, 0, ',', '.') }}
              </td>
              <td class="py-3.5 px-4 font-mono text-blue-700 text-sm">
                Rp {{ number_format($totalSmk, 0, ',', '.') }}
              </td>
              <td colspan="2" class="py-3.5 px-4 text-xs text-slate-500">
                *Hanya menghitung item yang dicentang aktif
              </td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div class="p-4 border-t border-slate-100 flex justify-end bg-slate-50/50">
        <button type="submit" class="px-6 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm rounded-xl shadow-sm transition-colors flex items-center gap-2">
          <i class="fa-solid fa-floppy-disk"></i> Simpan Semua Perubahan
        </button>
      </div>
    </div>
  </form>
</div>

<!-- Modal Tambah Komponen Biaya -->
<div id="modalTambah" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl relative">
    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
      <h3 class="font-bold text-slate-800 text-lg">Tambah Komponen Biaya PSB</h3>
      <button onclick="tutupModalTambah()" class="text-slate-400 hover:text-slate-600">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form action="{{ route('admin.psb-biaya-item.store') }}" method="POST" class="mt-4 space-y-4">
      @csrf
      <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Nama Komponen Biaya <span class="text-rose-500">*</span></label>
        <input type="text" name="nama_biaya" required placeholder="Contoh: Seragam & Atribut Santri" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
      </div>

      <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Kategori Biaya <span class="text-rose-500">*</span></label>
        <input type="text" name="kategori" required placeholder="Contoh: Perlengkapan, Pendidikan, Sarana, Syahriyah" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Nominal MTs (Rp) <span class="text-rose-500">*</span></label>
          <input type="number" step="1000" name="nominal_mts" required placeholder="0" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 font-mono">
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Nominal SMK (Rp) <span class="text-rose-500">*</span></label>
          <input type="number" step="1000" name="nominal_smk" required placeholder="0" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 font-mono">
        </div>
      </div>

      <div class="grid grid-cols-3 gap-3">
        <div class="col-span-2">
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Keterangan / Periode</label>
          <input type="text" name="keterangan" placeholder="Contoh: 1x saat daftar ulang, Per semester" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Urutan Tampil</label>
          <input type="number" name="urutan" value="0" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>
      </div>

      <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
        <button type="button" onclick="tutupModalTambah()" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">Batal</button>
        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-emerald-700 hover:bg-emerald-800 rounded-xl shadow-sm transition-colors">Simpan Komponen</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Komponen Biaya -->
<div id="modalEdit" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl relative">
    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
      <h3 class="font-bold text-slate-800 text-lg">Edit Komponen Biaya PSB</h3>
      <button onclick="tutupModalEdit()" class="text-slate-400 hover:text-slate-600">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form id="formEditBiaya" method="POST" class="mt-4 space-y-4">
      @csrf
      @method('PUT')
      <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Nama Komponen Biaya <span class="text-rose-500">*</span></label>
        <input type="text" id="edit_nama_biaya" name="nama_biaya" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
      </div>

      <div>
        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Kategori Biaya <span class="text-rose-500">*</span></label>
        <input type="text" id="edit_kategori" name="kategori" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Nominal MTs (Rp) <span class="text-rose-500">*</span></label>
          <input type="number" step="1000" id="edit_nominal_mts" name="nominal_mts" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 font-mono">
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Nominal SMK (Rp) <span class="text-rose-500">*</span></label>
          <input type="number" step="1000" id="edit_nominal_smk" name="nominal_smk" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 font-mono">
        </div>
      </div>

      <div class="grid grid-cols-3 gap-3">
        <div class="col-span-2">
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Keterangan / Periode</label>
          <input type="text" id="edit_keterangan" name="keterangan" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Urutan Tampil</label>
          <input type="number" id="edit_urutan" name="urutan" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>
      </div>

      <div class="flex items-center gap-2">
        <input type="checkbox" id="edit_is_active" name="is_active" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
        <label for="edit_is_active" class="text-sm text-slate-700">Aktifkan komponen ini pada formulir pendaftaran</label>
      </div>

      <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
        <button type="button" onclick="tutupModalEdit()" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">Batal</button>
        <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-emerald-700 hover:bg-emerald-800 rounded-xl shadow-sm transition-colors">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Form Hapus Tersembunyi -->
<form id="formHapus" method="POST" class="hidden">
  @csrf
  @method('DELETE')
</form>

<script>
  function bukaModalTambah() {
    document.getElementById('modalTambah').classList.remove('hidden');
  }

  function tutupModalTambah() {
    document.getElementById('modalTambah').classList.add('hidden');
  }

  function bukaModalEdit(item) {
    const form = document.getElementById('formEditBiaya');
    form.action = `/admin/psb-biaya-item/${item.id}`;
    document.getElementById('edit_nama_biaya').value = item.nama_biaya || '';
    document.getElementById('edit_kategori').value = item.kategori || '';
    document.getElementById('edit_nominal_mts').value = item.nominal_mts || 0;
    document.getElementById('edit_nominal_smk').value = item.nominal_smk || 0;
    document.getElementById('edit_keterangan').value = item.keterangan || '';
    document.getElementById('edit_urutan').value = item.urutan || 0;
    document.getElementById('edit_is_active').checked = !!item.is_active;

    document.getElementById('modalEdit').classList.remove('hidden');
  }

  function tutupModalEdit() {
    document.getElementById('modalEdit').classList.add('hidden');
  }

  function konfirmasiHapus(url, nama) {
    if (confirm(`Yakin ingin menghapus komponen biaya '${nama}'?`)) {
      const form = document.getElementById('formHapus');
      form.action = url;
      form.submit();
    }
  }
</script>
@endsection
