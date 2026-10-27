@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru')
@section('header_title', 'Tulis Artikel Baru')

@section('content')

  <div class="max-w-4xl mx-auto">
    
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
      
      <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm" class="space-y-6">
        @csrf

        <!-- Judul -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Artikel / Even / Kegiatan *</label>
          <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul menarik..." class="w-full px-4 py-3 text-sm font-bold rounded-2xl border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Kategori -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kategori *</label>
            <select name="category_id" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              @foreach($categories as $c)
                <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->nama }}</option>
              @endforeach
            </select>
          </div>

          <!-- Status -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Status Publikasi *</label>
            <select name="status" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Terbit Langsung)</option>
              <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Simpan Konsep)</option>
            </select>
          </div>

          <!-- Tanggal Publikasi -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Tanggal Terbit *</label>
            <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', date('Y-m-d')) }}" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Penulis -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Penulis / Humas</label>
            <input type="text" name="penulis" value="{{ old('penulis', auth()->user()->name) }}" placeholder="Nama penulis" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>

          <!-- Tag / Topik -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Tag / Topik Utama</label>
            <input type="text" name="tag" value="{{ old('tag') }}" placeholder="Contoh: Fiqih, Maulid, Lalaran" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <!-- Thumbnail Image -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Gambar Unggulan (Thumbnail)</label>
          <input type="file" name="thumbnail_file" accept="image/*" class="w-full px-4 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-slate-50">
          <p class="text-[11px] text-slate-400 mt-1">Format: JPG, PNG, atau WEBP. Maksimal 2MB.</p>
        </div>

        <!-- Ringkasan Singkat -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Ringkasan Singkat (Lead / Cuplikan)</label>
          <textarea name="ringkasan" rows="2" placeholder="Tuliskan 1-2 kalimat ringkasan artikel untuk cuplikan depan..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">{{ old('ringkasan') }}</textarea>
        </div>

        <!-- Visual WYSIWYG Rich Text Editor -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Isi Konten Artikel *</label>
          <input type="hidden" name="konten" id="kontenInput" value="{{ old('konten') }}">
          <div id="quillEditor" class="bg-white rounded-b-2xl min-h-[300px] border border-slate-300 text-sm">
            {!! old('konten') !!}
          </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
          <a href="{{ route('admin.articles.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-600 hover:bg-slate-50">
            Batal
          </a>
          <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-700 text-xs font-bold text-white shadow-md">
            <i class="fa-solid fa-cloud-arrow-up mr-1.5"></i> Simpan & Terbitkan
          </button>
        </div>

      </form>

    </div>

  </div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const quill = new Quill('#quillEditor', {
      theme: 'snow',
      modules: {
        toolbar: [
          [{ 'header': [1, 2, 3, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          [{ 'list': 'ordered'}, { 'list': 'bullet' }],
          ['blockquote', 'code-block'],
          [{ 'color': [] }, { 'background': [] }],
          ['link', 'image', 'clean']
        ]
      }
    });

    const form = document.getElementById('articleForm');
    const kontenInput = document.getElementById('kontenInput');

    form.addEventListener('submit', () => {
      kontenInput.value = quill.root.innerHTML;
    });
  });
</script>
@endpush
