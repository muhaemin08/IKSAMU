@extends('layouts.app')

@section('title', 'Alumni & Kiprah Santri (IKSAMU) - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-gradient-to-r from-emerald-950 via-emerald-900 to-teal-950 text-white py-14 relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-15"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <span class="text-amber-400">Alumni Pesantren</span>
      </div>
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Ikatan Alumni Miftahul Ulum (IKSAMU)</h1>
          <p class="text-emerald-200 text-xs sm:text-sm mt-2 max-w-2xl leading-relaxed">
            Menyambung sanad keilmuan, mengokohkan ukhuwah islamiyah, dan mengabdi untuk kemaslahatan umat di berbagai pelosok nusantara dan dunia.
          </p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-800/80 border border-emerald-700/80 rounded-2xl text-xs text-amber-300 font-bold self-center sm:self-auto shadow-sm">
          <i class="fa-solid fa-graduation-cap text-base"></i>
          <span>Wadah Silaturahmi Lintas Angkatan</span>
        </div>
      </div>
    </div>
  </section>

  <!-- KISAH INSPIRATIF & CERITA ALUMNI -->
  <section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="text-xs font-extrabold tracking-widest text-emerald-800 uppercase bg-emerald-100 px-3.5 py-1 rounded-full">
          Kiprah & Rekam Jejak
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-emerald-950 mt-3">
          Cerita Inspiratif Santri & Alumni
        </h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-2">
          Kisah nyata para alumni Pondok Pesantren Miftahul Ulum Gunung Bubut yang berkiprah di bidang keilmuan agama, teknologi, pendidikan, sosial dakwah, dan wirausaha.
        </p>
        <div class="islamic-divider"><i class="fa-solid fa-quote-left text-amber-500"></i></div>
      </div>

      <!-- Grid Kartu Cerita Alumni -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($ceritas as $c)
          @php
            $photoUrl = $c->foto ? (str_starts_with($c->foto, 'http') ? $c->foto : asset($c->foto)) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80';
          @endphp
          <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
            
            <div class="p-6 sm:p-7 space-y-4">
              <!-- Profil Header -->
              <div class="flex items-center gap-4">
                <div class="relative shrink-0">
                  <img src="{{ $photoUrl }}" alt="{{ $c->nama }}" class="w-16 h-16 rounded-2xl object-cover border-2 border-emerald-600 shadow-sm group-hover:scale-105 transition-transform duration-300">
                  <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px] shadow-xs">
                    <i class="fa-solid fa-check"></i>
                  </div>
                </div>
                <div class="min-w-0 flex-1">
                  <span class="inline-block px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 font-extrabold text-[10px] uppercase tracking-wider mb-1">
                    {{ $c->tahun_lulus }}
                  </span>
                  <h3 class="font-extrabold text-base text-slate-900 truncate">{{ $c->nama }}</h3>
                  <p class="text-xs text-slate-500 truncate">{{ $c->jenjang ?? 'Alumni Pesantren' }}</p>
                </div>
              </div>

              <!-- Badge Profesi -->
              <div class="pt-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 text-emerald-800 font-bold text-xs border border-emerald-200/70">
                  <i class="fa-solid fa-briefcase text-[11px] text-emerald-600"></i>
                  <span class="truncate">{{ $c->profesi }}</span>
                </span>
              </div>

              <!-- Judul Cerita -->
              <h4 class="font-extrabold text-sm text-slate-900 group-hover:text-emerald-800 transition-colors line-clamp-2">
                "{{ $c->judul }}"
              </h4>

              <!-- Cuplikan Cerita -->
              <p class="text-xs text-slate-600 leading-relaxed line-clamp-4">
                {{ $c->isi_cerita }}
              </p>
            </div>

            <!-- Card Footer -->
            <div class="p-5 sm:px-7 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
              <span class="text-[11px] font-bold text-slate-400">Inspirasi Alumni</span>
              <button type="button" onclick="bukaModalBacaCerita({{ json_encode($c) }}, '{{ $photoUrl }}')" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-900 group/btn cursor-pointer">
                <span>Baca Selengkapnya</span>
                <i class="fa-solid fa-arrow-right text-[11px] transform group-hover/btn:translate-x-1 transition-transform"></i>
              </button>
            </div>

          </div>
        @empty
          <div class="col-span-3 py-16 text-center text-slate-400 bg-white rounded-3xl border border-slate-200">
            <i class="fa-solid fa-user-graduate text-4xl mb-3 text-slate-300 block"></i>
            <p class="text-sm font-semibold">Belum ada cerita alumni yang dipublikasikan.</p>
          </div>
        @endforelse
      </div>

    </div>
  </section>

  <!-- CALL TO ACTION: SILATURAHMI ALUMNI -->
  <section class="py-14 bg-gradient-to-r from-emerald-900 to-teal-950 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-5">
      <span class="text-xs font-extrabold tracking-widest text-amber-300 uppercase bg-white/10 px-3.5 py-1 rounded-full">
        Silaturahmi Tanpa Batas
      </span>
      <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
        Apakah Anda Alumni Pondok Pesantren Miftahul Ulum?
      </h2>
      <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
        Mari pererat tali silaturahmi dengan almamater tercinta. Bagikan cerita perjuangan, kiprah karir, serta berkontribusi bagi kemajuan adik-adik santri mukim.
      </p>
      <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_psb'] ?? '6282123456789') }}?text=Assalamu%27alaikum,%20saya%20alumni%20Pondok%20Pesantren%20Miftahul%20Ulum%20Gunung%20Bubut%20ingin%20bersilaturahmi%20dan%20bergabung%20dengan%20IKSAMU" target="_blank" class="px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 font-bold text-xs sm:text-sm text-white shadow-lg flex items-center gap-2 transition-all">
          <i class="fa-brands fa-whatsapp text-lg"></i>
          <span>Hubungi Pengurus IKSAMU</span>
        </a>
        <a href="{{ route('kontak') }}" class="px-6 py-3 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 font-bold text-xs sm:text-sm text-white transition-all">
          Informasi & Sekretariat Pesantren
        </a>
      </div>
    </div>
  </section>

  <!-- MODAL BACA LENGKAP CERITA ALUMNI -->
  <div id="modalBacaCerita" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 max-w-2xl w-full p-6 sm:p-8 space-y-6 animate-fade-in max-h-[90vh] overflow-y-auto">
      <div class="flex justify-between items-start border-b border-slate-100 pb-4">
        <div class="flex items-center gap-4">
          <img id="modalFotoAlumni" src="" alt="Foto" class="w-16 h-16 rounded-2xl object-cover border-2 border-emerald-600 shadow-sm shrink-0">
          <div>
            <h3 id="modalNamaAlumni" class="text-base sm:text-lg font-extrabold text-slate-900">Nama Alumni</h3>
            <p id="modalProfesiAlumni" class="text-xs font-semibold text-emerald-800 mt-0.5">Profesi</p>
            <span id="modalTahunAlumni" class="inline-block px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-900 font-extrabold text-[10px] uppercase tracking-wider mt-1">
              Tahun Lulus
            </span>
          </div>
        </div>
        <button type="button" onclick="tutupModalBacaCerita()" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-xl hover:bg-slate-100 cursor-pointer">
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>
      </div>

      <div class="space-y-4">
        <h4 id="modalJudulCerita" class="text-base sm:text-lg font-extrabold text-emerald-950 leading-snug">
          Judul Kisah
        </h4>
        <div class="p-4 rounded-2xl bg-emerald-50/60 border border-emerald-100 flex items-center gap-3 text-xs text-emerald-900">
          <i class="fa-solid fa-graduation-cap text-base text-emerald-700"></i>
          <div>
            <span class="text-slate-400 block text-[10px] uppercase font-bold">Almamater:</span>
            <span id="modalJenjangAlumni" class="font-bold">Jenjang</span>
          </div>
        </div>
        <div id="modalIsiCerita" class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line space-y-3 font-normal">
          Isi cerita lengkap...
        </div>
      </div>

      <div class="pt-4 border-t border-slate-100 flex justify-end">
        <button type="button" onclick="tutupModalBacaCerita()" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-colors cursor-pointer">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <script>
    function bukaModalBacaCerita(item, photoUrl) {
      document.getElementById('modalNamaAlumni').innerText = item.nama;
      document.getElementById('modalProfesiAlumni').innerText = item.profesi;
      document.getElementById('modalTahunAlumni').innerText = item.tahun_lulus;
      document.getElementById('modalJenjangAlumni').innerText = item.jenjang || 'Pondok Pesantren Miftahul Ulum';
      document.getElementById('modalJudulCerita').innerText = '"' + item.judul + '"';
      document.getElementById('modalIsiCerita').innerText = item.isi_cerita;
      document.getElementById('modalFotoAlumni').src = photoUrl;

      document.getElementById('modalBacaCerita').classList.remove('hidden');
    }

    function tutupModalBacaCerita() {
      document.getElementById('modalBacaCerita').classList.add('hidden');
    }

    window.addEventListener('click', function(e) {
      const modal = document.getElementById('modalBacaCerita');
      if (e.target === modal) tutupModalBacaCerita();
    });

    window.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') tutupModalBacaCerita();
    });
  </script>

@endsection
