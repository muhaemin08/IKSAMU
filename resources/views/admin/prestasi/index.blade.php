@extends('layouts.admin')

@section('title', 'Prestasi Santri')
@section('header_title', 'Pengelolaan Prestasi Santri & Lembaga')

@section('content')

  <!-- STATS CARDS -->
  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
      <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Prestasi</div>
      <div class="text-2xl font-black text-slate-900 mt-1">{{ $stats['total'] ?? 0 }}</div>
      <div class="text-[10px] text-slate-500 mt-0.5">Semua Penghargaan</div>
    </div>
    <div class="bg-amber-50/70 p-4 rounded-2xl border border-amber-200 shadow-2xs">
      <div class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Keagamaan / Kitab</div>
      <div class="text-2xl font-black text-amber-900 mt-1">{{ $stats['keagamaan'] ?? 0 }}</div>
      <div class="text-[10px] text-amber-700/80 mt-0.5">MQK, Tahfidz & Dakwah</div>
    </div>
    <div class="bg-blue-50/70 p-4 rounded-2xl border border-blue-200 shadow-2xs">
      <div class="text-[11px] font-bold text-blue-700 uppercase tracking-wider">Akademik & Vokasi</div>
      <div class="text-2xl font-black text-blue-900 mt-1">{{ $stats['akademik'] ?? 0 }}</div>
      <div class="text-[10px] text-blue-700/80 mt-0.5">Sains, LKS & IT</div>
    </div>
    <div class="bg-emerald-50/70 p-4 rounded-2xl border border-emerald-200 shadow-2xs">
      <div class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Tingkat Nasional</div>
      <div class="text-2xl font-black text-emerald-900 mt-1">{{ $stats['nasional'] ?? 0 }}</div>
      <div class="text-[10px] text-emerald-700/80 mt-0.5">Ajang Bergengsi</div>
    </div>
  </div>

  <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
    
    <!-- Action Bar & Filter -->
    <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
      <div>
        <h3 class="text-base font-extrabold text-slate-900">Daftar Prestasi & Penghargaan</h3>
        <p class="text-xs text-slate-500 mt-0.5">Dokumentasi kejuaraan santri dan lembaga yang tampil di website publik</p>
      </div>

      <div class="flex items-center gap-3 w-full lg:w-auto justify-between lg:justify-end">
        <form method="GET" action="{{ route('admin.prestasi.index') }}" class="relative">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kejuaraan / santri..." class="pl-8 pr-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 w-44 sm:w-56">
          <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-xs"></i>
        </form>

        <button onclick="document.getElementById('modalTambahPrestasi').classList.remove('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm flex items-center gap-1.5 transition-all shrink-0">
          <i class="fa-solid fa-trophy"></i>
          <span>Tambah Prestasi</span>
        </button>
      </div>
    </div>

    @if($errors->any())
      <div class="m-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-xs text-red-700 space-y-1">
        <div class="font-bold flex items-center gap-1.5"><i class="fa-solid fa-circle-exclamation"></i> Terjadi kesalahan input:</div>
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Table Prestasi -->
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
            <th class="p-4">Foto / Trophy</th>
            <th class="p-4">Nama Kejuaraan / Prestasi</th>
            <th class="p-4">Peraih / Pemenang</th>
            <th class="p-4">Tingkat & Tahun</th>
            <th class="p-4">Kategori</th>
            <th class="p-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($prestasi as $p)
            <tr class="hover:bg-slate-50/80 transition-colors">
              <td class="p-4">
                <div class="w-14 h-12 rounded-xl overflow-hidden bg-slate-900 border border-slate-200 shrink-0">
                  <img src="{{ str_starts_with($p->foto ?? '', 'http') ? $p->foto : asset($p->foto ?? 'assets/images/gedung-pesantren.webp') }}" 
                       onerror="this.onerror=null; this.src='{{ asset('assets/images/gedung-pesantren.webp') }}';"
                       alt="{{ $p->judul }}" 
                       class="w-full h-full object-cover">
                </div>
              </td>
              <td class="p-4">
                <div class="font-extrabold text-sm text-slate-900">{{ $p->judul }}</div>
                @if($p->deskripsi)
                  <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">{{ $p->deskripsi }}</p>
                @endif
              </td>
              <td class="p-4">
                <div class="font-bold text-emerald-950 flex items-center gap-1.5">
                  <i class="fa-solid fa-user-graduate text-emerald-600 text-xs"></i>
                  <span>{{ $p->peraih }}</span>
                </div>
              </td>
              <td class="p-4">
                <div class="flex items-center gap-1.5">
                  <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-800">
                    {{ $p->tingkat }}
                  </span>
                  <span class="text-slate-600 font-bold text-xs">{{ $p->tahun }}</span>
                </div>
              </td>
              <td class="p-4">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                  {{ $p->kategori }}
                </span>
              </td>
              <td class="p-4 text-center">
                <div class="flex items-center justify-center gap-1.5">
                  <button type="button" onclick="bukaModalEditPrestasi({{ json_encode($p) }})" class="p-1.5 text-slate-600 hover:text-emerald-700 rounded-lg hover:bg-slate-100 transition-colors" title="Edit Prestasi">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <form action="{{ route('admin.prestasi.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data prestasi {{ $p->judul }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Hapus">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="p-10 text-center text-slate-400">
                <i class="fa-solid fa-trophy text-3xl mb-2 block text-slate-300"></i>
                <span>Belum ada data prestasi yang diinputkan.</span>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($prestasi->hasPages())
      <div class="p-4 border-t border-slate-100">
        {{ $prestasi->links() }}
      </div>
    @endif

  </div>

  <!-- MODAL TAMBAH PRESTASI -->
  <div id="modalTambahPrestasi" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Tambah Prestasi Baru</h3>
          <p class="text-xs text-slate-500">Pencapaian santri atau lembaga pesantren</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahPrestasi').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
        @csrf

        <div>
          <label class="block font-bold text-slate-700 mb-1">Judul Kejuaraan / Prestasi *</label>
          <input type="text" name="judul" required placeholder="Contoh: Juara 1 Musabaqah Qira'atil Kutub (MQK)" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Kategori *</label>
            <select name="kategori" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Keagamaan / Kitab Kuning">Keagamaan / Kitab Kuning</option>
              <option value="Tahfidz Al-Qur'an">Tahfidz Al-Qur'an</option>
              <option value="Akademik & Sains">Akademik & Sains</option>
              <option value="Teknologi & Vokasi">Teknologi & Vokasi</option>
              <option value="Olahraga & Seni">Olahraga & Seni</option>
              <option value="Pidato / Bahasa">Pidato / Bahasa</option>
            </select>
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Tingkat Kejuaraan *</label>
            <select name="tingkat" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Kecamatan">Kecamatan</option>
              <option value="Kabupaten" selected>Kabupaten</option>
              <option value="Karesidenan / Wilayah">Karesidenan / Wilayah</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Nasional">Nasional</option>
              <option value="Internasional">Internasional</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Nama Peraih / Santri / Tim *</label>
            <input type="text" name="peraih" required placeholder="Contoh: Muhammad Farhan / Tim Futsal" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Tahun Perolehan *</label>
            <input type="text" name="tahun" value="{{ date('Y') }}" required placeholder="Contoh: 2026" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Deskripsi & Keterangan</label>
          <textarea name="deskripsi" rows="3" placeholder="Informasi detail mengenai lomba, penyelenggara, dan penghargaan..." class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Foto / Dokumentasi (Auto WebP)</label>
            <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Nomor Urutan Tampil</label>
            <input type="number" name="urutan" value="0" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalTambahPrestasi').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm flex items-center gap-1.5">
            <i class="fa-solid fa-save"></i>
            <span>Simpan Prestasi</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT PRESTASI -->
  <div id="modalEditPrestasi" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-8 space-y-5 animate-fade-in max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Edit Data Prestasi</h3>
          <p class="text-xs text-slate-500">Perbarui data kejuaraan santri</p>
        </div>
        <button type="button" onclick="document.getElementById('modalEditPrestasi').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <form id="formEditPrestasi" method="POST" action="" enctype="multipart/form-data" class="space-y-4 text-xs">
        @csrf
        @method('PUT')

        <div>
          <label class="block font-bold text-slate-700 mb-1">Judul Kejuaraan / Prestasi *</label>
          <input type="text" id="editJudulPrestasi" name="judul" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Kategori *</label>
            <select id="editKategoriPrestasi" name="kategori" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Keagamaan / Kitab Kuning">Keagamaan / Kitab Kuning</option>
              <option value="Tahfidz Al-Qur'an">Tahfidz Al-Qur'an</option>
              <option value="Akademik & Sains">Akademik & Sains</option>
              <option value="Teknologi & Vokasi">Teknologi & Vokasi</option>
              <option value="Olahraga & Seni">Olahraga & Seni</option>
              <option value="Pidato / Bahasa">Pidato / Bahasa</option>
            </select>
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Tingkat Kejuaraan *</label>
            <select id="editTingkatPrestasi" name="tingkat" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="Kecamatan">Kecamatan</option>
              <option value="Kabupaten">Kabupaten</option>
              <option value="Karesidenan / Wilayah">Karesidenan / Wilayah</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Nasional">Nasional</option>
              <option value="Internasional">Internasional</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Nama Peraih / Santri / Tim *</label>
            <input type="text" id="editPeraihPrestasi" name="peraih" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Tahun Perolehan *</label>
            <input type="text" id="editTahunPrestasi" name="tahun" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Deskripsi & Keterangan</label>
          <textarea id="editDeskripsiPrestasi" name="deskripsi" rows="3" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block font-bold text-slate-700 mb-1">Ganti Foto (Opsional, Auto WebP)</label>
            <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
          </div>
          <div>
            <label class="block font-bold text-slate-700 mb-1">Nomor Urutan Tampil</label>
            <input type="number" id="editUrutanPrestasi" name="urutan" class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div class="flex items-center gap-2 pt-1">
          <input type="checkbox" id="editIsActivePrestasi" name="is_active" value="1" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
          <label for="editIsActivePrestasi" class="font-bold text-slate-700 cursor-pointer">Tampilkan prestasi ini di halaman publik (Aktif)</label>
        </div>

        <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalEditPrestasi').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
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
  function bukaModalEditPrestasi(data) {
    document.getElementById('editJudulPrestasi').value = data.judul;
    document.getElementById('editKategoriPrestasi').value = data.kategori;
    document.getElementById('editTingkatPrestasi').value = data.tingkat;
    document.getElementById('editPeraihPrestasi').value = data.peraih;
    document.getElementById('editTahunPrestasi').value = data.tahun;
    document.getElementById('editDeskripsiPrestasi').value = data.deskripsi || '';
    document.getElementById('editUrutanPrestasi').value = data.urutan || 0;
    document.getElementById('editIsActivePrestasi').checked = Boolean(data.is_active);

    const form = document.getElementById('formEditPrestasi');
    form.action = "{{ url('admin/prestasi') }}/" + data.id;

    document.getElementById('modalEditPrestasi').classList.remove('hidden');
  }
</script>
@endpush
