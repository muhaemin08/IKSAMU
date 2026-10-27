<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asrama;
use App\Models\Santri;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $asramas = Asrama::withCount('santris')->get();
        $query = Santri::with('asrama');

        // Filters
        if ($request->filled('asrama_id')) {
            $query->where('asrama_id', $request->asrama_id);
        }

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                  ->orWhere('nis', 'like', "%{$cari}%")
                  ->orWhere('kamar', 'like', "%{$cari}%")
                  ->orWhere('jenjang', 'like', "%{$cari}%");
            });
        }

        $santris = $query->latest()->paginate(15)->withQueryString();

        // Statistics
        $totalSantri = Santri::count();
        $totalPutra = Santri::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPutri = Santri::where('jenis_kelamin', 'Perempuan')->count();
        $totalAktif = Santri::where('status', 'Aktif')->count();

        return view('admin.santri.index', compact(
            'santris',
            'asramas',
            'totalSantri',
            'totalPutra',
            'totalPutri',
            'totalAktif'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asrama_id' => 'required|exists:asramas,id',
            'nis' => 'nullable|string|max:50|unique:santris,nis',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kamar' => 'nullable|string|max:100',
            'jenjang' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'nama_wali' => 'nullable|string|max:255',
            'telepon_wali' => 'nullable|string|max:50',
            'status' => 'required|in:Aktif,Alumni,Mutasi,Cuti',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('foto_file')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_file'),
                'assets/images/santri',
                'santri_',
                800,
                800,
                85
            );
        }

        Santri::create($validated);

        return back()->with('success', 'Data santri berhasil ditambahkan ke ' . Asrama::find($validated['asrama_id'])->nama . '!');
    }

    public function update(Request $request, Santri $santri)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asrama_id' => 'required|exists:asramas,id',
            'nis' => ['nullable', 'string', 'max:50', Rule::unique('santris', 'nis')->ignore($santri->id)],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kamar' => 'nullable|string|max:100',
            'jenjang' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'nama_wali' => 'nullable|string|max:255',
            'telepon_wali' => 'nullable|string|max:50',
            'status' => 'required|in:Aktif,Alumni,Mutasi,Cuti',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('foto_file')) {
            $validated['foto'] = ImageOptimizerService::convertAndSave(
                $request->file('foto_file'),
                'assets/images/santri',
                'santri_',
                800,
                800,
                85
            );
        }

        $santri->update($validated);

        return back()->with('success', 'Data santri ' . $santri->nama . ' berhasil diperbarui!');
    }

    public function destroy(Santri $santri)
    {
        $nama = $santri->nama;
        $santri->delete();

        return back()->with('success', 'Data santri ' . $nama . ' berhasil dihapus!');
    }

    /**
     * Export data santri ke file Excel (.xlsx)
     */
    public function export(Request $request)
    {
        $query = Santri::with('asrama');

        if ($request->filled('ids')) {
            $ids = is_array($request->ids) ? $request->ids : explode(',', $request->ids);
            $query->whereIn('id', $ids);
        } else {
            if ($request->filled('asrama_id')) {
                $query->where('asrama_id', $request->asrama_id);
            }
            if ($request->filled('jenis_kelamin')) {
                $query->where('jenis_kelamin', $request->jenis_kelamin);
            }
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('cari')) {
                $cari = $request->cari;
                $query->where(function ($q) use ($cari) {
                    $q->where('nama', 'like', "%{$cari}%")
                      ->orWhere('nis', 'like', "%{$cari}%")
                      ->orWhere('kamar', 'like', "%{$cari}%")
                      ->orWhere('jenjang', 'like', "%{$cari}%");
                });
            }
        }

        $santris = $query->orderBy('nama', 'asc')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Santri');

        // Header Tabel
        $headers = [
            'A1' => 'No',
            'B1' => 'NIS',
            'C1' => 'Nama Santri',
            'D1' => 'Jenis Kelamin',
            'E1' => 'Asrama',
            'F1' => 'Kamar',
            'G1' => 'Jenjang Formal',
            'H1' => 'Kelas',
            'I1' => 'Tempat Lahir',
            'J1' => 'Tanggal Lahir',
            'K1' => 'Alamat Domisili',
            'L1' => 'Desa / Kelurahan',
            'M1' => 'Kecamatan',
            'N1' => 'Kabupaten / Kota',
            'O1' => 'Provinsi',
            'P1' => 'Nama Wali',
            'Q1' => 'No. HP Wali',
            'R1' => 'Status',
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        $headerRange = 'A1:R1';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('064E3B'); // Emerald 900
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $rowNum = 2;
        $no = 1;
        foreach ($santris as $s) {
            $sheet->setCellValue('A' . $rowNum, $no++);
            $sheet->setCellValueExplicit('B' . $rowNum, (string)($s->nis ?? ''), DataType::TYPE_STRING);
            $sheet->setCellValue('C' . $rowNum, $s->nama);
            $sheet->setCellValue('D' . $rowNum, $s->jenis_kelamin);
            $sheet->setCellValue('E' . $rowNum, $s->asrama->nama ?? '-');
            $sheet->setCellValue('F' . $rowNum, $s->kamar ?? '-');
            $sheet->setCellValue('G' . $rowNum, $s->jenjang ?? '-');
            $sheet->setCellValue('H' . $rowNum, $s->kelas ?? '-');
            $sheet->setCellValue('I' . $rowNum, $s->tempat_lahir ?? '-');
            $sheet->setCellValue('J' . $rowNum, $s->tanggal_lahir ? $s->tanggal_lahir->format('Y-m-d') : '-');
            $sheet->setCellValue('K' . $rowNum, $s->alamat ?? '-');
            $sheet->setCellValue('L' . $rowNum, $s->desa ?? '-');
            $sheet->setCellValue('M' . $rowNum, $s->kecamatan ?? '-');
            $sheet->setCellValue('N' . $rowNum, $s->kabupaten ?? '-');
            $sheet->setCellValue('O' . $rowNum, $s->provinsi ?? 'Jawa Barat');
            $sheet->setCellValue('P' . $rowNum, $s->nama_wali ?? '-');
            $sheet->setCellValueExplicit('Q' . $rowNum, (string)($s->telepon_wali ?? ''), DataType::TYPE_STRING);
            $sheet->setCellValue('R' . $rowNum, $s->status ?? 'Aktif');
            $rowNum++;
        }

        foreach (range('A', 'R') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Data_Santri_Miftahul_Ulum_' . date('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Download Template File Excel untuk Import
     */
    public function template()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template Import Santri');

        $headers = [
            'A1' => 'NIS',
            'B1' => 'Nama Santri *',
            'C1' => 'Jenis Kelamin * (Laki-laki / Perempuan)',
            'D1' => 'Asrama * (Selamet / Rahayu / Al-Hidayah Lama / Al-Hidayah Baru)',
            'E1' => 'Kamar',
            'F1' => 'Jenjang Formal (MTs / SMK / Salafiyah)',
            'G1' => 'Kelas',
            'H1' => 'Tempat Lahir',
            'I1' => 'Tanggal Lahir (YYYY-MM-DD)',
            'J1' => 'Alamat Domisili',
            'K1' => 'Desa / Kelurahan',
            'L1' => 'Kecamatan',
            'M1' => 'Kabupaten / Kota',
            'N1' => 'Provinsi',
            'O1' => 'Nama Wali',
            'P1' => 'No. HP Wali',
            'Q1' => 'Status (Aktif / Alumni / Mutasi / Cuti)',
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        $headerRange = 'A1:Q1';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('1E3A8A'); // Blue dark

        $samples = [
            [
                '2026001',
                'Muhammad Rayhan Al-Fatih',
                'Laki-laki',
                'Asrama Selamet',
                'Kamar Abu Bakar 01',
                'MTs Miftahul Ulum',
                'VII-A',
                'Tasikmalaya',
                '2012-04-10',
                'Kp. Babakan RT 01 RW 02',
                'Sodonghilir',
                'Sodonghilir',
                'Tasikmalaya',
                'Jawa Barat',
                'Ahmad Syahroni',
                '081234567890',
                'Aktif'
            ],
            [
                '2026002',
                'Fatimah Az-Zahra',
                'Perempuan',
                'Asrama Al-Hidayah Baru',
                'Kamar Aisyah 03',
                'SMK YAPIM - RPL',
                'X-RPL',
                'Garut',
                '2010-08-22',
                'Jl. Raya Tarogong No. 45',
                'Tarogong Kidul',
                'Tarogong Kidul',
                'Garut',
                'Jawa Barat',
                'H. Mansyur Hidayat',
                '082198765432',
                'Aktif'
            ]
        ];

        $r = 2;
        foreach ($samples as $row) {
            $sheet->setCellValueExplicit('A' . $r, $row[0], DataType::TYPE_STRING);
            $sheet->setCellValue('B' . $r, $row[1]);
            $sheet->setCellValue('C' . $r, $row[2]);
            $sheet->setCellValue('D' . $r, $row[3]);
            $sheet->setCellValue('E' . $r, $row[4]);
            $sheet->setCellValue('F' . $r, $row[5]);
            $sheet->setCellValue('G' . $r, $row[6]);
            $sheet->setCellValue('H' . $r, $row[7]);
            $sheet->setCellValue('I' . $r, $row[8]);
            $sheet->setCellValue('J' . $r, $row[9]);
            $sheet->setCellValue('K' . $r, $row[10]);
            $sheet->setCellValue('L' . $r, $row[11]);
            $sheet->setCellValue('M' . $r, $row[12]);
            $sheet->setCellValue('N' . $r, $row[13]);
            $sheet->setCellValue('O' . $r, $row[14]);
            $sheet->setCellValueExplicit('P' . $r, $row[15], DataType::TYPE_STRING);
            $sheet->setCellValue('Q' . $r, $row[16]);
            $r++;
        }

        foreach (range('A', 'Q') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Template_Import_Santri_Miftahul_Ulum.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Import data santri dari file Excel (.xlsx / .csv)
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        if (count($rows) <= 1) {
            return back()->with('error', 'File Excel kosong atau tidak memiliki baris data!');
        }

        $asramas = Asrama::all();
        $defaultPutra = $asramas->firstWhere('jenis_kelamin', 'Laki-laki') ?? $asramas->first();
        $defaultPutri = $asramas->firstWhere('jenis_kelamin', 'Perempuan') ?? $asramas->first();

        $headerRow = array_shift($rows);
        $map = [];
        foreach ($headerRow as $col => $title) {
            $clean = strtolower(trim((string)$title));
            if (str_contains($clean, 'kelamin') || $clean === 'jk' || str_contains($clean, 'gender')) {
                $map['jenis_kelamin'] = $col;
            } elseif ($clean === 'nis' || preg_match('/\bnis\b/i', $clean)) {
                $map['nis'] = $col;
            } elseif (str_contains($clean, 'nama santri') || $clean === 'nama') {
                $map['nama'] = $col;
            } elseif (str_contains($clean, 'asrama')) {
                $map['asrama'] = $col;
            } elseif (str_contains($clean, 'kamar')) {
                $map['kamar'] = $col;
            } elseif (str_contains($clean, 'jenjang')) {
                $map['jenjang'] = $col;
            } elseif (str_contains($clean, 'kelas')) {
                $map['kelas'] = $col;
            } elseif (str_contains($clean, 'tempat')) {
                $map['tempat_lahir'] = $col;
            } elseif (str_contains($clean, 'tanggal')) {
                $map['tanggal_lahir'] = $col;
            } elseif (str_contains($clean, 'alamat')) {
                $map['alamat'] = $col;
            } elseif (str_contains($clean, 'desa') || str_contains($clean, 'kelurahan')) {
                $map['desa'] = $col;
            } elseif (str_contains($clean, 'kecamatan') || $clean === 'kec') {
                $map['kecamatan'] = $col;
            } elseif (str_contains($clean, 'kabupaten') || str_contains($clean, 'kota') || $clean === 'kab') {
                $map['kabupaten'] = $col;
            } elseif (str_contains($clean, 'provinsi') || str_contains($clean, 'prov')) {
                $map['provinsi'] = $col;
            } elseif (str_contains($clean, 'wali') && !str_contains($clean, 'hp') && !str_contains($clean, 'tel')) {
                $map['nama_wali'] = $col;
            } elseif (str_contains($clean, 'hp') || str_contains($clean, 'telepon') || str_contains($clean, 'kontak')) {
                $map['telepon_wali'] = $col;
            } elseif (str_contains($clean, 'status')) {
                $map['status'] = $col;
            }
        }

        if (empty($map['nama'])) {
            return back()->with('error', 'Kolom "Nama Santri" tidak ditemukan pada file Excel. Pastikan menggunakan format template yang disediakan.');
        }

        $inserted = 0;
        $updated = 0;

        foreach ($rows as $row) {
            $nama = trim((string)($row[$map['nama']] ?? ''));
            if (empty($nama)) continue;

            $nis = isset($map['nis']) ? trim((string)$row[$map['nis']]) : null;
            $rawJk = isset($map['jenis_kelamin']) ? strtolower(trim((string)$row[$map['jenis_kelamin']])) : '';
            $isPutri = str_contains($rawJk, 'perempuan') || str_contains($rawJk, 'putri') || $rawJk === 'p';
            $jenisKelamin = $isPutri ? 'Perempuan' : 'Laki-laki';

            // Find Asrama
            $asramaNama = isset($map['asrama']) ? trim((string)$row[$map['asrama']]) : '';
            $asrama = null;
            if (!empty($asramaNama)) {
                $asrama = $asramas->first(function ($a) use ($asramaNama) {
                    return stripos($a->nama, $asramaNama) !== false || stripos($asramaNama, $a->nama) !== false;
                });
            }
            if (!$asrama) {
                $asrama = $isPutri ? $defaultPutri : $defaultPutra;
            }

            // Parse Tanggal Lahir
            $tglLahir = null;
            if (isset($map['tanggal_lahir']) && !empty($row[$map['tanggal_lahir']])) {
                $valTgl = $row[$map['tanggal_lahir']];
                if (is_numeric($valTgl)) {
                    $tglLahir = ExcelDate::excelToDateTimeObject($valTgl)->format('Y-m-d');
                } else {
                    $parsed = strtotime($valTgl);
                    if ($parsed !== false) {
                        $tglLahir = date('Y-m-d', $parsed);
                    }
                }
            }

            $rawStatus = isset($map['status']) ? trim((string)$row[$map['status']]) : 'Aktif';
            $status = in_array(ucfirst(strtolower($rawStatus)), ['Aktif', 'Alumni', 'Mutasi', 'Cuti']) ? ucfirst(strtolower($rawStatus)) : 'Aktif';

            $data = [
                'asrama_id' => $asrama ? $asrama->id : 1,
                'nama' => $nama,
                'jenis_kelamin' => $jenisKelamin,
                'kamar' => isset($map['kamar']) ? trim((string)$row[$map['kamar']]) : null,
                'jenjang' => isset($map['jenjang']) ? trim((string)$row[$map['jenjang']]) : null,
                'kelas' => isset($map['kelas']) ? trim((string)$row[$map['kelas']]) : null,
                'tempat_lahir' => isset($map['tempat_lahir']) ? trim((string)$row[$map['tempat_lahir']]) : null,
                'tanggal_lahir' => $tglLahir,
                'alamat' => isset($map['alamat']) ? trim((string)$row[$map['alamat']]) : null,
                'desa' => isset($map['desa']) ? trim((string)$row[$map['desa']]) : null,
                'kecamatan' => isset($map['kecamatan']) ? trim((string)$row[$map['kecamatan']]) : null,
                'kabupaten' => isset($map['kabupaten']) ? trim((string)$row[$map['kabupaten']]) : null,
                'provinsi' => isset($map['provinsi']) ? trim((string)$row[$map['provinsi']]) : 'Jawa Barat',
                'nama_wali' => isset($map['nama_wali']) ? trim((string)$row[$map['nama_wali']]) : null,
                'telepon_wali' => isset($map['telepon_wali']) ? trim((string)$row[$map['telepon_wali']]) : null,
                'status' => $status,
            ];

            // Jika NIS ada di file dan sudah terdaftar di database, perbarui datanya
            if (!empty($nis)) {
                $existing = Santri::where('nis', $nis)->first();
                if ($existing) {
                    $existing->update($data);
                    $updated++;
                    continue;
                }
                $data['nis'] = $nis;
            }

            Santri::create($data);
            $inserted++;
        }

        return back()->with('success', "Proses import data santri berhasil! {$inserted} santri baru ditambahkan, {$updated} data santri diperbarui.");
    }

    /**
     * Hapus massal santri terpilih (Bulk Delete) atau Hapus Semua
     */
    public function bulkDelete(Request $request)
    {
        if ($request->input('mode') === 'all') {
            $count = Santri::count();
            Santri::query()->delete();
            return back()->with('success', "Seluruh data santri ({$count} santri) berhasil dihapus dari database!");
        }

        $ids = $request->input('ids', []);
        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }

        $ids = array_filter(array_map('intval', (array)$ids));

        if (empty($ids)) {
            return back()->with('error', 'Tidak ada santri yang dipilih untuk dihapus.');
        }

        $count = Santri::whereIn('id', $ids)->delete();

        return back()->with('success', "Sebanyak {$count} santri yang dipilih berhasil dihapus dari database!");
    }
}
