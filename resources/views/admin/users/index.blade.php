@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('header_title', 'Manajemen Pengguna & Hak Akses Sistem')

@section('content')

  <!-- STATS CARDS -->
  <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
      <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total User</div>
      <div class="text-2xl font-black text-slate-900 mt-1">{{ $stats['total'] ?? 0 }}</div>
      <div class="text-[10px] text-slate-500 mt-0.5">Pengguna Terdaftar</div>
    </div>
    <div class="bg-purple-50/70 p-4 rounded-2xl border border-purple-200 shadow-2xs">
      <div class="text-[11px] font-bold text-purple-700 uppercase tracking-wider">Superadmin</div>
      <div class="text-2xl font-black text-purple-900 mt-1">{{ $stats['superadmin'] ?? 0 }}</div>
      <div class="text-[10px] text-purple-700/80 mt-0.5">Akses Penuh</div>
    </div>
    <div class="bg-blue-50/70 p-4 rounded-2xl border border-blue-200 shadow-2xs">
      <div class="text-[11px] font-bold text-blue-700 uppercase tracking-wider">Admin Lembaga</div>
      <div class="text-2xl font-black text-blue-900 mt-1">{{ $stats['admin'] ?? 0 }}</div>
      <div class="text-[10px] text-blue-700/80 mt-0.5">Kelola Santri & Formal</div>
    </div>
    <div class="bg-emerald-50/70 p-4 rounded-2xl border border-emerald-200 shadow-2xs">
      <div class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Penulis / Editor</div>
      <div class="text-2xl font-black text-emerald-900 mt-1">{{ $stats['penulis'] ?? 0 }}</div>
      <div class="text-[10px] text-emerald-700/80 mt-0.5">Khusus Artikel</div>
    </div>
  </div>

  <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
    
    <!-- Action Bar & Filter -->
    <div class="p-6 border-b border-slate-100 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
      
      <!-- Filter Role -->
      <div class="flex flex-wrap items-center gap-2 text-xs font-bold w-full lg:w-auto">
        <span class="text-slate-400">Filter Role:</span>
        <a href="{{ route('admin.users.index') }}" class="px-3 py-1.5 rounded-full {{ !request('role') ? 'bg-emerald-800 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">Semua ({{ $stats['total'] }})</a>
        <a href="{{ route('admin.users.index', ['role' => 'superadmin']) }}" class="px-3 py-1.5 rounded-full {{ request('role') === 'superadmin' ? 'bg-purple-600 text-white' : 'bg-purple-100 text-purple-800 hover:bg-purple-200' }}">Superadmin</a>
        <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="px-3 py-1.5 rounded-full {{ request('role') === 'admin' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-800 hover:bg-blue-200' }}">Admin Lembaga</a>
        <a href="{{ route('admin.users.index', ['role' => 'penulis']) }}" class="px-3 py-1.5 rounded-full {{ request('role') === 'penulis' ? 'bg-emerald-600 text-white' : 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' }}">Penulis</a>
      </div>

      <div class="flex items-center gap-3 w-full lg:w-auto justify-between lg:justify-end">
        <!-- Search -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="relative">
          @if(request('role'))
            <input type="hidden" name="role" value="{{ request('role') }}">
          @endif
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / username..." class="pl-8 pr-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 w-44 sm:w-56">
          <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-slate-400 text-xs"></i>
        </form>

        <!-- Tambah User Button -->
        <button onclick="document.getElementById('modalTambahUser').classList.remove('hidden')" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-sm flex items-center gap-1.5 transition-all shrink-0">
          <i class="fa-solid fa-user-plus"></i>
          <span>Tambah User</span>
        </button>
      </div>

    </div>

    @if(session('success'))
      <div class="m-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 flex items-center gap-2">
        <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if(session('error'))
      <div class="m-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-xs text-rose-800 flex items-center gap-2">
        <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm"></i>
        <span>{{ session('error') }}</span>
      </div>
    @endif

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

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
            <th class="p-4">Nama Pengguna</th>
            <th class="p-4">Username</th>
            <th class="p-4">Password</th>
            <th class="p-4">Peran (Role)</th>
            <th class="p-4">Terdaftar Sejak</th>
            <th class="p-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($users as $u)
            <tr class="hover:bg-slate-50/80 transition-colors {{ auth()->id() === $u->id ? 'bg-emerald-50/30' : '' }}">
              <!-- Nama Pengguna -->
              <td class="p-4">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-xs uppercase text-white shadow-2xs shrink-0
                    {{ $u->role === 'superadmin' ? 'bg-purple-700' : ($u->role === 'admin' ? 'bg-blue-600' : 'bg-emerald-600') }}
                  ">
                    {{ substr($u->name, 0, 1) }}
                  </div>
                  <div>
                    <div class="font-extrabold text-sm text-slate-900 flex items-center gap-1.5">
                      <span>{{ $u->name }}</span>
                      @if(auth()->id() === $u->id)
                        <span class="px-2 py-0.2 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">Anda</span>
                      @endif
                    </div>
                    <div class="text-[11px] text-slate-400">ID: #USR-{{ str_pad($u->id, 3, '0', STR_PAD_LEFT) }}</div>
                  </div>
                </div>
              </td>

              <!-- Username -->
              <td class="p-4">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 border border-slate-200 font-mono font-bold text-slate-800">
                  <i class="fa-solid fa-at text-[10px] text-slate-400"></i>
                  <span>{{ $u->username ?? explode('@', $u->email)[0] }}</span>
                </div>
              </td>

              <!-- Password -->
              <td class="p-4">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-50 border border-slate-200 text-slate-500 font-mono text-[11px]">
                  <i class="fa-solid fa-lock text-[10px] text-amber-500"></i>
                  <span>••••••••</span>
                  <span class="text-[9px] uppercase font-bold text-slate-400 tracking-wider ml-1">(Hash)</span>
                </span>
              </td>

              <!-- Peran (Role) -->
              <td class="p-4">
                @if($u->role === 'superadmin')
                  <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-800 font-extrabold text-[11px] inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-halved text-purple-600"></i> Superadmin
                  </span>
                @elseif($u->role === 'admin')
                  <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-extrabold text-[11px] inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-user-shield text-blue-600"></i> Admin Lembaga
                  </span>
                @else
                  <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-[11px] inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-nib text-emerald-600"></i> Penulis / Editor
                  </span>
                @endif
              </td>

              <!-- Terdaftar Sejak -->
              <td class="p-4 text-slate-600 font-medium whitespace-nowrap">
                <div class="flex items-center gap-1.5">
                  <i class="fa-regular fa-calendar text-slate-400 text-xs"></i>
                  <span>{{ $u->created_at ? $u->created_at->translatedFormat('d M Y, H:i') : '-' }}</span>
                </div>
              </td>

              <!-- Aksi (Jangan dirubah) -->
              <td class="p-4 text-center">
                <div class="flex items-center justify-center gap-1.5">
                  <button type="button" onclick="bukaModalEdit({{ json_encode($u) }})" class="p-2 text-slate-500 hover:text-emerald-700 rounded-lg hover:bg-slate-100 transition-colors" title="Edit Profil & Role User">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>

                  @if(auth()->id() !== $u->id)
                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $u->name }}? Tindakan ini tidak dapat dibatalkan.');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="p-2 text-slate-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Hapus User">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </form>
                  @else
                    <span class="p-2 text-slate-300 cursor-not-allowed" title="Akun Anda aktif, tidak dapat dihapus">
                      <i class="fa-solid fa-lock"></i>
                    </span>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="p-10 text-center text-slate-400">
                <i class="fa-solid fa-users-slash text-3xl mb-2 block text-slate-300"></i>
                <span>Tidak ada data user yang sesuai.</span>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($users->hasPages())
      <div class="p-4 border-t border-slate-100">
        {{ $users->links() }}
      </div>
    @endif

  </div>

  <!-- MODAL TAMBAH USER -->
  <div id="modalTambahUser" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-8 space-y-5 animate-fade-in">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Tambah User / Pengguna Baru</h3>
          <p class="text-xs text-slate-500">Buat akun petugas, admin lembaga, atau penulis baru</p>
        </div>
        <button type="button" onclick="document.getElementById('modalTambahUser').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4 text-xs">
        @csrf

        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Pengguna *</label>
          <input type="text" name="name" required placeholder="Contoh: Ust. H. Abdullah Syarif, M.Pd." class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Username (Untuk Login) *</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none font-bold text-slate-400">@</span>
            <input type="text" name="username" required placeholder="abdullah_syarif" pattern="[a-zA-Z0-9._-]+" title="Hanya huruf, angka, titik, strip atau underscore tanpa spasi" class="w-full pl-8 pr-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono font-medium">
          </div>
          <p class="text-[10px] text-slate-400 mt-1">Hanya huruf, angka, garis bawah (_), atau strip (-), tanpa spasi.</p>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Password *</label>
          <input type="password" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Peran (Role) *</label>
          <select name="role" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white font-bold">
            <option value="superadmin">Superadmin (Akses Penuh Seluruh Modul & Konfigurasi)</option>
            <option value="admin" selected>Admin Lembaga (Kelola Santri, PSB, Jadwal & Unit Formal)</option>
            <option value="penulis">Penulis / Editor (Khusus Pengelolaan Artikel & Publikasi)</option>
          </select>
        </div>

        <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalTambahUser').classList.add('hidden')" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
            Batal
          </button>
          <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm flex items-center gap-1.5">
            <i class="fa-solid fa-save"></i>
            <span>Simpan User Baru</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT USER -->
  <div id="modalEditUser" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-lg w-full p-6 sm:p-8 space-y-5 animate-fade-in">
      <div class="flex justify-between items-center border-b border-slate-100 pb-3">
        <div>
          <h3 class="text-base font-extrabold text-slate-900">Edit Profil & Peran User</h3>
          <p class="text-xs text-slate-500">Perbarui informasi nama pengguna, username, role, atau ganti password</p>
        </div>
        <button type="button" onclick="document.getElementById('modalEditUser').classList.add('hidden')" class="p-1 text-slate-400 hover:text-slate-600">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <form id="formEditUser" method="POST" action="" class="space-y-4 text-xs">
        @csrf
        @method('PUT')

        <div>
          <label class="block font-bold text-slate-700 mb-1">Nama Pengguna *</label>
          <input type="text" id="editName" name="name" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Username *</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none font-bold text-slate-400">@</span>
            <input type="text" id="editUsername" name="username" required pattern="[a-zA-Z0-9._-]+" class="w-full pl-8 pr-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-mono font-medium">
          </div>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Peran (Role) *</label>
          <select id="editRole" name="role" required class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white font-bold">
            <option value="superadmin">Superadmin (Akses Penuh Seluruh Modul & Konfigurasi)</option>
            <option value="admin">Admin Lembaga (Kelola Santri, PSB, Jadwal & Unit Formal)</option>
            <option value="penulis">Penulis / Editor (Khusus Pengelolaan Artikel & Publikasi)</option>
          </select>
        </div>

        <div class="p-3 bg-amber-50/60 rounded-xl border border-amber-200 text-amber-800 text-[11px]">
          <i class="fa-solid fa-circle-info text-amber-600 mr-1"></i>
          <span>Kosongkan kolom password di bawah ini jika Anda <b>tidak ingin</b> mengubah password user.</span>
        </div>

        <div>
          <label class="block font-bold text-slate-700 mb-1">Password Baru (Opsional)</label>
          <input type="password" name="password" minlength="6" placeholder="Masukkan password baru (minimal 6 karakter)" class="w-full px-3 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
          <button type="button" onclick="document.getElementById('modalEditUser').classList.add('hidden')" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 font-bold">
            Batal
          </button>
          <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold shadow-sm flex items-center gap-1.5">
            <i class="fa-solid fa-save"></i>
            <span>Simpan Perubahan</span>
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  function bukaModalEdit(user) {
    document.getElementById('editName').value = user.name || '';
    document.getElementById('editUsername').value = user.username || (user.email ? user.email.split('@')[0] : '');
    document.getElementById('editRole').value = user.role || 'admin';
    
    // Set form action URL
    const form = document.getElementById('formEditUser');
    form.action = "{{ url('admin/users') }}/" + user.id;

    document.getElementById('modalEditUser').classList.remove('hidden');
  }
</script>
@endpush
