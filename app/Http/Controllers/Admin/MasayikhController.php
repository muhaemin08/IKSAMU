<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masayikh;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        try {
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

            unset($validated['foto_file']);

            if (!isset($validated['urutan']) || $validated['urutan'] === null) {
                $validated['urutan'] = (Masayikh::max('urutan') ?? 0) + 1;
            }

            Masayikh::create($validated);

            return back()->with('success', 'Data Masayikh berhasil ditambahkan!');
        } catch (\Throwable $e) {
            Log::error('Error storing masayikh: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan data Masayikh: ' . $e->getMessage());
        }
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

        try {
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

            unset($validated['foto_file']);

            $masayikh->update($validated);

            return back()->with('success', 'Data Masayikh berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Error updating masayikh: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data Masayikh: ' . $e->getMessage());
        }
    }

    public function destroy(Masayikh $masayikh)
    {
        try {
            $masayikh->delete();
            return back()->with('success', 'Data Masayikh berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Error deleting masayikh: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data Masayikh: ' . $e->getMessage());
        }
    }
}
