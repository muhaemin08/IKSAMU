@extends('layouts.admin')

@section('title', 'Cerita Alumni - Admin Panel')
@section('header_title', 'Pengelolaan Cerita & Testimoni Alumni')

@section('content')
<div class="space-y-6">

  <!-- Navigasi Tab Alumni -->
  <div class="flex items-center gap-2 border-b border-slate-200 pb-3">
    <a href="{{ route('admin.cerita-alumni.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-emerald-800 text-white shadow-xs flex items-center gap-2">
      <i class="fa-solid fa-quote-left text-amber-400"></i>
      <span>Cerita & Testimoni Alumni</span>
    </a>
    <a href="{{ route('admin.alumni.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-emerald-50 transition-colors flex items-center gap-2">
      <i class="fa-solid fa-user-graduate"></i>
      <span>Database Jumlah Alumni</span>
    </a>
  </div>

  <!-- Header Card & Quick Action -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-200 shadow-xs">
    <div>
      <div class="flex items-center gap-2 text-xs font-bold text-emerald-800 uppercase tracking-wider mb-1">
        <i class="fa-solid fa-graduation-cap"></i> Ikatan Alumni Miftahul Ulum (IKSAMU)
      </div>
      <h1 class="text-xl sm:text-2xl font-extrabold text-slate-800">Cerita Inspiratif & Testimoni Alumni</h1>
      <p class="text-xs text-slate-500 mt-1">
        Kelola kisah perjalanan, kiprah profesi, dan testimoni alumni untuk ditampilkan di halaman publik website.
      </p>
    </div>

    <div class="flex items-center gap-2 flex-wrap">
      <a href="{{ route('alumni') }}" target="_blank" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Halaman Alumni
      </a>
      <button onclick="bukaModalTambahCerita()" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl flex items-center gap-2 shadow-sm transition-all hover:shadow-md cursor-pointer">
        <i class="fa-solid fa-plus"></i> Tambah Cerita Alumni
      </button>
    </div>
  </div>

  @if(session('success'))
    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-xs font-semibold flex items-center gap-3">
      <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if($errors->any())
    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-xs space-y-1">
      <div class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-circle-exclamation"></i> Terjadi kesalahan input:</div>
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Tabel Cerita Alumni -->
  <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-3 bg-slate-50/50">
      <div class="text-xs font-bold text-slate-700">
        Total: <span class="text-emerald-800 font-extrabold">{{ $stats['total'] }} Kisah Alumni</span> ({{ $stats['active'] }} Ditampilkan)
      </div>
      <form method="GET" action="{{ route('admin.cerita-alumni.index') }}" class="relative w-full sm:w-64">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / profesi / cerita..." class="w-full pl-8 pr-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2 text-slate-400 text-xs"></i>
      </form>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
            <th class="py-3.5 px-4 w-12 text-center">Urutan</th>
            <th class="py-3.5 px-4">Alumni</th>
            <th class="py-3.5 px-4">Tahun & Jenjang</th>
            <th class="py-3.5 px-4">Kiprah / Profesi</th>
            <th class="py-3.5 px-4">Judul & Cuplikan Cerita</th>
            <th class="py-3.5 px-4 text-center">Status</th>
            <th class="py-3.5 px-4 text-center w-28">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          @forelse($ceritas as $c)
            @php
              $photoUrl = $c->foto ? (str_starts_with($c->foto, 'http') ? $c->foto : asset($c->foto)) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80';
            @endphp
            <tr class="hover:bg-slate-50/80 transition-colors">
              <td class="py-3 px-4 text-center font-bold text-slate-400">
                {{ $c->urutan }}
              </td>
              <td class="py-3 px-4">
                <div class="flex items-center gap-3">
                  <img src="{{ $photoUrl }}" alt="{{ $c->nama }}" class="w-11 h-11 rounded-full object-cover border border-slate-200 shadow-2xs shrink-0">
                  <div>
                    <div class="font-extrabold text-sm text-slate-900">{{ $c->nama }}</div>
                  </div>
                </div>
              </td>
              <td class="py-3 px-4">
                <div class="font-bold text-emerald-950">{{ $c->tahun_lulus }}</div>
                <div class="text-[11px] text-slate-400">{{ $c->jenjang ?? '-' }}</div>
              </td>
              <td class="py-3 px-4">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 font-bold text-[11px] border border-emerald-200">
                  {{ $c->profesi }}
                </span>
              </td>
              <td class="py-3 px-4 max-w-xs">
                <div class="font-bold text-slate-900 line-clamp-1">"{{ $c->judul }}"</div>
                <div class="text-[11px] text-slate-500 line-clamp-2 mt-0.5">{{ $c->isi_cerita }}</div>
              </td>
              <td class="py-3 px-4 text-center">
                @if($c->is_active)
                  <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Tayang</span>
                @else
                  <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">Draft</span>
                @endif
              </td>
              <td class="py-3 px-4 text-center">
                <div class="flex items-center justify-center gap-1.5">
                  <button type="button" onclick="bukaModalEditCerita({{ json_encode($c) }}, '{{ $photoUrl }}')" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer" title="Edit Cerita">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <form action="{{ route('admin.cerita-alumni.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Hapus cerita alumni dari {{ $c->nama }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Cerita">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="py-12 text-center text-slate-400">
                <i class="fa-solid fa-graduation-cap text-3xl mb-2 text-slate-300 block"></i>
                Belum ada data cerita alumni. Silakan klik tombol "Tambah Cerita Alumni".
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($ceritas->hasPages())
      <div class="p-4 border-t border-slate-100">
        {{ $ceritas->links() }}
      </div>
    @endif
  </div>
</div>

<!-- MODAL TAMBAH CERITA ALUMNI -->
<div id="modalTambahCerita" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-xl w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
      <div>
        <h3 class="text-base font-extrabold text-slate-900">Tambah Cerita Alumni</h3>
        <p class="text-xs text-slate-500">Kisah inspiratif, kiprah karir & testimoni alumni</p>
      </div>
      <button type="button" onclick="tutupModalTambahCerita()" class="p-1 text-slate-400 hover:text-slate-600">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form action="{{ route('admin.cerita-alumni.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
      @csrf

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Alumni *</label>
          <input type="text" name="nama" required placeholder="Contoh: Ust. H. Ahmad Fajar, Lc." class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
        <div>
          <label class="block font-bold text-slate-700 mb-1">Tahun Lulus / Angkatan *</label>
          <input type="text" name="tahun_lulus" required placeholder="Contoh: Lulusan 2018 / Angkatan 2020" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block font-bold text-slate-700 mb-1">Jenjang Pendidikan Terakhir</label>
          <input type="text" name="jenjang" placeholder="Contoh: MTs Miftahul Ulum & SMK RPL" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
        <div>
          <label class="block font-bold text-slate-700 mb-1">Profesi / Kiprah Saat Ini *</label>
          <input type="text" name="profesi" required placeholder="Contoh: Mahasiswa Al-Azhar / IT Engineer" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
      </div>

      <div>
        <label class="block font-bold text-slate-700 mb-1">Judul Cerita / Kutipan Utama *</label>
        <input type="text" name="judul" required placeholder="Contoh: Keberkahan Belajar dan Tirakat di Gunung Bubut" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-bold">
      </div>

      <div>
        <label class="block font-bold text-slate-700 mb-1">Isi Cerita Lengkap & Testimoni *</label>
        <textarea name="isi_cerita" rows="4" required placeholder="Ceritakan kenangan selama di pondok, tantangan, pesan untuk adik-adik santri, dan bagaimana nilai pesantren membimbing karir..." class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 leading-relaxed"></textarea>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
        <div>
          <label class="block font-bold text-slate-700 mb-1">Foto Alumni</label>
          <input type="file" name="foto_file" accept="image/*" class="w-full px-2 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-emerald-700 file:text-white">
        </div>
        <div>
          <label class="block font-bold text-slate-700 mb-1">Urutan Tampil</label>
          <input type="number" name="urutan" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
      </div>

      <div class="flex items-center gap-2 pt-1">
        <input type="checkbox" name="is_active" id="tambah_is_active" value="1" checked class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300 cursor-pointer">
        <label for="tambah_is_active" class="font-bold text-slate-700 cursor-pointer">Tayangkan di halaman website alumni</label>
      </div>

      <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
        <button type="button" onclick="tutupModalTambahCerita()" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">Batal</button>
        <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm flex items-center gap-1.5">
          <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Cerita
        </button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL EDIT CERITA ALUMNI -->
<div id="modalEditCerita" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-xl w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
      <div>
        <h3 class="text-base font-extrabold text-slate-900">Edit Cerita Alumni</h3>
        <p class="text-xs text-slate-500">Perbarui informasi kisah atau ganti foto alumni</p>
      </div>
      <button type="button" onclick="tutupModalEditCerita()" class="p-1 text-slate-400 hover:text-slate-600">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
    </div>

    <form id="formEditCerita" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Alumni *</label>
          <input type="text" id="editNamaAlumni" name="nama" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
        <div>
          <label class="block font-bold text-slate-700 mb-1">Tahun Lulus / Angkatan *</label>
          <input type="text" id="editTahunLulus" name="tahun_lulus" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block font-bold text-slate-700 mb-1">Jenjang Pendidikan Terakhir</label>
          <input type="text" id="editJenjang" name="jenjang" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
        <div>
          <label class="block font-bold text-slate-700 mb-1">Profesi / Kiprah Saat Ini *</label>
          <input type="text" id="editProfesi" name="profesi" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
      </div>

      <div>
        <label class="block font-bold text-slate-700 mb-1">Judul Cerita / Kutipan Utama *</label>
        <input type="text" id="editJudul" name="judul" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-bold">
      </div>

      <div>
        <label class="block font-bold text-slate-700 mb-1">Isi Cerita Lengkap & Testimoni *</label>
        <textarea id="editIsiCerita" name="isi_cerita" rows="4" required class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 leading-relaxed"></textarea>
      </div>

      <div class="flex items-center gap-4">
        <img id="editFotoPreview" src="" alt="Foto" class="w-14 h-14 rounded-full object-cover border border-slate-200 shadow-2xs shrink-0">
        <div class="flex-1">
          <label class="block font-bold text-slate-700 mb-1">Ganti Foto Alumni (Opsional)</label>
          <input type="file" name="foto_file" accept="image/*" class="w-full px-2 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-emerald-700 file:text-white">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4 items-center">
        <div>
          <label class="block font-bold text-slate-700 mb-1">Urutan Tampil</label>
          <input type="number" id="editUrutan" name="urutan" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>
        <div class="flex items-center gap-2 pt-4">
          <input type="checkbox" name="is_active" id="editIsActive" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300 cursor-pointer">
          <label for="editIsActive" class="font-bold text-slate-700 cursor-pointer">Tayangkan</label>
        </div>
      </div>

      <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
        <button type="button" onclick="tutupModalEditCerita()" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">Batal</button>
        <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm flex items-center gap-1.5">
          <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function bukaModalTambahCerita() {
    document.getElementById('modalTambahCerita').classList.remove('hidden');
  }

  function tutupModalTambahCerita() {
    document.getElementById('modalTambahCerita').classList.add('hidden');
  }

  function bukaModalEditCerita(item, photoUrl) {
    const form = document.getElementById('formEditCerita');
    form.action = `/admin/cerita-alumni/${item.id}`;

    document.getElementById('editNamaAlumni').value = item.nama || '';
    document.getElementById('editTahunLulus').value = item.tahun_lulus || '';
    document.getElementById('editJenjang').value = item.jenjang || '';
    document.getElementById('editProfesi').value = item.profesi || '';
    document.getElementById('editJudul').value = item.judul || '';
    document.getElementById('editIsiCerita').value = item.isi_cerita || '';
    document.getElementById('editUrutan').value = item.urutan || 0;
    document.getElementById('editIsActive').checked = !!item.is_active;
    document.getElementById('editFotoPreview').src = photoUrl;

    document.getElementById('modalEditCerita').classList.remove('hidden');
  }

  function tutupModalEditCerita() {
    document.getElementById('modalEditCerita').classList.add('hidden');
  }
</script>
@endsection
