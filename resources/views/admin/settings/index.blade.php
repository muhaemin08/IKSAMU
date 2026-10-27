@extends('layouts.admin')

@section('title', 'Setting Dasar Aplikasi')
@section('header_title', 'Setting Dasar & Identitas Aplikasi')

@section('content')

  <div class="max-w-5xl mx-auto">
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
      @csrf

      <!-- Tab Navigation Buttons -->
      <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-3" id="settingsTabNav">
        <button type="button" onclick="switchTab('identitas')" class="setting-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-emerald-800 text-white" data-target="identitas">
          <i class="fa-solid fa-mosque mr-1.5"></i> Identitas & Logo
        </button>
        <button type="button" onclick="switchTab('kontak')" class="setting-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-slate-200 text-slate-700 hover:bg-slate-300" data-target="kontak">
          <i class="fa-solid fa-address-book mr-1.5"></i> Kontak & Peta
        </button>
        <button type="button" onclick="switchTab('hero')" class="setting-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-slate-200 text-slate-700 hover:bg-slate-300" data-target="hero">
          <i class="fa-solid fa-image mr-1.5"></i> Hero & Sambutan
        </button>
        <button type="button" onclick="switchTab('visimisi')" class="setting-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-slate-200 text-slate-700 hover:bg-slate-300" data-target="visimisi">
          <i class="fa-solid fa-bullseye mr-1.5"></i> Visi & Misi
        </button>
        <button type="button" onclick="switchTab('medsos')" class="setting-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-slate-200 text-slate-700 hover:bg-slate-300" data-target="medsos">
          <i class="fa-brands fa-instagram mr-1.5"></i> Media Sosial
        </button>
      </div>

      <!-- TAB 1: IDENTITAS -->
      <div id="tab-identitas" class="setting-tab-pane bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-6">
        <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">Identitas Lembaga Pesantren</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Utama Pesantren</label>
            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 font-bold">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Sub-Nama / Wilayah</label>
            <input type="text" name="site_subname" value="{{ $settings['site_subname'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Slogan / Motto Pesantren</label>
          <input type="text" name="site_motto" value="{{ $settings['site_motto'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Teks Kaligrafi Pembuka (Bismillah Banner)</label>
          <input type="text" name="bismillah_text" value="{{ $settings['bismillah_text'] ?? '' }}" class="w-full px-4 py-2.5 text-sm font-arabic rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Logo Resmi Pesantren</label>
          <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl border p-1 bg-slate-50 flex items-center justify-center overflow-hidden shrink-0">
              <img src="{{ asset($settings['logo_url'] ?? 'assets/images/logo-pesantren.jpg') }}" alt="Logo" class="max-h-full max-w-full object-contain">
            </div>
            <div class="flex-1">
              <input type="file" name="logo_file" accept="image/*" class="w-full px-4 py-2 text-xs rounded-xl border border-slate-300 bg-slate-50">
              <p class="text-[11px] text-slate-400 mt-1">Pilih gambar JPG/PNG baru untuk mengganti logo.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- TAB 2: KONTAK & LOKASI -->
      <div id="tab-kontak" class="setting-tab-pane bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-6 hidden">
        <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">Informasi Kontak & Peta</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Telepon Kantor / Sekretariat</label>
            <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor WhatsApp Utama PSB (Format: 628xxxxxxxxxx)</label>
            <input type="text" name="whatsapp_psb" value="{{ $settings['whatsapp_psb'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Email Resmi</label>
          <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Lengkap Pesantren</label>
          <textarea name="address" rows="3" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">{{ $settings['address'] ?? '' }}</textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">URL Google Maps Embed (Iframe Src)</label>
          <input type="text" name="maps_embed" value="{{ $settings['maps_embed'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">
          <p class="text-[11px] text-slate-400 mt-1">Salin atribut src dari menu "Sematkan peta" di Google Maps.</p>
        </div>
      </div>

      <!-- TAB 3: HERO & SAMBUTAN -->
      <div id="tab-hero" class="setting-tab-pane bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-6 hidden">
        <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">Banner Hero Depan & Sambutan Pimpinan</h3>

        <!-- FOTO SLIDER HERO BERANDA (SLIDE BERGANTIAN: PESANTREN, MTS, SMK) -->
        <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200/80 space-y-5">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200 pb-3">
            <div>
              <h4 class="font-extrabold text-sm text-emerald-950 flex items-center gap-2">
                <i class="fa-solid fa-images text-emerald-600"></i>
                <span>Foto Slide Hero Beranda (Slide Bergantian)</span>
              </h4>
              <p class="text-xs text-slate-500 mt-0.5">
                Foto-foto di bawah ini ditampilkan secara otomatis bergantian (slide show) pada kartu depan dan latar belakang beranda.
              </p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
              <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i> Auto Convert WebP
            </span>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            
            <!-- Slide 1: Gambar Pesantren -->
            <div class="bg-white p-4 rounded-2xl border border-emerald-200 shadow-xs flex flex-col justify-between space-y-3">
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800 uppercase">Slide 1</span>
                  <span class="text-[11px] font-extrabold text-slate-700">Kompleks Pesantren</span>
                </div>
                <div class="w-full aspect-[4/3] rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-900 relative group mb-3">
                  <img src="{{ str_starts_with($settings['hero_image'] ?? '', 'http') ? $settings['hero_image'] : asset($settings['hero_image'] ?? 'assets/images/gedung-pesantren.webp') }}" 
                       onerror="this.onerror=null; this.src='{{ asset('assets/images/gedung-pesantren.jpg') }}';"
                       alt="Preview Pesantren" class="w-full h-full object-cover">
                  <div class="absolute bottom-2 left-2 right-2 px-2 py-1 bg-emerald-950/80 backdrop-blur-xs rounded text-[10px] text-white font-semibold truncate">
                    Kompleks Gunung Bubut
                  </div>
                </div>
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Ganti Gambar Pesantren</label>
                <input type="file" name="hero_image_file" accept="image/*" class="w-full px-2.5 py-1.5 text-xs rounded-xl border border-slate-300 bg-slate-50 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-emerald-800 file:text-white">
              </div>
              <p class="text-[10px] text-slate-400">Menampilkan gedung asrama & kompleks pesantren.</p>
            </div>

            <!-- Slide 2: Gambar MTs -->
            <div class="bg-white p-4 rounded-2xl border border-emerald-200 shadow-xs flex flex-col justify-between space-y-3">
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800 uppercase">Slide 2</span>
                  <span class="text-[11px] font-extrabold text-slate-700">MTs Miftahul Ulum</span>
                </div>
                <div class="w-full aspect-[4/3] rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-900 relative group mb-3">
                  <img src="{{ str_starts_with($settings['hero_image_mts'] ?? '', 'http') ? $settings['hero_image_mts'] : asset($settings['hero_image_mts'] ?? 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=800&q=80') }}" 
                       alt="Preview MTs" class="w-full h-full object-cover">
                  <div class="absolute bottom-2 left-2 right-2 px-2 py-1 bg-emerald-950/80 backdrop-blur-xs rounded text-[10px] text-white font-semibold truncate">
                    Madrasah Tsanawiyah (Akreditasi A)
                  </div>
                </div>
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Ganti Gambar MTs</label>
                <input type="file" name="hero_image_mts_file" accept="image/*" class="w-full px-2.5 py-1.5 text-xs rounded-xl border border-slate-300 bg-slate-50 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-emerald-800 file:text-white">
              </div>
              <p class="text-[10px] text-slate-400">Menampilkan gedung / kegiatan santri MTs Miftahul Ulum.</p>
            </div>

            <!-- Slide 3: Gambar SMK -->
            <div class="bg-white p-4 rounded-2xl border border-emerald-200 shadow-xs flex flex-col justify-between space-y-3">
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-blue-100 text-blue-800 uppercase">Slide 3</span>
                  <span class="text-[11px] font-extrabold text-slate-700">SMK Miftahul Ulum</span>
                </div>
                <div class="w-full aspect-[4/3] rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-900 relative group mb-3">
                  <img src="{{ str_starts_with($settings['hero_image_smk'] ?? '', 'http') ? $settings['hero_image_smk'] : asset($settings['hero_image_smk'] ?? 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=800&q=80') }}" 
                       alt="Preview SMK" class="w-full h-full object-cover">
                  <div class="absolute bottom-2 left-2 right-2 px-2 py-1 bg-emerald-950/80 backdrop-blur-xs rounded text-[10px] text-white font-semibold truncate">
                    SMK Kejuruan Vokasi & IT
                  </div>
                </div>
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Ganti Gambar SMK</label>
                <input type="file" name="hero_image_smk_file" accept="image/*" class="w-full px-2.5 py-1.5 text-xs rounded-xl border border-slate-300 bg-slate-50 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-emerald-800 file:text-white">
              </div>
              <p class="text-[10px] text-slate-400">Menampilkan lab/gedung/pembelajaran SMK Miftahul Ulum.</p>
            </div>

          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Sub-Judul Hero Banner Depan</label>
          <textarea name="hero_subtitle" rows="3" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
          <div>
            <label class="block text-[11px] font-bold text-slate-700 mb-1">Statistik Santri</label>
            <input type="text" name="stat_santri" value="{{ $settings['stat_santri'] ?? '' }}" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 mb-1">Statistik Asatidz</label>
            <input type="text" name="stat_asatidz" value="{{ $settings['stat_asatidz'] ?? '' }}" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 mb-1">Statistik Alumni</label>
            <input type="text" name="stat_alumni" value="{{ $settings['stat_alumni'] ?? '' }}" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
          </div>
          <div>
            <label class="block text-[11px] font-bold text-slate-700 mb-1">Statistik Lembaga</label>
            <input type="text" name="stat_lembaga" value="{{ $settings['stat_lembaga'] ?? '' }}" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
          </div>
        </div>

        <div class="border-t border-slate-100 pt-4 space-y-4">
          <h4 class="font-bold text-sm text-slate-800">Sambutan Pimpinan Pondok Pesantren</h4>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Pimpinan</label>
              <input type="text" name="sambutan_nama" value="{{ $settings['sambutan_nama'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1.5">Jabatan</label>
              <input type="text" name="sambutan_jabatan" value="{{ $settings['sambutan_jabatan'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Foto Pimpinan Pesantren</label>
            <div class="flex items-center gap-4">
              <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-emerald-500 shadow shrink-0">
                <img src="{{ str_starts_with($settings['sambutan_foto'] ?? '', 'http') ? $settings['sambutan_foto'] : asset($settings['sambutan_foto'] ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80') }}" 
                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80';"
                     alt="Foto Pimpinan" class="w-full h-full object-cover">
              </div>
              <div class="flex-1">
                <input type="file" name="sambutan_foto_file" accept="image/*" class="w-full px-4 py-2 text-xs rounded-xl border border-slate-300 bg-slate-50">
                <p class="text-[11px] text-slate-400 mt-1">Upload foto pimpinan pesantren baru (JPG, PNG, WebP).</p>
              </div>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Teks Sambutan</label>
            <textarea name="sambutan_teks" rows="4" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">{{ $settings['sambutan_teks'] ?? '' }}</textarea>
          </div>
        </div>
      </div>

      <!-- TAB 4: VISI & MISI -->
      <div id="tab-visimisi" class="setting-tab-pane bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-6 hidden">
        <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">Visi & Misi Pesantren</h3>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Visi Pesantren</label>
          <textarea name="visi" rows="3" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">{{ $settings['visi'] ?? '' }}</textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1.5">Misi Pesantren (Tiap butir per baris)</label>
          <textarea name="misi" rows="6" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-mono">{{ $settings['misi'] ?? '' }}</textarea>
        </div>
      </div>

      <!-- TAB 5: MEDIA SOSIAL -->
      <div id="tab-medsos" class="setting-tab-pane bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 space-y-6 hidden">
        <h3 class="font-extrabold text-base text-slate-900 border-b border-slate-100 pb-3">Tautan Akun Media Sosial Resmi</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5"><i class="fa-brands fa-facebook-f text-blue-600 mr-1.5"></i> Facebook URL</label>
            <input type="url" name="facebook" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5"><i class="fa-brands fa-instagram text-pink-600 mr-1.5"></i> Instagram URL</label>
            <input type="url" name="instagram" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5"><i class="fa-brands fa-youtube text-red-600 mr-1.5"></i> YouTube Channel URL</label>
            <input type="url" name="youtube" value="{{ $settings['youtube'] ?? '' }}" placeholder="https://youtube.com/..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5"><i class="fa-brands fa-tiktok text-slate-900 mr-1.5"></i> TikTok URL</label>
            <input type="url" name="tiktok" value="{{ $settings['tiktok'] ?? '' }}" placeholder="https://tiktok.com/@..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
          </div>
        </div>
      </div>

      <!-- Submit Floating / Bottom Bar -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-end gap-3 sticky bottom-4 z-20">
        <button type="submit" class="px-8 py-3 rounded-xl bg-emerald-800 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all flex items-center gap-2">
          <i class="fa-solid fa-floppy-disk"></i>
          <span>Simpan Seluruh Pengaturan</span>
        </button>
      </div>

    </form>

  </div>

@endsection

@push('scripts')
<script>
  function switchTab(target) {
    document.querySelectorAll('.setting-tab-pane').forEach(el => el.classList.add('hidden'));
    document.getElementById('tab-' + target)?.classList.remove('hidden');

    document.querySelectorAll('.setting-tab-btn').forEach(btn => {
      if (btn.getAttribute('data-target') === target) {
        btn.classList.add('bg-emerald-800', 'text-white');
        btn.classList.remove('bg-slate-200', 'text-slate-700');
      } else {
        btn.classList.remove('bg-emerald-800', 'text-white');
        btn.classList.add('bg-slate-200', 'text-slate-700');
      }
    });
  }
</script>
@endpush
