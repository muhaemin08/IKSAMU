<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\PendidikanFormal;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PendidikanFormalController extends Controller
{
    public function mts()
    {
        return $this->show('mts');
    }

    public function smk()
    {
        return $this->show('smk');
    }

    public function show(string $kode)
    {
        $item = PendidikanFormal::where('kode', $kode)->firstOrFail();
        $articles = Article::where('pendidikan_formal_id', $item->id)->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.pendidikan.show', compact('item', 'articles', 'categories', 'kode'));
    }

    public function update(Request $request, string $kode)
    {
        $item = PendidikanFormal::where('kode', $kode)->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:50',
            'akreditasi' => 'nullable|string|max:100',
            'jenjang' => 'nullable|string|max:100',
            'kepala_sekolah' => 'nullable|string|max:255',
            'nip_kepala_sekolah' => 'nullable|string|max:100',
            'sambutan_kepala_sekolah' => 'nullable|string',
            'foto_kepala_sekolah_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'deskripsi' => 'nullable|string',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'keunggulan_text' => 'nullable|string',
            'ekskul_text' => 'nullable|string',
        ]);

        // Upload foto gedung / utama lembaga
        if ($request->hasFile('foto_file')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_file'),
                'assets/images/pendidikan',
                $kode . '_',
                1280,
                800,
                85
            );
        }

        // Upload pasfoto Kepala Sekolah / Madrasah
        if ($request->hasFile('foto_kepala_sekolah_file')) {
            $validated['foto_kepala_sekolah'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_kepala_sekolah_file'),
                'assets/images/pendidikan',
                $kode . '_kepala_',
                800,
                800,
                85
            );
        }

        // Parse keunggulan (satu per baris)
        if ($request->filled('keunggulan_text')) {
            $lines = explode("\n", str_replace("\r", "", $request->keunggulan_text));
            $validated['keunggulan'] = array_values(array_filter(array_map('trim', $lines)));
        } else {
            $validated['keunggulan'] = [];
        }

        // Parse ekskul (satu per baris)
        if ($request->filled('ekskul_text')) {
            $lines = explode("\n", str_replace("\r", "", $request->ekskul_text));
            $validated['ekskul'] = array_values(array_filter(array_map('trim', $lines)));
        } else {
            $validated['ekskul'] = [];
        }

        // Parse jurusan (khusus SMK)
        if ($kode === 'smk' && $request->has('jurusan_data')) {
            $jurusanList = [];
            foreach ($request->jurusan_data as $j) {
                if (!empty($j['nama'])) {
                    $jurusanList[] = [
                        'kode' => $j['kode'] ?? 'JUR',
                        'nama' => $j['nama'],
                        'deskripsi' => $j['deskripsi'] ?? '',
                    ];
                }
            }
            $validated['jurusan'] = $jurusanList;
        }

        $item->update($validated);

        return back()->with('success', 'Profil dan tampilan dinamis ' . $item->nama . ' berhasil diperbarui!');
    }

    public function storeArticle(Request $request, string $kode)
    {
        $item = PendidikanFormal::where('kode', $kode)->firstOrFail();

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'tanggal_publikasi' => 'required|date',
            'tag' => 'nullable|string|max:100',
            'status' => 'required|in:published,draft',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail'] = ImageOptimizerService::convertAndSave(
                $request->file('thumbnail_file'),
                'assets/images/articles',
                'art_' . $kode . '_',
                1280,
                1280,
                82
            );
        }

        $validated['pendidikan_formal_id'] = $item->id;
        $validated['user_id'] = Auth::id();
        $validated['penulis'] = $validated['penulis'] ?: Auth::user()->name;
        $validated['slug'] = Str::slug($validated['judul']) . '-' . Str::random(5);

        Article::create($validated);

        return back()->with('success', 'Artikel / Berita untuk ' . $item->nama . ' berhasil diterbitkan!');
    }
}
