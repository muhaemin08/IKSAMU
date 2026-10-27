<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Services\ImageOptimizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'user']);

        if ($request->has('kategori') && $request->kategori) {
            $query->where('category_id', $request->kategori);
        }

        if ($request->has('cari') && $request->cari) {
            $query->where('judul', 'like', "%{$request->cari}%");
        }

        $articles = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'tanggal_publikasi' => 'required|date',
            'tag' => 'nullable|string|max:100',
            'status' => 'required|in:published,draft',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail'] = ImageOptimizerService::convertAndSave(
                $request->file('thumbnail_file'),
                'assets/images/articles',
                'art_',
                1280,
                1280,
                82
            );
        }

        $validated['user_id'] = Auth::id();
        $validated['penulis'] = $validated['penulis'] ?: Auth::user()->name;
        $validated['slug'] = Str::slug($validated['judul']) . '-' . Str::random(5);

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'konten' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'tanggal_publikasi' => 'required|date',
            'tag' => 'nullable|string|max:100',
            'status' => 'required|in:published,draft',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail'] = ImageOptimizerService::convertAndSave(
                $request->file('thumbnail_file'),
                'assets/images/articles',
                'art_',
                1280,
                1280,
                82
            );
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
