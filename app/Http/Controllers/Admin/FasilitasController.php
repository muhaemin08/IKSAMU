<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FasilitasController extends Controller
{
    public function index(Request $request)
    {
        $query = Fasilitas::query();

        if ($request->has('q') && $request->q) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('kategori', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%");
            });
        }

        $fasilitas = $query->orderBy('urutan', 'asc')->paginate(12)->withQueryString();

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['icon'] = $validated['icon'] ?? 'fa-building-columns';
        $validated['is_active'] = $request->has('is_active') ? true : true;

        if ($request->hasFile('foto')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto'),
                'assets/images/fasilitas',
                'fas_'
            );
        }

        Fasilitas::create($validated);

        return back()->with('success', "Fasilitas '{$validated['nama']}' berhasil ditambahkan!");
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'urutan' => 'nullable|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['icon'] = $validated['icon'] ?? 'fa-building-columns';
        $validated['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika bukan default
            if ($fasilita->foto && !str_contains($fasilita->foto, 'gedung-pesantren') && File::exists(public_path($fasilita->foto))) {
                @File::delete(public_path($fasilita->foto));
            }

            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto'),
                'assets/images/fasilitas',
                'fas_'
            );
        }

        $fasilita->update($validated);

        return back()->with('success', "Data fasilitas '{$fasilita->nama}' berhasil diperbarui!");
    }

    public function destroy(Fasilitas $fasilita)
    {
        $nama = $fasilita->nama;

        if ($fasilita->foto && !str_contains($fasilita->foto, 'gedung-pesantren') && File::exists(public_path($fasilita->foto))) {
            @File::delete(public_path($fasilita->foto));
        }

        $fasilita->delete();

        return back()->with('success', "Fasilitas '{$nama}' berhasil dihapus!");
    }
}
