@extends('layouts.admin')

@section('title', 'Jadwal Harian Santri')
@section('header_title', 'Pengelolaan Jadwal Harian Santri 24 Jam')

@section('content')

  <div class="space-y-6">

    <!-- HEADER CARD -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
      <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 border-b border-slate-100 pb-6 mb-6">
        <div>
          <div class="flex items-center gap-2">
            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 uppercase tracking-wider">
              Rutinitas Santri
            </span>
            <span class="text-xs text-slate-400 font-semibold">• {{ count($jadwals) }} Kegiatan Terjadwal</span>
          </div>
          <h2 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">Jadwal Harian Santri 24 Jam</h2>
          <p class="text-xs text-slate-500 mt-0.5">Jadwal ini langsung ditampilkan pada halaman publik Asrama & Profil Pesantren</p>
        </div>

        <div class="flex items-center gap-3">
          <a href="{{ route('asrama') }}#jadwal" target="_blank" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition-all flex items-center gap-2">
            <i class="fa-solid fa-arrow-up-right-from-square text-emerald-600"></i>
            <span>Lihat di Halaman Publik</span>
          </a>
          <button type="button" onclick="openTambahModal()" class="px-5 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Tambah Jadwal</span>
          </button>
        </div>
      </div>

      <!-- TABEL JADWAL HARIAN -->
      <div class="overflow-x-auto border border-slate-200 rounded-2xl">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase text-[10px] tracking-wider">
            <tr>
              <th class="py-3 px-4 w-16 text-center">Urutan</th>
              <th class="py-3 px-4 w-44">Waktu / Jam</th>
              <th class="py-3 px-4">Nama Kegiatan & Agenda Santri</th>
              <th class="py-3 px-4 w-28 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-slate-700">
            @forelse($jadwals as $j)
              <tr class="hover:bg-slate-50/80 transition-colors">
                <td class="py-3.5 px-4 text-center">
                  <span class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-800 font-extrabold text-xs inline-flex items-center justify-center">
                    {{ $j->urutan }}
                  </span>
                </td>
                <td class="py-3.5 px-4">
                  <div class="font-bold text-slate-900 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-900 border border-amber-200/60 font-mono text-xs">
                    <i class="fa-regular fa-clock text-[10px] text-amber-600"></i>
                    <span>{{ $j->waktu }}</span>
                  </div>
                </td>
                <td class="py-3.5 px-4">
                  <div class="font-bold text-slate-800 text-sm">{{ $j->kegiatan }}</div>
                </td>
                <td class="py-3.5 px-4 text-right">
                  <div class="flex items-center justify-end gap-1.5">
                    <button type="button" 
                            onclick="openEditModal({{ $j->id }}, '{{ addslashes($j->waktu) }}', '{{ addslashes($j->kegiatan) }}', {{ $j->urutan }})" 
                            class="p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 hover:text-emerald-700 transition-colors" 
                            title="Edit Jadwal">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <form action="{{ route('admin.jadwal.destroy', $j) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus Jadwal">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="py-12 text-center text-slate-400">
                  <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-xl mb-2">
                    <i class="fa-solid fa-clock"></i>
                  </div>
                  <div class="font-bold text-slate-700 text-sm">Belum ada jadwal harian santri</div>
                  <p class="text-xs text-slate-400 mt-1">Klik tombol <b>Tambah Jadwal</b> di atas untuk menambahkan rutinitas baru.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>

  </div>

  <!-- MODAL TAMBAH JADWAL -->
  <div id="modalTambah" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl space-y-4">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <h3 class="font-black text-base text-slate-900">Tambah Jadwal Harian Baru</h3>
        <button type="button" onclick="closeTambahModal()" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-xl"></i>
        </button>
      </div>

      <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Rentang Waktu *</label>
            <input type="text" name="waktu" required placeholder="Contoh: 04.45 - 06.00" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 font-mono">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">No. Urutan</label>
            <input type="number" name="urutan" value="{{ count($jadwals) + 1 }}" min="1" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kegiatan Santri *</label>
          <textarea name="kegiatan" rows="3" required placeholder="Contoh: Pengajian Kitab Kuning Ba'da Shubuh (Sorogan/Bandongan)" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300"></textarea>
        </div>

        <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
          <button type="button" onclick="closeTambahModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold shadow-md">
            Simpan Jadwal
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT JADWAL -->
  <div id="modalEdit" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl space-y-4">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <h3 class="font-black text-base text-slate-900">Edit Jadwal Harian</h3>
        <button type="button" onclick="closeEditModal()" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-xl"></i>
        </button>
      </div>

      <form id="formEditJadwal" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Rentang Waktu *</label>
            <input type="text" id="editWaktu" name="waktu" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 font-mono">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">No. Urutan *</label>
            <input type="number" id="editUrutan" name="urutan" required min="1" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kegiatan Santri *</label>
          <textarea id="editKegiatan" name="kegiatan" rows="3" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300"></textarea>
        </div>

        <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
          <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold shadow-md">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openTambahModal() {
      document.getElementById('modalTambah').classList.remove('hidden');
    }
    function closeTambahModal() {
      document.getElementById('modalTambah').classList.add('hidden');
    }

    function openEditModal(id, waktu, kegiatan, urutan) {
      const form = document.getElementById('formEditJadwal');
      form.action = "{{ url('admin/jadwal') }}/" + id;
      document.getElementById('editWaktu').value = waktu;
      document.getElementById('editKegiatan').value = kegiatan;
      document.getElementById('editUrutan').value = urutan;
      document.getElementById('modalEdit').classList.remove('hidden');
    }
    function closeEditModal() {
      document.getElementById('modalEdit').classList.add('hidden');
    }
  </script>

@endsection
