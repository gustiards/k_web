<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource (Homepage).
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        
        $articles = Article::category($category)
            ->latest()
            ->paginate(9);

        $categories = ['Stocktake', 'Keepstock', 'Lainnya'];

        return view('articles.index', compact('articles', 'categories', 'category'));
    }

    /**
     * Show the form for creating a new resource (Admin Only).
     */
    public function create()
    {
        // Middleware 'auth' akan memastikan hanya admin yang bisa akses
        $categories = ['Stocktake', 'Keepstock', 'Lainnya'];
        
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage (Admin Only).
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Stocktake,Keepstock,Lainnya',
            'description' => 'required|string|max:100000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ], [
            'title.required' => 'Judul artikel wajib diisi',
            'category.required' => 'Kategori wajib dipilih',
            'description.required' => 'Deskripsi artikel wajib diisi',
            'description.max' => 'Deskripsi maksimal 100000 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar: jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        // Create article
        Article::create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $relatedArticles = $article->getRelatedArticles(3);
        
        return view('articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * Show the form for editing the specified resource (Admin Only).
     */
    public function edit(Article $article)
    {
        $categories = ['Stocktake', 'Keepstock', 'Lainnya'];
        
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage (Admin Only).
     */
    public function update(Request $request, Article $article)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Stocktake,Keepstock,Lainnya',
            'description' => 'required|string|max:100000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'title.required' => 'Judul artikel wajib diisi',
            'category.required' => 'Kategori wajib dipilih',
            'description.required' => 'Deskripsi artikel wajib diisi',
            'description.max' => 'Deskripsi maksimal 100000 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar: jpeg, png, jpg, gif',
            'image.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        // Update article
        $article->update($validated);

        return redirect()->route('articles.show', $article)
            ->with('success', 'Artikel berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage (Admin Only).
     */
    public function destroy(Article $article)
    {
        // Delete image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}