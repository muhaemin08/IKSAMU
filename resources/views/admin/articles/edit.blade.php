@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('header_title', 'Edit Artikel / Publikasi')

@section('content')

  <div class="max-w-4xl mx-auto">
    
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8">
      
      <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" id="articleForm" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Artikel / Even / Kegiatan *</label>
          <input type="text" name="judul" value="{{ old('judul', $article->judul) }}" required class="w-full px-4 py-3 text-sm font-bold rounded-2xl border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Kategori -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kategori *</label>
            <select name="category_id" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              @foreach($categories as $c)
                <option value="{{ $c->id }}" {{ old('category_id', $article->category_id) == $c->id ? 'selected' : '' }}>{{ $c->nama }}</option>
              @endforeach
            </select>
          </div>

          <!-- Status -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Status Publikasi *</label>
            <select name="status" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Published (Terbit)</option>
              <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
            </select>
          </div>

          <!-- Tanggal Publikasi -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Tanggal Terbit *</label>
            <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', optional($article->tanggal_publikasi)->format('Y-m-d')) }}" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Penulis -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Penulis / Humas</label>
            <input type="text" name="penulis" value="{{ old('penulis', $article->penulis) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>

          <!-- Tag / Topik -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Tag / Topik Utama</label>
            <input type="text" name="tag" value="{{ old('tag', $article->tag) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <!-- Thumbnail Image -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Gambar Unggulan (Thumbnail)</label>
          @if($article->thumbnail)
            <div class="mb-2 w-32 h-20 rounded-xl overflow-hidden border">
              <img src="{{ asset($article->thumbnail) }}" alt="" class="w-full h-full object-cover">
            </div>
          @endif
          <input type="file" name="thumbnail_file" accept="image/*" class="w-full px-4 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-slate-50">
          <p class="text-[11px] text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
        </div>

        <!-- Ringkasan Singkat -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Ringkasan Singkat (Lead / Cuplikan)</label>
          <textarea name="ringkasan" rows="2" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">{{ old('ringkasan', $article->ringkasan) }}</textarea>
        </div>

        <!-- Visual WYSIWYG Editor -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Isi Konten Artikel *</label>
          <input type="hidden" name="konten" id="kontenInput" value="{{ old('konten', $article->konten) }}">
          <div id="quillEditor" class="bg-white rounded-b-2xl min-h-[300px] border border-slate-300 text-sm">
            {!! old('konten', $article->konten) !!}
          </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
          <a href="{{ route('admin.articles.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold text-slate-600 hover:bg-slate-50">
            Batal
          </a>
          <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-700 text-xs font-bold text-white shadow-md">
            <i class="fa-solid fa-floppy-disk mr-1.5"></i> Perbarui Artikel
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
