<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asrama;
use App\Models\Santri;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $asramas = Asrama::all();
        $query = Santri::with('asrama')->where('status', 'Alumni');

        if ($request->filled('asrama_id')) {
            $query->where('asrama_id', $request->asrama_id);
        }

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                  ->orWhere('nis', 'like', "%{$cari}%")
                  ->orWhere('jenjang', 'like', "%{$cari}%")
                  ->orWhere('alamat', 'like', "%{$cari}%");
            });
        }

        $alumnis = $query->latest()->paginate(15)->withQueryString();

        // Statistik Alumni
        $totalAlumni = Santri::where('status', 'Alumni')->count();
        $totalAlumniPutra = Santri::where('status', 'Alumni')->where('jenis_kelamin', 'Laki-laki')->count();
        $totalAlumniPutri = Santri::where('status', 'Alumni')->where('jenis_kelamin', 'Perempuan')->count();
        $totalSantriAktif = Santri::where('status', 'Aktif')->count();

        return view('admin.alumni.index', compact(
            'alumnis',
            'asramas',
            'totalAlumni',
            'totalAlumniPutra',
            'totalAlumniPutri',
            'totalSantriAktif'
        ));
    }
}
