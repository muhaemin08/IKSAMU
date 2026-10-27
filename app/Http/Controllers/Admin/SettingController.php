<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        // Handle File Uploads (Logo, Hero Image, Sambutan Foto) dengan auto-convert WebP & optimize
        if ($request->hasFile('logo_file')) {
            $logoPath = ImageOptimizerService::convertAndSave(
                $request->file('logo_file'),
                'assets/images',
                'logo_',
                800,
                800,
                90
            );
            Setting::set('logo_url', $logoPath, 'identitas');
        }

        // 1. Foto Hero Slide 1: Kompleks Pesantren
        if ($request->hasFile('hero_image_file')) {
            $heroPath = ImageOptimizerService::convertAndSave(
                $request->file('hero_image_file'),
                'assets/images',
                'hero_pesantren_',
                1920,
                1080,
                82
            );
            Setting::set('hero_image', $heroPath, 'hero');
        }

        // 2. Foto Hero Slide 2: MTs Miftahul Ulum
        if ($request->hasFile('hero_image_mts_file')) {
            $mtsPath = ImageOptimizerService::convertAndSave(
                $request->file('hero_image_mts_file'),
                'assets/images',
                'hero_mts_',
                1920,
                1080,
                82
            );
            Setting::set('hero_image_mts', $mtsPath, 'hero');
        }

        // 3. Foto Hero Slide 3: SMK Miftahul Ulum
        if ($request->hasFile('hero_image_smk_file')) {
            $smkPath = ImageOptimizerService::convertAndSave(
                $request->file('hero_image_smk_file'),
                'assets/images',
                'hero_smk_',
                1920,
                1080,
                82
            );
            Setting::set('hero_image_smk', $smkPath, 'hero');
        }

        if ($request->hasFile('sambutan_foto_file')) {
            $sambutanPath = ImageOptimizerService::convertAndSave(
                $request->file('sambutan_foto_file'),
                'assets/images',
                'pimpinan_',
                1000,
                1000,
                85
            );
            Setting::set('sambutan_foto', $sambutanPath, 'sambutan');
        }

        foreach ($data as $key => $value) {
            if (!in_array($key, ['logo_file', 'hero_image_file', 'hero_image_mts_file', 'hero_image_smk_file', 'sambutan_foto_file'])) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        return back()->with('success', 'Pengaturan dasar aplikasi berhasil diperbarui!');
    }
}
