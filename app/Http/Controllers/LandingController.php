<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Asrama;
use App\Models\Category;
use App\Models\CeritaAlumni;
use App\Models\Fasilitas;
use App\Models\JadwalHarian;
use App\Models\Masayikh;
use App\Models\PendidikanFormal;
use App\Models\Prestasi;
use App\Models\PsbBiaya;
use App\Models\PsbRegistration;
use App\Models\Santri;
use App\Models\Setting;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Helper to load all settings grouped or as key-value
     */
    protected function getSettings()
    {
        return Setting::pluck('value', 'key')->all();
    }

    /**
     * Beranda (Home Landing Page)
     */
    public function index()
    {
        $settings = $this->getSettings();
        $masayikhs = Masayikh::orderBy('urutan')->take(4)->get();
        $articles = Article::with('category')->where('status', 'published')->latest('tanggal_publikasi')->take(3)->get();
        $asramaPutras = Asrama::where('tipe', 'putra')->get();
        $asramaPutris = Asrama::where('tipe', 'putri')->get();
        $asramaPutra = $asramaPutras->first();
        $asramaPutri = $asramaPutris->first();
        $mts = PendidikanFormal::where('kode', 'mts')->first();
        $smk = PendidikanFormal::where('kode', 'smk')->first();
        $fasilitas = Fasilitas::where('is_active', true)->orderBy('urutan')->get();
        $prestasi = Prestasi::where('is_active', true)->orderBy('urutan')->get();

        return view('landing.index', compact(
            'settings',
            'masayikhs',
            'articles',
            'asramaPutras',
            'asramaPutris',
            'asramaPutra',
            'asramaPutri',
            'mts',
            'smk',
            'fasilitas',
            'prestasi'
        ));
    }

    /**
     * Tentang (Profil, Sejarah, Dewan Masayikh & Demografi Wilayah Santri)
     */
    public function profil()
    {
        $settings = $this->getSettings();
        $masayikhs = Masayikh::orderBy('urutan')->get();
        $fasilitas = Fasilitas::where('is_active', true)->orderBy('urutan')->get();
        $prestasi = Prestasi::where('is_active', true)->orderBy('urutan')->get();
        $statistikWilayah = Santri::getStatistikWilayah();

        return view('landing.profil', compact('settings', 'masayikhs', 'fasilitas', 'prestasi', 'statistikWilayah'));
    }

    /**
     * Asrama (Asrama Putra, Asrama Putri, Jadwal Harian)
     */
    public function asrama()
    {
        $settings = $this->getSettings();
        $asramaPutras = Asrama::where('tipe', 'putra')->get();
        $asramaPutris = Asrama::where('tipe', 'putri')->get();
        $asramaPutra = $asramaPutras->first();
        $asramaPutri = $asramaPutris->first();
        $jadwals = JadwalHarian::orderBy('urutan')->get();

        return view('landing.asrama', compact('settings', 'asramaPutras', 'asramaPutris', 'asramaPutra', 'asramaPutri', 'jadwals'));
    }

    /**
     * Pendidikan Formal (Overview)
     */
    public function pendidikan()
    {
        $settings = $this->getSettings();
        $mts = PendidikanFormal::with(['articles' => function($q) {
            $q->with('category')->where('status', 'published')->latest('tanggal_publikasi')->take(3);
        }])->where('kode', 'mts')->first();

        $smk = PendidikanFormal::with(['articles' => function($q) {
            $q->with('category')->where('status', 'published')->latest('tanggal_publikasi')->take(3);
        }])->where('kode', 'smk')->first();

        return view('landing.pendidikan', compact('settings', 'mts', 'smk'));
    }

    /**
     * Halaman Khusus Terpisah: MTs. Miftahul Ulum
     */
    public function pendidikanMts()
    {
        $settings = $this->getSettings();
        $mts = PendidikanFormal::with(['articles' => function($q) {
            $q->with('category')->where('status', 'published')->latest('tanggal_publikasi')->paginate(6);
        }])->where('kode', 'mts')->firstOrFail();

        $smk = PendidikanFormal::where('kode', 'smk')->first();

        return view('landing.pendidikan_mts', compact('settings', 'mts', 'smk'));
    }

    /**
     * Halaman Khusus Terpisah: SMK YAPIM KABUPATEN TASIKMALAYA
     */
    public function pendidikanSmk()
    {
        $settings = $this->getSettings();
        $smk = PendidikanFormal::with(['articles' => function($q) {
            $q->with('category')->where('status', 'published')->latest('tanggal_publikasi')->paginate(6);
        }])->where('kode', 'smk')->firstOrFail();

        $mts = PendidikanFormal::where('kode', 'mts')->first();

        return view('landing.pendidikan_smk', compact('settings', 'smk', 'mts'));
    }

    /**
     * Publikasi (Artikel, Even, Kegiatan Santri)
     */
    public function publikasi(Request $request)
    {
        $settings = $this->getSettings();
        $categories = Category::all();
        $activeCategory = $request->query('kategori');
        $search = $request->query('cari');

        $query = Article::with('category')->where('status', 'published');

        if ($activeCategory) {
            $query->whereHas('category', function ($q) use ($activeCategory) {
                $q->where('slug', $activeCategory)->orWhere('nama', $activeCategory);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest('tanggal_publikasi')->paginate(9)->withQueryString();

        return view('landing.publikasi', compact('settings', 'categories', 'articles', 'activeCategory', 'search'));
    }

    /**
     * Detail Baca Artikel
     */
    public function publikasiDetail($slug)
    {
        $settings = $this->getSettings();
        $article = Article::with(['category', 'user'])->where('slug', $slug)->firstOrFail();
        $article->increment('views');

        $related = Article::where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('landing.publikasi-detail', compact('settings', 'article', 'related'));
    }

    /**
     * Pendaftaran Santri Baru (PSB)
     */
    public function psb()
    {
        $settings = $this->getSettings();
        $biayas = PsbBiaya::where('is_active', true)->orderBy('urutan')->get();
        $totalMts = $biayas->sum('nominal_mts');
        $totalSmk = $biayas->sum('nominal_smk');

        return view('landing.psb', compact('settings', 'biayas', 'totalMts', 'totalSmk'));
    }

    /**
     * Simpan Pendaftaran Santri Baru (Format Lengkap ala Assalaam)
     */
    public function psbStore(Request $request)
    {
        $validated = $request->validate([
            // A. Pilihan Lembaga & Jalur
            'pilihan_pendidikan' => 'required|string|max:50',
            'jalur_pendaftaran' => 'required|string|max:50',
            'pilihan_asrama' => 'required|string|max:50',

            // B. Data Calon Santri
            'nama_santri' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'nisn' => 'nullable|string|max:30',
            'nik' => 'nullable|string|max:30',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'anak_ke' => 'nullable|integer',
            'jumlah_saudara' => 'nullable|integer',
            'asal_sekolah' => 'nullable|string|max:255',
            'alamat_asal' => 'required|string',

            // C. Data Orang Tua / Wali
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'no_hp_ayah' => 'nullable|string|max:30',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_hp_ibu' => 'nullable|string|max:30',
            'nama_wali' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:30',
            'penghasilan_ortu' => 'nullable|string|max:100',

            // D. Pembiayaan
            'infaq_sukarela' => 'nullable|numeric|min:0',
            'total_biaya' => 'nullable|numeric|min:0',

            // E. Lain-lain
            'sumber_info' => 'nullable|string|max:255',
        ]);

        if (empty($validated['nama_wali'])) {
            $validated['nama_wali'] = $validated['nama_ayah'] ?? ($validated['nama_ibu'] ?? $validated['nama_santri']);
        }

        $reg = PsbRegistration::create($validated);

        $whatsappNumber = Setting::get('whatsapp_psb', '6282123456789');
        $nominalTotal = number_format($reg->total_biaya ?? 0, 0, ',', '.');
        $nominalInfaq = number_format($reg->infaq_sukarela ?? 0, 0, ',', '.');

        $pesanWa = "*PENDAFTARAN SANTRI BARU (PSB) ONLINE*\n"
            . "*Pondok Pesantren Miftahul Ulum Gunung Bubut*\n"
            . "──────────────────────────────\n"
            . "• *No. Registrasi:* #PSB-" . str_pad($reg->id, 4, '0', STR_PAD_LEFT) . "\n"
            . "• *Nama Santri:* {$reg->nama_santri}\n"
            . "• *Jenis Kelamin:* {$reg->jenis_kelamin}\n"
            . "• *NISN / NIK:* " . ($reg->nisn ?? '-') . " / " . ($reg->nik ?? '-') . "\n"
            . "• *Asal Sekolah:* " . ($reg->asal_sekolah ?? '-') . "\n"
            . "• *Lembaga Pilihan:* {$reg->pilihan_pendidikan}\n"
            . "• *Jalur Pendaftaran:* {$reg->jalur_pendaftaran}\n"
            . "• *Pilihan Asrama:* {$reg->pilihan_asrama}\n"
            . "──────────────────────────────\n"
            . "• *Orang Tua / Wali:* " . ($reg->nama_ayah ?? $reg->nama_wali) . "\n"
            . "• *No. WhatsApp Ortu:* {$reg->no_hp}\n"
            . "• *Alamat Asal:* {$reg->alamat_asal}\n"
            . "──────────────────────────────\n"
            . "• *Infaq / Wakaf Sukarela:* Rp {$nominalInfaq}\n"
            . "• *Estimasi Total Biaya:* Rp {$nominalTotal}\n"
            . "──────────────────────────────\n"
            . "Mohon konfirmasi dan verifikasi pendaftaran calon santri kami. Terima kasih.";

        $waUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($pesanWa);

        return redirect()->route('psb')->with([
            'success' => 'Alhamdulillah! Formulir pendaftaran calon santri baru berhasil disimpan di database sistem.',
            'pendaftaran' => $reg,
            'wa_url' => $waUrl,
        ]);
    }

    /**
     * Halaman Publik: Alumni (Ikatan Keluarga Santri & Alumni Miftahul Ulum - IKSAMU)
     */
    public function alumni()
    {
        $settings = $this->getSettings();
        $ceritas = CeritaAlumni::where('is_active', true)->orderBy('urutan')->latest()->get();
        $totalAlumni = Santri::where('status', 'Alumni')->count();
        $alumniPutra = Santri::where('status', 'Alumni')->where('jenis_kelamin', 'Laki-laki')->count();
        $alumniPutri = Santri::where('status', 'Alumni')->where('jenis_kelamin', 'Perempuan')->count();

        return view('landing.alumni', compact('settings', 'ceritas', 'totalAlumni', 'alumniPutra', 'alumniPutri'));
    }

    /**
     * Kontak & Lokasi
     */
    public function kontak()
    {
        $settings = $this->getSettings();
        return view('landing.kontak', compact('settings'));
    }

    /**
     * Kirim Pesan Kontak
     */
    public function kontakKirim(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:30',
            'pesan' => 'required|string',
        ]);

        return back()->with('success', 'Terima kasih, pesan Anda telah berhasil dikirimkan kepada pihak Pesantren.');
    }
}
