@extends('layouts.app')

@section('title', 'Tentang Pesantren - ' . ($settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum'))

@section('content')

  <!-- BREADCRUMB & HEADER -->
  <section class="bg-emerald-950 text-white py-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-islamic-pattern opacity-15"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
      <div class="flex items-center justify-center sm:justify-start gap-2 text-xs text-emerald-300 mb-2 font-medium">
        <a href="{{ route('home') }}" class="hover:text-amber-400">Beranda</a>
        <span>/</span>
        <span class="text-amber-400">Tentang Pesantren</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Profil, Sejarah & Dewan Masayikh</h1>
      <p class="text-slate-200 text-sm mt-2 max-w-2xl">
        Mengenal lebih dekat perjalanan panjang dakwah, keteladanan ulama, visi kebangsaan, dan dedikasi luhur {{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum Gunung Bubut' }}.
      </p>
    </div>
  </section>

  <!-- SUB-NAV JUMPLINKS -->
  <div class="sticky top-20 z-30 bg-white border-b border-slate-200 shadow-sm py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center sm:justify-start gap-3 text-xs sm:text-sm font-bold flex-wrap">
      <a href="#profil" class="px-4 py-2 rounded-full bg-emerald-100 text-emerald-900 hover:bg-emerald-200 transition-colors">
        <i class="fa-solid fa-mosque mr-1.5"></i> Profil Pesantren
      </a>
      <a href="#sejarah" class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 hover:bg-emerald-100 hover:text-emerald-900 transition-colors">
        <i class="fa-solid fa-landmark-dome mr-1.5"></i> Sejarah Perjuangan
      </a>
      <a href="#masayikh" class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 hover:bg-emerald-100 hover:text-emerald-900 transition-colors">
        <i class="fa-solid fa-user-tie mr-1.5"></i> Dewan Masayikh
      </a>
      <a href="#sebaran-wilayah" class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 hover:bg-emerald-100 hover:text-emerald-900 transition-colors">
        <i class="fa-solid fa-map-location-dot mr-1.5"></i> Asal Daerah Santri
      </a>
    </div>
  </div>

  <!-- BAGIAN 1: PROFIL & VISI MISI -->
  <section id="profil" class="py-16 bg-white scroll-mt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <div class="lg:col-span-6 space-y-6">
          <span class="text-xs font-extrabold tracking-widest text-emerald-700 uppercase bg-emerald-100 px-3 py-1 rounded-full">
            Identitas & Orientasi Pendidikan
          </span>
          <h2 class="text-3xl font-extrabold text-emerald-950 leading-tight">
            Meneguhkan Karakter Santri Salafiyah Berdaya Saing Global
          </h2>
          <div class="text-slate-600 text-sm leading-relaxed space-y-3">
            <p>
              <strong>{{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum Gunung Bubut' }}</strong> berlokasi di kawasan perbukitan yang hijau dan asri, {{ $settings['address'] ?? 'Kp. Gunungbubut, Desa Pakalongan, Kecamatan Sodonghilir, Kabupaten Tasikmalaya, Jawa Barat' }}.
            </p>
            <p>
              Dengan memadukan sistem pembelajaran pesantren salafiyah yang berfokus pada pendalaman <em>Kutubut Turats</em> (Kitab Kuning) serta sistem pendidikan formal berjenjang MTs dan SMK, Miftahul Ulum bertekad mencetak santri yang berjiwa ikhlas, mandiri, berwawasan luas, dan mampu memberi kontribusi nyata bagi umat.
            </p>
          </div>

          <div class="grid grid-cols-2 gap-4 pt-2">
            <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100">
              <div class="text-amber-600 text-xl font-bold mb-1"><i class="fa-solid fa-book-open-reader"></i></div>
              <h4 class="font-bold text-sm text-emerald-950">Tafaqquh Fiddin</h4>
              <p class="text-xs text-slate-600 mt-1">Metode Sorogan, Bandongan, dan Lalaran Nadzom berjenjang.</p>
            </div>
            <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100">
              <div class="text-amber-600 text-xl font-bold mb-1"><i class="fa-solid fa-microchip"></i></div>
              <h4 class="font-bold text-sm text-emerald-950">Melek Teknologi</h4>
              <p class="text-xs text-slate-600 mt-1">Penguasaan Rekayasa Software, Jaringan, dan Otomotif di SMK.</p>
            </div>
          </div>
        </div>

        <div class="lg:col-span-6">
          <div class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white p-8 rounded-3xl shadow-xl relative overflow-hidden space-y-6">
            <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
            <div class="relative z-10 space-y-6">
              
              <div>
                <span class="text-xs font-bold text-amber-400 uppercase tracking-widest">Pondasi Nilai</span>
                <h3 class="text-2xl font-extrabold text-white mt-1">Visi & Misi Pesantren</h3>
              </div>

              <!-- Visi -->
              <div class="p-5 bg-emerald-800/60 rounded-2xl border border-emerald-700">
                <div class="text-xs font-bold text-amber-300 uppercase tracking-wider mb-1">Visi Utama:</div>
                <p class="text-sm font-semibold text-white leading-relaxed">
                  "{{ $settings['visi'] ?? 'Terwujudnya Generasi Santri yang Berakhlakul Karimah, Unggul dalam Ilmu Agama, Cerdas dalam Sains & Teknologi, serta Berdaya Saing Mandiri untuk Kemaslahatan Umat.' }}"
                </p>
              </div>

              <!-- Misi -->
              <div class="space-y-3">
                <div class="text-xs font-bold text-amber-300 uppercase tracking-wider">Misi Pesantren:</div>
                <div class="text-xs text-emerald-100 leading-relaxed space-y-1">
                  {!! nl2br(e($settings['misi'] ?? "1. Menyelenggarakan pengajian kitab kuning secara istiqomah.\n2. Mendidik akhlak dan adab mulia.\n3. Mengembangkan pendidikan formal MTs & SMK.")) !!}
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- BAGIAN 2: SEJARAH PERJUANGAN -->
  <section id="sejarah" class="py-16 bg-slate-50 border-t border-slate-200/60 scroll-mt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
          Napak Tilas Dakwah
        </span>
        <h2 class="text-3xl font-extrabold text-emerald-950 mt-3">Sejarah Berdirinya Pondok Pesantren</h2>
        <div class="islamic-divider"><i class="fa-solid fa-hourglass-half text-amber-500"></i></div>
      </div>

      <div class="max-w-4xl mx-auto space-y-8 relative before:absolute before:inset-0 before:left-5 sm:before:left-1/2 before:w-0.5 before:bg-emerald-200">
        
        <div class="relative flex flex-col sm:flex-row items-center">
          <div class="flex items-center justify-start sm:justify-end w-full sm:w-1/2 sm:pr-8 pl-12 sm:pl-0">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm w-full sm:text-right">
              <span class="px-2.5 py-1 bg-amber-100 text-amber-800 rounded-md font-extrabold text-xs">Tahun 1985</span>
              <h4 class="font-bold text-base text-emerald-950 mt-2">Perintisan Pengajian & Kobong Bambu</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                Dimulai dari musholla panggung sederhana di Kp. Gunungbubut. Muassis almarhum K.H. Zaenal Abidin mengumpulkan anak-anak desa untuk diajarkan Al-Qur'an dan kitab dasar.
              </p>
            </div>
          </div>
          <div class="absolute left-3.5 sm:left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-amber-500 border-4 border-white shadow-md"></div>
          <div class="hidden sm:block w-1/2"></div>
        </div>

        <div class="relative flex flex-col sm:flex-row items-center">
          <div class="hidden sm:block w-1/2"></div>
          <div class="absolute left-3.5 sm:left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-emerald-600 border-4 border-white shadow-md"></div>
          <div class="flex items-center justify-start w-full sm:w-1/2 sm:pl-8 pl-12">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm w-full">
              <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 rounded-md font-extrabold text-xs">Tahun 1998</span>
              <h4 class="font-bold text-base text-emerald-950 mt-2">Pendirian MTs Miftahul Ulum</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                Menjawab kebutuhan santri akan ijazah formal tingkat pertama, didirikanlah MTs Miftahul Ulum di bawah naungan Kementerian Agama dengan nomor NPSN 20278561.
              </p>
            </div>
          </div>
        </div>

        <div class="relative flex flex-col sm:flex-row items-center">
          <div class="flex items-center justify-start sm:justify-end w-full sm:w-1/2 sm:pr-8 pl-12 sm:pl-0">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm w-full sm:text-right">
              <span class="px-2.5 py-1 bg-blue-100 text-blue-800 rounded-md font-extrabold text-xs">Tahun 2011</span>
              <h4 class="font-bold text-base text-emerald-950 mt-2">Lahirnya SMK Kejuruan Vokasi</h4>
              <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                Memperluas kemandirian santri dengan mendirikan SMK Miftahul Ulum bidang Teknik Komputer & Jaringan, Rekayasa Perangkat Lunak, dan Otomotif Sepeda Motor.
              </p>
            </div>
          </div>
          <div class="absolute left-3.5 sm:left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-blue-600 border-4 border-white shadow-md"></div>
          <div class="hidden sm:block w-1/2"></div>
        </div>

      </div>

    </div>
  </section>

  <!-- BAGIAN 3: DEWAN MASAYIKH -->
  <section id="masayikh" class="py-16 bg-white border-t border-slate-200/60 scroll-mt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="text-xs font-extrabold tracking-widest text-emerald-700 uppercase bg-emerald-100 px-3 py-1 rounded-full">
          Masyayikh & Pimpinan
        </span>
        <h2 class="text-3xl font-extrabold text-emerald-950 mt-3">Dewan Masayikh Pondok Pesantren</h2>
        <div class="islamic-divider"><i class="fa-solid fa-kaaba text-amber-500"></i></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($masayikhs as $m)
          <div class="bg-white rounded-3xl p-6 border border-slate-200/80 hover-card-elevate flex flex-col justify-between text-center space-y-4">
            <div>
              <div class="w-32 h-32 mx-auto rounded-full p-1.5 bg-gradient-to-tr from-amber-400 via-emerald-600 to-emerald-900 shadow-xl overflow-hidden mb-4">
                <img src="{{ $m->foto ? asset($m->foto) : 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $m->nama }}" class="w-full h-full object-cover rounded-full">
              </div>
              <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-[11px] font-extrabold uppercase">
                {{ $m->peran }}
              </span>
              <h3 class="font-extrabold text-base text-emerald-950 mt-3">{{ $m->nama }}</h3>
              <p class="text-xs font-semibold text-amber-600 mt-0.5">{{ $m->gelar }}</p>
            </div>
            <div class="pt-3 border-t border-slate-100">
              <p class="text-xs text-slate-600 leading-relaxed">{{ $m->deskripsi }}</p>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- BAGIAN 4: STATISTIK ASAL DAERAH SANTRI (WEB DINAMIS) -->
  <section id="sebaran-wilayah" class="py-16 bg-slate-50 border-t border-slate-200/80 scroll-mt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-12">
        <span class="text-xs font-extrabold tracking-widest text-emerald-800 uppercase bg-emerald-100 px-3.5 py-1 rounded-full">
          Demografi & Sebaran Wilayah
        </span>
        <h2 class="text-3xl font-extrabold text-emerald-950 mt-3">Statistik Asal Daerah Santri</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-2">
          Pondok Pesantren Miftahul Ulum Gunung Bubut dipercaya oleh ribuan wali santri dari berbagai pelosok desa, kecamatan, dan kabupaten/kota di Indonesia.
        </p>
        <div class="islamic-divider"><i class="fa-solid fa-map-location-dot text-amber-500"></i></div>
      </div>

      <!-- Ringkasan Wilayah -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 max-w-4xl mx-auto mb-10">
        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs flex items-center gap-4 text-left">
          <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-city"></i>
          </div>
          <div>
            <div class="text-2xl font-black text-slate-900">{{ $statistikWilayah['total_kabupaten'] ?? 0 }}</div>
            <div class="text-xs font-bold text-slate-600">Kabupaten / Kota</div>
            <div class="text-[10px] text-emerald-700">Jawa Barat & sekitarnya</div>
          </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs flex items-center gap-4 text-left">
          <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-signs-post"></i>
          </div>
          <div>
            <div class="text-2xl font-black text-slate-900">{{ $statistikWilayah['total_kecamatan'] ?? 0 }}</div>
            <div class="text-xs font-bold text-slate-600">Kecamatan Asal</div>
            <div class="text-[10px] text-blue-700">Wilayah Priangan & Nusantara</div>
          </div>
        </div>

        <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs flex items-center gap-4 text-left">
          <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl shrink-0">
            <i class="fa-solid fa-tree-city"></i>
          </div>
          <div>
            <div class="text-2xl font-black text-slate-900">{{ $statistikWilayah['total_desa'] ?? 0 }}</div>
            <div class="text-xs font-bold text-slate-600">Desa / Kelurahan</div>
            <div class="text-[10px] text-amber-700">Sebaran domisili mukim</div>
          </div>
        </div>
      </div>

      <!-- Tab Sebaran Publik -->
      <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden max-w-5xl mx-auto">
        <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-center gap-2 bg-slate-50/50">
          <button type="button" onclick="pilihWilayahPublik('kabupaten')" id="btnPublikKabupaten" class="px-4 py-2 text-xs font-bold rounded-xl bg-emerald-800 text-white shadow-xs transition-all flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-city"></i> Kabupaten / Kota
          </button>
          <button type="button" onclick="pilihWilayahPublik('kecamatan')" id="btnPublikKecamatan" class="px-4 py-2 text-xs font-bold rounded-xl bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 transition-all flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-signs-post"></i> Tingkat Kecamatan
          </button>
          <button type="button" onclick="pilihWilayahPublik('desa')" id="btnPublikDesa" class="px-4 py-2 text-xs font-bold rounded-xl bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 transition-all flex items-center gap-1.5 cursor-pointer">
            <i class="fa-solid fa-tree-city"></i> Tingkat Desa
          </button>
        </div>

        <div class="p-6 sm:p-8">
          <!-- Konten Kabupaten -->
          <div id="contentPublikKabupaten" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($statistikWilayah['kabupaten'] as $idx => $item)
              <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-2">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-lg bg-emerald-700 text-white font-black text-xs flex items-center justify-center">
                      {{ $idx + 1 }}
                    </span>
                    <span class="font-extrabold text-sm text-slate-900">{{ $item->nama_wilayah }}</span>
                  </div>
                  <div class="text-right">
                    <span class="font-bold text-xs text-emerald-900">{{ $item->total }} Santri</span>
                    <span class="text-[10px] text-slate-400 font-mono ml-1">({{ $item->persentase }}%)</span>
                  </div>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                  <div class="bg-gradient-to-r from-emerald-600 to-teal-500 h-2 rounded-full" style="width: {{ $item->persentase }}%"></div>
                </div>
              </div>
            @empty
              <div class="col-span-2 text-center text-xs text-slate-400 py-6">Belum ada data wilayah.</div>
            @endforelse
          </div>

          <!-- Konten Kecamatan -->
          <div id="contentPublikKecamatan" class="grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
            @forelse($statistikWilayah['kecamatan'] as $idx => $item)
              <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-2">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-lg bg-blue-700 text-white font-black text-xs flex items-center justify-center">
                      {{ $idx + 1 }}
                    </span>
                    <div>
                      <div class="font-extrabold text-sm text-slate-900">Kec. {{ $item->nama_wilayah }}</div>
                      <div class="text-[10px] text-slate-400">{{ $item->nama_kabupaten }}</div>
                    </div>
                  </div>
                  <div class="text-right">
                    <span class="font-bold text-xs text-blue-900">{{ $item->total }} Santri</span>
                    <span class="text-[10px] text-slate-400 font-mono ml-1">({{ $item->persentase }}%)</span>
                  </div>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                  <div class="bg-gradient-to-r from-blue-600 to-indigo-500 h-2 rounded-full" style="width: {{ $item->persentase }}%"></div>
                </div>
              </div>
            @empty
              <div class="col-span-2 text-center text-xs text-slate-400 py-6">Belum ada data wilayah kecamatan.</div>
            @endforelse
          </div>

          <!-- Konten Desa -->
          <div id="contentPublikDesa" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 hidden">
            @forelse($statistikWilayah['desa'] as $idx => $item)
              <div class="p-3.5 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-2">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <span class="w-5 h-5 rounded-md bg-amber-700 text-white font-black text-[10px] flex items-center justify-center">
                      {{ $idx + 1 }}
                    </span>
                    <div>
                      <div class="font-extrabold text-xs text-slate-900">Desa {{ $item->nama_wilayah }}</div>
                      <div class="text-[10px] text-slate-400">Kec. {{ $item->nama_kecamatan }}</div>
                    </div>
                  </div>
                  <div class="text-right">
                    <span class="font-bold text-xs text-amber-900">{{ $item->total }}</span>
                    <span class="text-[9px] text-slate-400 font-mono block">({{ $item->persentase }}%)</span>
                  </div>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-1.5 overflow-hidden">
                  <div class="bg-gradient-to-r from-amber-600 to-orange-500 h-1.5 rounded-full" style="width: {{ $item->persentase }}%"></div>
                </div>
              </div>
            @empty
              <div class="col-span-3 text-center text-xs text-slate-400 py-6">Belum ada data wilayah desa.</div>
            @endforelse
          </div>
        </div>
      </div>

    </div>
  </section>

  <script>
    function pilihWilayahPublik(tab) {
      const tabs = ['kabupaten', 'kecamatan', 'desa'];
      tabs.forEach(t => {
        const btn = document.getElementById('btnPublik' + t.charAt(0).toUpperCase() + t.slice(1));
        const content = document.getElementById('contentPublik' + t.charAt(0).toUpperCase() + t.slice(1));
        if (t === tab) {
          btn.className = 'px-4 py-2 text-xs font-bold rounded-xl bg-emerald-800 text-white shadow-xs transition-all flex items-center gap-1.5 cursor-pointer';
          content.classList.remove('hidden');
        } else {
          btn.className = 'px-4 py-2 text-xs font-bold rounded-xl bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 transition-all flex items-center gap-1.5 cursor-pointer';
          content.classList.add('hidden');
        }
      });
    }
  </script>

@endsection
