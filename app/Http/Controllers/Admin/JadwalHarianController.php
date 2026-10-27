<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalHarian;
use Illuminate\Http\Request;

class JadwalHarianController extends Controller
{
    public function index()
    {
        $jadwals = JadwalHarian::orderBy('urutan')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'waktu' => 'required|string|max:100',
            'kegiatan' => 'required|string',
            'urutan' => 'nullable|integer',
        ]);

        if (empty($validated['urutan'])) {
            $maxUrutan = JadwalHarian::max('urutan') ?? 0;
            $validated['urutan'] = $maxUrutan + 1;
        }

        JadwalHarian::create($validated);

        return back()->with('success', 'Jadwal kegiatan santri berhasil ditambahkan!');
    }

    public function update(Request $request, JadwalHarian $jadwal)
    {
        $validated = $request->validate([
            'waktu' => 'required|string|max:100',
            'kegiatan' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        $jadwal->update($validated);

        return back()->with('success', 'Jadwal kegiatan berhasil diperbarui!');
    }

    public function destroy(JadwalHarian $jadwal)
    {
        $jadwal->delete();
        return back()->with('success', 'Jadwal kegiatan santri berhasil dihapus!');
    }
}
