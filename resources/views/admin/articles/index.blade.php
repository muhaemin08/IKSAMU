@extends('layouts.admin')

@section('title', 'Pengelolaan Artikel')
@section('header_title', 'Pengelolaan Artikel & Publikasi')

@section('content')

  <!-- Action Bar & Filter -->
  <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs mb-8 flex flex-col sm:flex-row justify-between items-center gap-4">
    
    <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
      <form action="{{ route('admin.articles.index') }}" method="GET" class="flex items-center gap-2">
        <select name="kategori" onchange="this.form.submit()" class="px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
          <option value="">Semua Kategori</option>
          @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ request('kategori') == $c->id ? 'selected' : '' }}>{{ $c->nama }}</option>
          @endforeach
        </select>
        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul artikel..." class="px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        <button type="submit" class="px-3.5 py-2 text-xs rounded-xl bg-slate-800 text-white font-bold hover:bg-slate-700">Cari</button>
      </form>
    </div>

    <a href="{{ route('admin.articles.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-emerald-800 hover:bg-emerald-700 shadow-sm transition-all">
      <i class="fa-solid fa-plus"></i>
      <span>Tulis Artikel Baru</span>
    </a>

  </div>

  <!-- Articles Table -->
  <div class="bg-white rounded-3xl border border-slate-200 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
            <th class="p-4">Thumbnail</th>
            <th class="p-4">Judul & Kategori</th>
            <th class="p-4">Penulis</th>
            <th class="p-4">Status</th>
            <th class="p-4">Pembaca</th>
            <th class="p-4">Tanggal</th>
            <th class="p-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($articles as $a)
            <tr class="hover:bg-slate-50/80 transition-colors">
              <td class="p-4 w-20">
                <div class="w-14 h-10 rounded-lg overflow-hidden bg-slate-100">
                  <img src="{{ asset($a->thumbnail ?? 'assets/images/logo-pesantren.jpg') }}" alt="" class="w-full h-full object-cover">
                </div>
              </td>
              <td class="p-4 max-w-xs">
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $a->category->badge_class ?? 'bg-slate-100' }}">
                  {{ $a->category->nama ?? 'Umum' }}
                </span>
                <div class="font-bold text-slate-900 mt-1 line-clamp-2">{{ $a->judul }}</div>
              </td>
              <td class="p-4 font-semibold text-slate-600">{{ $a->penulis }}</td>
              <td class="p-4">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $a->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700' }}">
                  {{ $a->status }}
                </span>
              </td>
              <td class="p-4 font-semibold text-slate-600">{{ $a->views }}x</td>
              <td class="p-4 text-slate-500 whitespace-nowrap">{{ $a->tanggal_publikasi ? $a->tanggal_publikasi->translatedFormat('d M Y') : $a->created_at->format('d/m/Y') }}</td>
              <td class="p-4 text-center whitespace-nowrap">
                <div class="inline-flex items-center gap-1.5">
                  <a href="{{ route('publikasi.detail', $a->slug) }}" target="_blank" class="p-2 text-slate-400 hover:text-emerald-700" title="Pratinjau">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <a href="{{ route('admin.articles.edit', $a->id) }}" class="p-2 text-slate-400 hover:text-amber-600" title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <form action="{{ route('admin.articles.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600" title="Hapus">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="p-8 text-center text-slate-400">Belum ada artikel yang ditambahkan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($articles->hasPages())
      <div class="p-4 border-t border-slate-100">
        {{ $articles->links() }}
      </div>
    @endif
  </div>

@endsection
