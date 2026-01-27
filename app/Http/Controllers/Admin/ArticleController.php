<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     *
     * Menampilkan halaman index artikel dengan pagination.
     */
    public function index()
    {
        return view('pages.admin.articles.index', [
            'articles' => Article::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new article.
     *
     * Menampilkan form tambah artikel.
     */
    public function create()
    {
        return view('pages.admin.articles.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * Menyimpan artikel baru ke database.
     * - Validasi input
     * - Upload thumbnail (jika ada)
     * - Handle publish / draft
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'excerpt'       => 'nullable|string',
            'content'       => 'required|string',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'author'        => 'nullable|string|max:100',
            'published_at'  => 'nullable|date',
            'is_published'  => 'required|boolean',
        ]);

        /**
         * Handle thumbnail upload
         */
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('articles', 'public');
        }

        /**
         * Publish logic
         * - Jika publish dan tanggal kosong → set now()
         * - Jika draft → published_at = null
         */
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if (!$validated['is_published']) {
            $validated['published_at'] = null;
        }

        Article::create($validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified article.
     *
     * Menampilkan form edit artikel.
     */
    public function edit(Article $article)
    {
        return view('pages.admin.articles.edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified article in storage.
     *
     * Mengupdate data artikel:
     * - Replace thumbnail jika ada upload baru
     * - Update publish status & tanggal
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'excerpt'       => 'nullable|string',
            'content'       => 'required|string',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'author'        => 'nullable|string|max:100',
            'published_at'  => 'nullable|date',
            'is_published'  => 'required|boolean',
        ]);

        /**
         * Handle thumbnail replacement
         */
        if ($request->hasFile('thumbnail')) {

            // Hapus thumbnail lama jika ada
            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('articles', 'public');
        }

        /**
         * Publish logic
         */
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if (!$validated['is_published']) {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified article from storage.
     *
     * Menghapus artikel beserta thumbnail-nya.
     */
    public function destroy(Article $article)
    {
        // Hapus thumbnail jika ada
        if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
