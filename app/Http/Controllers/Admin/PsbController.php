<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsbRegistration;
use Illuminate\Http\Request;

class PsbController extends Controller
{
    public function index(Request $request)
    {
        $query = PsbRegistration::query();

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('q') && $request->q) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_santri', 'like', "%{$q}%")
                    ->orWhere('nama_wali', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%")
                    ->orWhere('alamat_asal', 'like', "%{$q}%");
            });
        }

        $registrations = $query->latest()->paginate(15)->withQueryString();

        $stats = [
            'total' => PsbRegistration::count(),
            'pending' => PsbRegistration::where('status', 'pending')->count(),
            'diverifikasi' => PsbRegistration::where('status', 'diverifikasi')->count(),
            'diterima' => PsbRegistration::where('status', 'diterima')->count(),
            'ditolak' => PsbRegistration::where('status', 'ditolak')->count(),
        ];

        return view('admin.psb.index', compact('registrations', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_santri' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'pilihan_pendidikan' => 'required|string',
            'pilihan_asrama' => 'required|string',
            'nama_wali' => 'required|string|max:255',
            'no_hp' => 'required|string|max:30',
            'alamat_asal' => 'required|string',
            'status' => 'nullable|string|in:pending,diverifikasi,diterima,ditolak',
        ]);

        $validated['status'] = $validated['status'] ?? 'pending';

        PsbRegistration::create($validated);

        return back()->with('success', 'Data calon santri baru berhasil disimpan di database admin!');
    }

    public function terimaSantri(PsbRegistration $registration)
    {
        $registration->update(['status' => 'diterima']);

        // Masukkan atau sinkronkan langsung ke tabel database santri jika belum ada
        $exists = \App\Models\Santri::where('nama', $registration->nama_santri)
            ->where('telepon_wali', $registration->no_hp)
            ->first();

        if (!$exists) {
            $asrama = \App\Models\Asrama::where('nama', 'LIKE', '%' . explode(' ', $registration->pilihan_asrama)[0] . '%')->first();

            \App\Models\Santri::create([
                'nama' => $registration->nama_santri,
                'jenis_kelamin' => str_contains(strtolower($registration->jenis_kelamin), 'putri') || str_contains(strtolower($registration->jenis_kelamin), 'perempuan') ? 'Perempuan' : 'Laki-laki',
                'jenjang' => $registration->pilihan_pendidikan,
                'nama_wali' => $registration->nama_wali,
                'telepon_wali' => $registration->no_hp,
                'alamat' => $registration->alamat_asal,
                'status' => 'Aktif',
                'asrama_id' => $asrama ? $asrama->id : null,
                'nis' => date('y') . str_pad($registration->id, 4, '0', STR_PAD_LEFT),
            ]);
        }

        return back()->with('success', "Calon santri {$registration->nama_santri} berhasil DITERIMA dan dimasukkan ke Database Santri Aktif!");
    }

    public function updateStatus(Request $request, PsbRegistration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,diverifikasi,diterima,ditolak',
        ]);

        $registration->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftaran santri berhasil diperbarui!');
    }

    public function destroy(PsbRegistration $registration)
    {
        $registration->delete();
        return back()->with('success', 'Data pendaftar berhasil dihapus!');
    }
}
