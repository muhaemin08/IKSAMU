@extends('layouts.app')

@section('title', 'Kontak & Lokasi - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-emerald-950 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-15"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <span class="text-amber-400">Kontak & Lokasi</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Hubungi Kami & Peta Lokasi</h1>
      <p class="text-slate-200 text-sm mt-2 max-w-2xl">
        Informasi narahubung resmi, alamat sekretariat, peta navigasi Google Maps, dan pesan kilat untuk {{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum Gunung Bubut' }}.
      </p>
    </div>
  </section>

  <!-- KONTAK DETAIL -->
  <section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      @if(session('success'))
        <div class="mb-8 p-4 rounded-2xl bg-emerald-100 text-emerald-800 border border-emerald-200 flex items-center gap-3">
          <i class="fa-solid fa-circle-check text-xl text-emerald-600"></i>
          <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
      @endif

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Info Kontak -->
        <div class="lg:col-span-5 space-y-6">
          <span class="px-3 py-1 bg-emerald-100 text-emerald-800 font-extrabold text-xs rounded-full uppercase">
            Sekretariat & Humas
          </span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-emerald-950">
            Silaturahmi & Kunjungan ke Pesantren
          </h2>
          <p class="text-slate-600 text-sm leading-relaxed">
            Kami dengan senang hati menyambut kunjungan silaturahmi para calon wali santri, alumni, dan kaum muslimin.
          </p>

          <div class="space-y-4 pt-2">
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3.5">
              <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-location-dot text-lg"></i>
              </div>
              <div class="text-xs">
                <div class="font-extrabold text-slate-900 text-sm mb-1">Alamat Kompleks Pesantren</div>
                <p class="text-slate-600 leading-relaxed">{{ $settings['address'] ?? 'Jl. KHZ Abidin, Kp. Gunungbubut, Sodonghilir, Tasikmalaya' }}</p>
              </div>
            </div>

            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3.5">
              <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-phone text-lg"></i>
              </div>
              <div class="text-xs">
                <div class="font-extrabold text-slate-900 text-sm mb-1">Telepon & WhatsApp</div>
                <p class="text-slate-600">{{ $settings['phone'] ?? '+62 821-2345-6789' }} (Sekretariat)</p>
                <p class="text-slate-600">+{{ $settings['whatsapp_psb'] ?? '6282123456789' }} (Panitia PSB)</p>
              </div>
            </div>

            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3.5">
              <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-envelope text-lg"></i>
              </div>
              <div class="text-xs">
                <div class="font-extrabold text-slate-900 text-sm mb-1">Email Resmi</div>
                <p class="text-slate-600">{{ $settings['email'] ?? 'info@miftahululumgunungbubut.sch.id' }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Form Pesan -->
        <div class="lg:col-span-7 bg-slate-50 p-6 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
          <div>
            <h3 class="text-xl font-extrabold text-emerald-950">Kirim Pesan atau Pertanyaan</h3>
            <p class="text-xs text-slate-500 mt-1">Tuliskan pesan Anda kepada pengurus pondok pesantren:</p>
          </div>

          <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap *</label>
                <input type="text" name="nama" required placeholder="Bapak / Ibu" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp / HP *</label>
                <input type="tel" name="telepon" required placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white">
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Isi Pesan *</label>
              <textarea name="pesan" rows="4" required placeholder="Tuliskan pesan atau pertanyaan Anda di sini..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 bg-white"></textarea>
            </div>

            <button type="submit" class="px-6 py-3 rounded-xl font-bold text-xs text-white bg-emerald-800 hover:bg-emerald-700 shadow-md transition-all flex items-center gap-2">
              <i class="fa-solid fa-paper-plane"></i>
              <span>Kirim Pesan</span>
            </button>
          </form>
        </div>

      </div>

    </div>
  </section>

  <!-- PETA LOKASI -->
  @if(!empty($settings['maps_embed']))
  <section class="py-14 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-2xl mx-auto mb-8">
        <h3 class="text-xl sm:text-2xl font-extrabold text-emerald-950">Peta Lokasi Pesantren</h3>
        <p class="text-xs text-slate-500 mt-1">{{ $settings['address'] ?? 'Kp. Gunungbubut, Desa Pakalongan, Sodonghilir, Tasikmalaya' }}</p>
      </div>

      <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-xl h-96 relative">
        <iframe 
          title="Peta Lokasi"
          src="{{ $settings['maps_embed'] }}" 
          width="100%" 
          height="100%" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy">
        </iframe>
      </div>
    </div>
  </section>
  @endif

@endsection
