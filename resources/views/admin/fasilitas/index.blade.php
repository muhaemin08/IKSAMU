@extends('layouts.admin')

@section('title', 'Fasilitas Pesantren')
@section('header_title', 'Pengelolaan Fasilitas Pondok Pesantren')

@section('content')

  <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
    
    <!-- Action Bar -->
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h3 class="text-base font-extrabold text-slate-900">Daftar Sarana & Fasilitas Pesantren</h3>
        <p class="text-xs text-slate-500 mt-0.5">Fasilitas yang aktif akan ditampilkan secara dinamis di halaman publik</p>
      </div>

      <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
        <form method="GET" action="{{ route('admin.fasilitas.index') }}" class="relative">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari fasilitas..." class="pl-8 pr-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 w-44 sm:w-56">
          <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-xs"></i>
        </form>

        <button onclick="document.getElementById('modalTambahFasilitas').classList.remove('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm flex items-center gap-1.5 transition-all shrink-0">
          <i class="fa-solid fa-plus"></i>
          <span>Tambah Fasilitas</span>
        </button>
      </div>
    </div>

    @if($errors->any())
      <div class="m-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-xs text-red-700 space-y-1">
        <div class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-circle-exclamation"></i> Terjadi kesalahan:</div>
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Grid Fasilitas -->
    <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($fasilitas as $f)
        <div class="bg-slate-50/70 rounded-2xl border border-slate-200 overflow-hidden shadow-2xs hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="aspect-video w-full bg-slate-800 overflow-hidden relative">
              <img src="{{ str_starts_with($f->foto ?? '', 'http') ? $f->foto : asset($f->foto ?? 'assets/images/gedung-pesantren.webp') }}" 
                   onerror="this.onerror=null; this.src='{{ asset('assets/images/gedung-pesantren.webp') }}';"
                   alt="{{ $f->nama }}" 
                   class="w-full h-full object-cover">
              
              <div class="absolute top-3 left-3 flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-950/80 text-amber-300 backdrop-blur-xs shadow-xs">
                  <i class="fa-solid {{ $f->icon ?? 'fa-building-columns' }} mr-1"></i> {{ $f->kategori }}
                </span>
              </div>

              <div class="absolute top-3 right-3">
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ $f->is_active ? 'bg-emerald-600 text-white' : 'bg-slate-500 text-white' }}">
                  {{ $f->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
              </div>
            </div>

            <div class="p-4 space-y-2">
              <div class="flex items-start justify-between gap-2">
                <h4 class="font-extrabold text-sm text-slate-900">{{ $f->nama }}</h4>
                <span class="text-[10px] text-slate-400 font-bold shrink-0">Urutan: #{{ $f->urutan }}</span>
              </div>
              <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                {{ $f->deskripsi ?: 'Belum ada deskripsi fasilitas.' }}
              </p>
            </div>
          </div>

          <div class="p-4 pt-3 border-t border-slate-200/80 flex items-center justify-between text-xs bg-white">
            <span class="text-[11px] text-slate-400">
              <i class="fa-solid fa-clock mr-1"></i> {{ $f->updated_at ? $f->updated_at->diffForHumans() : '-' }}
            </span>
            <div class="flex items-center gap-1">
              <button type="button" onclick="bukaModalEditFasilitas({{ json_encode($f) }})" class="p-1.5 text-slate-600 hover:text-emerald-700 rounded-lg hover:bg-slate-100 transition-colors" title="Edit Fasilitas">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <form action="{{ route('admin.fasilitas.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Hapus fasilitas {{ $f->nama }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Hapus">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </form>
            </div>
          </div>

        </div>
      @empty
        <div class="col-span-full p-12 text-center text-slate-400">
          <i class="fa-solid fa-building-circle-xmark text-4xl mb-3 block text-slate-300"></i>
          <span>Belum ada data fasilitas pesantren.</span>
        </div>
      @endforelse
    </div>

    @if($fasilitas->hasPages())
      <div class="p-4 border-t border-slate-100">
        {{ $fasilitas->links() }}
      </div>
    @endif

  </div>

  <!-- MODAL TAMBAH FASILITAS -->
  <div id="modalTambahFasilitas" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Tambah Fasilitas Baru</h3>
          <p class="text-xs text-slate-500">Sarana prasarana penunjang kegiatan santri</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahFasilitas').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
        @csrf

        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Fasilitas *</label>
          <input type="text" name="nama" required placeholder="Contoh: Masjid Jami' Pesantren / Lapangan Futsal" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Kategori *</label>
            <select name="kategori" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Pusat Ibadah">Pusat Ibadah</option>
              <option value="Asrama Santri">Asrama Santri</option>
              <option value="Kajian & Dakwah">Kajian & Dakwah</option>
              <option value="Olahraga & Bakat">Olahraga & Bakat</option>
              <option value="Pendidikan Formal">Pendidikan Formal</option>
              <option value="Sarana Penunjang">Sarana Penunjang</option>
            </select>
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Pilihan Ikon</label>
            <select name="icon" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="fa-mosque">Masjid (fa-mosque)</option>
              <option value="fa-hotel">Asrama Putra (fa-hotel)</option>
              <option value="fa-person-dress">Asrama Putri (fa-person-dress)</option>
              <option value="fa-book-quran">Majlis / Qur'an (fa-book-quran)</option>
              <option value="fa-futbol">Futsal / Bola (fa-futbol)</option>
              <option value="fa-volleyball">Bola Volly (fa-volleyball)</option>
              <option value="fa-chalkboard-user">Kelas / Belajar (fa-chalkboard-user)</option>
              <option value="fa-laptop-code">Lab Komputer (fa-laptop-code)</option>
              <option value="fa-utensils">Dapur / Kantin (fa-utensils)</option>
              <option value="fa-kit-medical">Poskestren / Medis (fa-kit-medical)</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Deskripsi Fasilitas</label>
          <textarea name="deskripsi" rows="3" placeholder="Fungsi dan keunggulan fasilitas bagi santri..." class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Foto Fasilitas (Auto WebP)</label>
            <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Nomor Urutan Tampil</label>
            <input type="number" name="urutan" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalTambahFasilitas').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm">
            Simpan Fasilitas
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT FASILITAS -->
  <div id="modalEditFasilitas" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Edit Data Fasilitas</h3>
          <p class="text-xs text-slate-500">Perbarui informasi sarana prasarana pesantren</p>
        </div>
        <button type="button" onclick="document.getElementById('modalEditFasilitas').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <form id="formEditFasilitas" method="POST" action="" enctype="multipart/form-data" class="space-y-4 text-xs">
        @csrf
        @method('PUT')

        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Fasilitas *</label>
          <input type="text" id="editNamaFasilitas" name="nama" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Kategori *</label>
            <select id="editKategoriFasilitas" name="kategori" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Pusat Ibadah">Pusat Ibadah</option>
              <option value="Asrama Santri">Asrama Santri</option>
              <option value="Kajian & Dakwah">Kajian & Dakwah</option>
              <option value="Olahraga & Bakat">Olahraga & Bakat</option>
              <option value="Pendidikan Formal">Pendidikan Formal</option>
              <option value="Sarana Penunjang">Sarana Penunjang</option>
            </select>
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Pilihan Ikon</label>
            <select id="editIconFasilitas" name="icon" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="fa-mosque">Masjid (fa-mosque)</option>
              <option value="fa-hotel">Asrama Putra (fa-hotel)</option>
              <option value="fa-person-dress">Asrama Putri (fa-person-dress)</option>
              <option value="fa-book-quran">Majlis / Qur'an (fa-book-quran)</option>
              <option value="fa-futbol">Futsal / Bola (fa-futbol)</option>
              <option value="fa-volleyball">Bola Volly (fa-volleyball)</option>
              <option value="fa-chalkboard-user">Kelas / Belajar (fa-chalkboard-user)</option>
              <option value="fa-laptop-code">Lab Komputer (fa-laptop-code)</option>
              <option value="fa-utensils">Dapur / Kantin (fa-utensils)</option>
              <option value="fa-kit-medical">Poskestren / Medis (fa-kit-medical)</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Deskripsi Fasilitas</label>
          <textarea id="editDeskripsiFasilitas" name="deskripsi" rows="3" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Ganti Foto (Opsional, Auto WebP)</label>
            <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Nomor Urutan Tampil</label>
            <input type="number" id="editUrutanFasilitas" name="urutan" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="flex items-center gap-2 pt-1">
          <input type="checkbox" id="editIsActiveFasilitas" name="is_active" value="1" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
          <label for="editIsActiveFasilitas" class="font-bold text-slate-700 cursor-pointer">Tampilkan fasilitas ini di halaman publik (Aktif)</label>
        </div>

        <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalEditFasilitas').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  function bukaModalEditFasilitas(data) {
    document.getElementById('editNamaFasilitas').value = data.nama;
    document.getElementById('editKategoriFasilitas').value = data.kategori;
    document.getElementById('editIconFasilitas').value = data.icon || 'fa-building-columns';
    document.getElementById('editDeskripsiFasilitas').value = data.deskripsi || '';
    document.getElementById('editUrutanFasilitas').value = data.urutan || 0;
    document.getElementById('editIsActiveFasilitas').checked = Boolean(data.is_active);

    const form = document.getElementById('formEditFasilitas');
    form.action = "{{ url('admin/fasilitas') }}/" + data.id;

    document.getElementById('modalEditFasilitas').classList.remove('hidden');
  }
</script>
@endpush
