<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masayikh;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;

class MasayikhController extends Controller
{
    public function index()
    {
        $masayikhs = Masayikh::orderBy('urutan')->get();
        return view('admin.masayikh.index', compact('masayikhs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gelar' => 'nullable|string|max:255',
            'peran' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('foto_file')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_file'),
                'assets/images/masayikh',
                'masayikh_',
                1000,
                1000,
                85
            );
        }

        Masayikh::create($validated);

        return back()->with('success', 'Data Masayikh berhasil ditambahkan!');
    }

    public function update(Request $request, Masayikh $masayikh)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gelar' => 'nullable|string|max:255',
            'peran' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('foto_file')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_file'),
                'assets/images/masayikh',
                'masayikh_',
                1000,
                1000,
                85
            );
        }

        $masayikh->update($validated);

        return back()->with('success', 'Data Masayikh berhasil diperbarui!');
    }

    public function destroy(Masayikh $masayikh)
    {
        $masayikh->delete();
        return back()->with('success', 'Data Masayikh berhasil dihapus!');
    }
}
