@extends('layouts.admin')

@section('title', 'Dewan Masayikh')
@section('header_title', 'Pengelolaan Dewan Masayikh')

@section('content')

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    
    <!-- Left: List Masayikh -->
    <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
      <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <div>
          <h3 class="font-extrabold text-base text-slate-900">Daftar Dewan Masayikh Terdaftar</h3>
          <p class="text-xs text-slate-500 mt-0.5">Kelola data pimpinan, sesepuh, dan dewan pengasuh pesantren</p>
        </div>
        <span class="text-xs font-bold text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full border border-emerald-200">
          {{ $masayikhs->count() }} Tokoh
        </span>
      </div>

      <div class="divide-y divide-slate-100">
        @forelse($masayikhs as $m)
          @php
            $photoUrl = $m->foto_url;
          @endphp
          <div class="p-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 hover:bg-slate-50/80 transition-colors">
            
            <!-- Left Info -->
            <div class="flex items-center gap-4 flex-1 min-w-0">
              <div class="relative w-14 h-14 rounded-2xl overflow-hidden border-2 border-emerald-600/30 p-0.5 shrink-0 bg-slate-100 shadow-xs">
                <img src="{{ $photoUrl }}" 
                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=600&q=80';" 
                     alt="{{ $m->nama }}" 
                     class="w-full h-full object-cover rounded-xl">
                <span class="absolute bottom-0 right-0 bg-emerald-800 text-[9px] font-bold text-amber-300 px-1 rounded-tl-md">
                  #{{ $m->urutan ?? 1 }}
                </span>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-800 uppercase tracking-wider">
                    {{ $m->peran ?? 'Dewan Masayikh' }}
                  </span>
                  @if($m->gelar)
                    <span class="text-xs font-semibold text-amber-600">({{ $m->gelar }})</span>
                  @endif
                </div>
                <h4 class="font-extrabold text-sm text-slate-900 mt-0.5 truncate">{{ $m->nama }}</h4>
                <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $m->deskripsi ?? 'Belum ada deskripsi biografi.' }}</p>
              </div>
            </div>

            <!-- Action Buttons: Lihat, Edit, Hapus -->
            <div class="flex items-center gap-2 self-end md:self-center shrink-0">
              
              <!-- 1. Tombol LIHAT -->
              <button type="button" 
                      class="btn-view-masayikh inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition-colors cursor-pointer"
                      data-masayikh='@json($m)'
                      data-photourl="{{ $photoUrl }}"
                      onclick="openDetailModal(this)">
                <i class="fa-solid fa-eye text-sky-600"></i>
                <span>Lihat</span>
              </button>

              <!-- 2. Tombol EDIT -->
              <button type="button" 
                      class="btn-edit-masayikh inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 transition-colors cursor-pointer"
                      data-masayikh='@json($m)'
                      data-photourl="{{ $photoUrl }}"
                      data-action="{{ route('admin.masayikh.update', $m->id) }}"
                      onclick="openEditModal(this)">
                <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                <span>Edit</span>
              </button>

              <!-- 3. Tombol HAPUS -->
              <form action="{{ route('admin.masayikh.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Masayikh \'{{ addslashes($m->nama) }}\'? Data yang dihapus tidak dapat dikembalikan.');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 transition-colors cursor-pointer" title="Hapus Masayikh">
                  <i class="fa-solid fa-trash text-red-600"></i>
                  <span>Hapus</span>
                </button>
              </form>

            </div>

          </div>
        @empty
          <div class="p-12 text-center text-xs text-slate-400">
            <i class="fa-solid fa-user-slash text-3xl mb-2 text-slate-300 block"></i>
            Belum ada data masayikh yang terdaftar. Silakan tambahkan pada form di sebelah kanan.
          </div>
        @endforelse
      </div>
    </div>

    <!-- Right: Form Tambah Masayikh -->
    <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200 shadow-xs p-6 space-y-4">
      <div class="border-b border-slate-100 pb-3">
        <h3 class="font-extrabold text-base text-slate-900">Tambah Dewan Masayikh</h3>
        <p class="text-xs text-slate-500 mt-0.5">Input data tokoh sesepuh / pengasuh baru</p>
      </div>

      <form action="{{ route('admin.masayikh.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap & Gelar *</label>
          <input type="text" name="nama" required placeholder="Contoh: K.H. Ahmad Mubarok, M.Pd.I" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-semibold">
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Gelar / Amanah</label>
          <input type="text" name="gelar" placeholder="Contoh: Pimpinan Umum Pondok" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Peran Singkat (Badge)</label>
          <input type="text" name="peran" placeholder="Contoh: Pimpinan Utama / Dewan Pengasuh" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi & Keilmuan</label>
          <textarea name="deskripsi" rows="3" placeholder="Biografi singkat dan pengampu kajian kitab..." class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Foto Masayikh</label>
          <input type="file" name="foto_file" accept="image/*" class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 bg-slate-50">
          <p class="text-[10px] text-slate-400 mt-0.5">Format JPG/PNG/WebP, maksimal 2MB.</p>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan Tampil</label>
          <input type="number" name="urutan" value="{{ $masayikhs->count() + 1 }}" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <button type="submit" class="w-full py-2.5 px-4 rounded-xl font-bold text-xs text-white bg-emerald-800 hover:bg-emerald-700 shadow-md transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
          <i class="fa-solid fa-plus"></i> Simpan Data Masayikh
        </button>
      </form>
    </div>

  </div>

  <!-- ========================================== -->
  <!-- MODAL 1: LIHAT DETAIL MASAYIKH -->
  <!-- ========================================== -->
  <div id="detailModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 transform transition-all relative">
      <button type="button" onclick="closeDetailModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 p-2 text-sm rounded-full hover:bg-slate-100 cursor-pointer">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>

      <div class="text-center space-y-4">
        <div class="w-28 h-28 mx-auto rounded-full p-1 bg-gradient-to-tr from-amber-400 via-emerald-600 to-emerald-950 shadow-lg overflow-hidden">
          <img id="detailFoto" src="" alt="Foto Masayikh" class="w-full h-full object-cover rounded-full">
        </div>

        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-extrabold uppercase tracking-wider" id="detailPeran">
            Dewan Masayikh
          </div>
          <h3 class="text-xl font-extrabold text-slate-900 mt-2" id="detailNama">Nama Masayikh</h3>
          <p class="text-xs font-bold text-amber-600 mt-0.5" id="detailGelar">Gelar / Amanah</p>
          <div class="text-[11px] text-slate-400 mt-1">Nomor Urutan Tampil: <span id="detailUrutan" class="font-bold text-emerald-800">1</span></div>
        </div>

        <div class="bg-slate-50 rounded-2xl p-4 text-left border border-slate-200/80">
          <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">
            <i class="fa-solid fa-book-quran text-emerald-700 mr-1"></i> Biografi & Keilmuan:
          </div>
          <p class="text-xs text-slate-700 leading-relaxed whitespace-pre-line" id="detailDeskripsi">
            Deskripsi biografi belum tersedia.
          </p>
        </div>

        <div class="pt-2 flex justify-end">
          <button type="button" onclick="closeDetailModal()" class="px-5 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer">
            Tutup
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- MODAL 2: EDIT DATA MASAYIKH -->
  <!-- ========================================== -->
  <div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 transform transition-all relative max-h-[90vh] overflow-y-auto">
      <button type="button" onclick="closeEditModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 p-2 text-sm rounded-full hover:bg-slate-100 cursor-pointer">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>

      <div class="mb-5 pb-3 border-b border-slate-100">
        <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-pen-to-square text-amber-600"></i> Edit Data Dewan Masayikh
        </h3>
        <p class="text-xs text-slate-500">Perbarui data atau ganti foto tokoh masayikh</p>
      </div>

      <form id="editForm" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap & Gelar *</label>
          <input type="text" id="editNama" name="nama" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-semibold">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Gelar / Amanah</label>
            <input type="text" id="editGelar" name="gelar" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Peran Singkat (Badge)</label>
            <input type="text" id="editPeran" name="peran" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi & Keilmuan</label>
          <textarea id="editDeskripsi" name="deskripsi" rows="3" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600"></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Ganti Foto Tokoh</label>
          <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200">
            <img id="editFotoPreview" src="" alt="Foto Saat Ini" class="w-12 h-12 rounded-full object-cover border border-emerald-600 shrink-0">
            <div class="flex-1 min-w-0">
              <input type="file" name="foto_file" accept="image/*" class="w-full px-2 py-1 text-xs rounded-lg border border-slate-300 bg-white">
              <p class="text-[10px] text-slate-400 mt-0.5">Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan Tampil</label>
          <input type="number" id="editUrutan" name="urutan" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
          <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 cursor-pointer">
            Batal
          </button>
          <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-emerald-800 hover:bg-emerald-700 shadow-md flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-check"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- JavaScript Modal Functions -->
  <script>
    function openDetailModal(button) {
      try {
        const data = JSON.parse(button.getAttribute('data-masayikh'));
        const photoUrl = button.getAttribute('data-photourl');

        document.getElementById('detailNama').innerText = data.nama || '-';
        document.getElementById('detailGelar').innerText = data.gelar ? '(' + data.gelar + ')' : '';
        document.getElementById('detailPeran').innerText = data.peran || 'Dewan Masayikh';
        document.getElementById('detailUrutan').innerText = data.urutan || '1';
        document.getElementById('detailDeskripsi').innerText = data.deskripsi || 'Belum ada catatan biografi keilmuan.';
        document.getElementById('detailFoto').src = photoUrl;

        document.getElementById('detailModal').classList.remove('hidden');
      } catch (err) {
        console.error('Error opening detail modal:', err);
      }
    }

    function closeDetailModal() {
      document.getElementById('detailModal').classList.add('hidden');
    }

    function openEditModal(button) {
      try {
        const data = JSON.parse(button.getAttribute('data-masayikh'));
        const photoUrl = button.getAttribute('data-photourl');
        const actionUrl = button.getAttribute('data-action');

        document.getElementById('editForm').action = actionUrl;
        document.getElementById('editNama').value = data.nama || '';
        document.getElementById('editGelar').value = data.gelar || '';
        document.getElementById('editPeran').value = data.peran || '';
        document.getElementById('editUrutan').value = data.urutan || '1';
        document.getElementById('editDeskripsi').value = data.deskripsi || '';
        document.getElementById('editFotoPreview').src = photoUrl;

        document.getElementById('editModal').classList.remove('hidden');
      } catch (err) {
        console.error('Error opening edit modal:', err);
      }
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }

    // Close modals on clicking outside or ESC key
    window.addEventListener('click', function(e) {
      const detailModal = document.getElementById('detailModal');
      const editModal = document.getElementById('editModal');
      if (e.target === detailModal) closeDetailModal();
      if (e.target === editModal) closeEditModal();
    });

    window.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeDetailModal();
        closeEditModal();
      }
    });
  </script>

@endsection
