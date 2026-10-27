<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Masayikh;
use App\Models\PsbRegistration;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArticles = Article::count();
        $totalViews = Article::sum('views');
        $totalPsb = PsbRegistration::count();
        $totalMasayikh = Masayikh::count();
        $totalSantri = Santri::count();
        $recentArticles = Article::with('category')->latest()->take(5)->get();
        $recentPsb = PsbRegistration::latest()->take(5)->get();
        $statistikWilayah = Santri::getStatistikWilayah();

        return view('admin.dashboard', compact(
            'totalArticles',
            'totalViews',
            'totalPsb',
            'totalMasayikh',
            'totalSantri',
            'recentArticles',
            'recentPsb',
            'statistikWilayah'
        ));
    }
}
