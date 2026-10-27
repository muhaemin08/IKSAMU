<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Petugas & Asatidz - {{ $settings['site_name'] ?? 'Pondok Pesantren Miftahul Ulum' }}</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/logo.svg') }}">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            emerald: { 850: '#064e3b', 950: '#022c22' },
            gold: { 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309' }
          },
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'sans-serif'],
            arabic: ['Amiri', 'serif']
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

  <div class="max-w-md w-full">
    
    <!-- Card Login -->
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200/80 overflow-hidden">
      
      <!-- Header Banner -->
      <div class="bg-emerald-950 p-8 text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-islamic-pattern opacity-10"></div>
        <div class="relative z-10 space-y-3">
          <div class="w-20 h-20 mx-auto rounded-full p-1 bg-gradient-to-tr from-amber-400 to-emerald-400 shadow-xl overflow-hidden bg-white">
            <img src="{{ asset($settings['logo_url'] ?? 'assets/images/logo-pesantren.jpg') }}" onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.svg') }}';" alt="Logo" class="w-full h-full object-contain rounded-full">
          </div>
          <div>
            <h2 class="text-lg font-extrabold text-white uppercase tracking-wide">
              {{ $settings['site_name'] ?? 'Miftahul Ulum' }}
            </h2>
            <p class="text-xs font-semibold text-amber-400 tracking-wider">
              PANEL PENGELOLAAN APLIKASI
            </p>
          </div>
          <div class="font-arabic text-amber-300 text-sm">
            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
          </div>
        </div>
      </div>

      <!-- Form Body -->
      <div class="p-8 space-y-6">
        
        @if(session('success'))
          <div class="p-3 bg-emerald-100 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div class="p-3 bg-red-100 text-red-800 rounded-xl text-xs font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
          </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
          @csrf

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Username atau Email *</label>
            <div class="relative">
              <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
              <input type="text" name="login" value="{{ old('login', old('email')) }}" required placeholder="Masukkan username atau email" class="w-full pl-9 pr-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi (Password) *</label>
            <div class="relative">
              <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
              <input type="password" name="password" required placeholder="••••••••" class="w-full pl-9 pr-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
            </div>
          </div>

          <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
              <input type="checkbox" name="remember" class="rounded text-emerald-700 focus:ring-emerald-600">
              <span>Ingat Saya</span>
            </label>
            <span class="text-slate-400">Versi 1.0</span>
          </div>

          <button type="submit" class="w-full py-3 px-4 rounded-xl font-bold text-sm text-white bg-emerald-800 hover:bg-emerald-700 shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
            <i class="fa-solid fa-arrow-right-to-bracket"></i>
            <span>Masuk ke Dashboard</span>
          </button>
        </form>

        <!-- Akun Demo Bawaan -->
        <div class="pt-4 border-t border-slate-100 text-xs space-y-1 text-slate-500 bg-slate-50 p-3 rounded-xl border">
          <div class="font-bold text-slate-700 mb-1"><i class="fa-solid fa-key text-amber-500 mr-1"></i> Akun Bawaan (Default):</div>
          <div>• <strong>Super Admin:</strong> Username: <code>admin</code> (password: <code>password</code>)</div>
          <div>• <strong>Penulis / Humas:</strong> Username: <code>penulis</code> (password: <code>password</code>)</div>
        </div>

      </div>

      <!-- Footer Card -->
      <div class="px-8 py-4 bg-slate-50 border-t border-slate-200 text-center text-xs text-slate-500">
        <a href="{{ route('home') }}" class="text-emerald-700 font-bold hover:underline inline-flex items-center gap-1">
          <i class="fa-solid fa-arrow-left text-[10px]"></i>
          <span>Kembali ke Halaman Utama Website</span>
        </a>
      </div>

    </div>

  </div>

</body>
</html>
