<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsbBiaya;
use Illuminate\Http\Request;

class PsbBiayaController extends Controller
{
    public function index()
    {
        $biayas = PsbBiaya::orderBy('urutan', 'asc')->get();

        $totalMts = $biayas->where('is_active', true)->sum('nominal_mts');
        $totalSmk = $biayas->where('is_active', true)->sum('nominal_smk');

        return view('admin.psb.biaya', compact('biayas', 'totalMts', 'totalSmk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'nominal_mts' => 'required|numeric|min:0',
            'nominal_smk' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $validated['urutan'] = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->has('is_active') ? true : true;

        PsbBiaya::create($validated);

        return back()->with('success', "Komponen biaya '{$validated['nama_biaya']}' berhasil ditambahkan!");
    }

    public function update(Request $request, PsbBiaya $biaya)
    {
        $validated = $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'nominal_mts' => 'required|numeric|min:0',
            'nominal_smk' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active') ? true : false;

        $biaya->update($validated);

        return back()->with('success', "Komponen biaya '{$biaya->nama_biaya}' berhasil diperbarui!");
    }

    public function updateBatch(Request $request)
    {
        $items = $request->input('biaya', []);

        foreach ($items as $id => $data) {
            $biaya = PsbBiaya::find($id);
            if ($biaya) {
                $biaya->update([
                    'nominal_mts' => (int) ($data['nominal_mts'] ?? $biaya->nominal_mts),
                    'nominal_smk' => (int) ($data['nominal_smk'] ?? $biaya->nominal_smk),
                    'keterangan' => $data['keterangan'] ?? $biaya->keterangan,
                    'is_active' => isset($data['is_active']),
                ]);
            }
        }

        return back()->with('success', 'Seluruh rincian nominal biaya pendaftaran santri baru berhasil diperbarui!');
    }

    public function destroy(PsbBiaya $biaya)
    {
        $nama = $biaya->nama_biaya;
        $biaya->delete();

        return back()->with('success', "Komponen biaya '{$nama}' berhasil dihapus!");
    }
}
