<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::query();

        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('tingkat') && $request->tingkat) {
            $query->where('tingkat', $request->tingkat);
        }

        if ($request->has('q') && $request->q) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('judul', 'like', "%{$q}%")
                    ->orWhere('peraih', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhere('tahun', 'like', "%{$q}%");
            });
        }

        $prestasi = $query->orderBy('tahun', 'desc')->orderBy('urutan', 'asc')->paginate(12)->withQueryString();

        $stats = [
            'total' => Prestasi::count(),
            'keagamaan' => Prestasi::where('kategori', 'like', '%Keagamaan%')->orWhere('kategori', 'like', '%Kitab%')->count(),
            'akademik' => Prestasi::where('kategori', 'like', '%Akademik%')->orWhere('kategori', 'like', '%Teknologi%')->count(),
            'nasional' => Prestasi::where('tingkat', 'like', '%Nasional%')->count(),
        ];

        return view('admin.prestasi.index', compact('prestasi', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tingkat' => 'required|string|max:100',
            'tahun' => 'required|string|max:10',
            'peraih' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? true : true;

        if ($request->hasFile('foto')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto'),
                'assets/images/prestasi',
                'pres_'
            );
        }

        Prestasi::create($validated);

        return back()->with('success', "Prestasi '{$validated['judul']}' berhasil ditambahkan!");
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tingkat' => 'required|string|max:100',
            'tahun' => 'required|string|max:10',
            'peraih' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('foto')) {
            if ($prestasi->foto && !str_contains($prestasi->foto, 'gedung-pesantren') && File::exists(public_path($prestasi->foto))) {
                @File::delete(public_path($prestasi->foto));
            }

            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto'),
                'assets/images/prestasi',
                'pres_'
            );
        }

        $prestasi->update($validated);

        return back()->with('success', "Data prestasi '{$prestasi->judul}' berhasil diperbarui!");
    }

    public function destroy(Prestasi $prestasi)
    {
        $judul = $prestasi->judul;

        if ($prestasi->foto && !str_contains($prestasi->foto, 'gedung-pesantren') && File::exists(public_path($prestasi->foto))) {
            @File::delete(public_path($prestasi->foto));
        }

        $prestasi->delete();

        return back()->with('success', "Prestasi '{$judul}' berhasil dihapus!");
    }
}
