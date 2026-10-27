<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CeritaAlumni;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;

class CeritaAlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = CeritaAlumni::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('profesi', 'like', "%{$q}%")
                    ->orWhere('tahun_lulus', 'like', "%{$q}%")
                    ->orWhere('judul', 'like', "%{$q}%");
            });
        }

        $ceritas = $query->orderBy('urutan', 'asc')->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => CeritaAlumni::count(),
            'active' => CeritaAlumni::where('is_active', true)->count(),
        ];

        return view('admin.alumni.cerita', compact('ceritas', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_lulus' => 'required|string|max:50',
            'jenjang' => 'nullable|string|max:100',
            'profesi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi_cerita' => 'required|string',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'urutan' => 'nullable|integer',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto_file')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_file'),
                'assets/images/alumni',
                'alumni_',
                800,
                800,
                85
            );
        }

        CeritaAlumni::create($validated);

        return back()->with('success', "Cerita alumni dari '{$validated['nama']}' berhasil disimpan!");
    }

    public function update(Request $request, CeritaAlumni $cerita_alumnus)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_lulus' => 'required|string|max:50',
            'jenjang' => 'nullable|string|max:100',
            'profesi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi_cerita' => 'required|string',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'urutan' => 'nullable|integer',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('foto_file')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_file'),
                'assets/images/alumni',
                'alumni_',
                800,
                800,
                85
            );
        }

        $cerita_alumnus->update($validated);

        return back()->with('success', "Cerita alumni dari '{$cerita_alumnus->nama}' berhasil diperbarui!");
    }

    public function destroy(CeritaAlumni $cerita_alumnus)
    {
        $nama = $cerita_alumnus->nama;
        $cerita_alumnus->delete();

        return back()->with('success', "Cerita alumni '{$nama}' berhasil dihapus!");
    }
}
