<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    
    /**
     * Display a paginated list of articles.
     *
     * Responsibilities:
     * - Retrieve articles ordered by latest
     * - Apply pagination
     * - Render the admin articles index page
     */
    public function index()
    {
        /**
         * Retrieve the currently authenticated user.
         */
        $user = Auth::user();

        /**
         * Prevent non-admin users from accessing the admin dashboard.
         */

        abort_if(!$user?->isAdmin(), 403);
        return view('pages.admin.articles.index', [
            'articles' => Article::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new article.
     *
     * Responsibilities:
     * - Render the article creation form
     */
    public function create()
    {
        return view('pages.admin.articles.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * Responsibilities:
     * - Validate incoming request data
     * - Handle thumbnail upload (if provided)
     * - Apply publish / draft logic
     * - Persist article data to the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'excerpt'       => 'nullable|string',
            'content'       => 'required|string',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'        => 'nullable|string|max:100',
            'published_at'  => 'nullable|date',
            'is_published'  => 'required|boolean',
        ]);

        /**
         * Handle thumbnail upload.
         * If a thumbnail is provided, store it in public storage.
         */
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('articles', 'public');
        }

        /**
         * Publish state handling:
         * - If published and publish date is empty, set it to current time
         * - If draft, force published_at to null
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
     * Responsibilities:
     * - Load the article data
     * - Render the edit form
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
     * Responsibilities:
     * - Validate updated input data
     * - Replace thumbnail if a new one is uploaded
     * - Update publish status and publish date
     * - Persist changes to the database
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'excerpt'       => 'nullable|string',
            'content'       => 'required|string',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'        => 'nullable|string|max:100',
            'published_at'  => 'nullable|date',
            'is_published'  => 'required|boolean',
        ]);

        /**
         * Handle thumbnail replacement.
         * If a new thumbnail is uploaded:
         * - Delete the old thumbnail from storage
         * - Store the new thumbnail
         */
        if ($request->hasFile('thumbnail')) {

            // Remove existing thumbnail if it exists
            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('articles', 'public');
        }

        /**
         * Publish state handling.
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
     * Responsibilities:
     * - Delete the article thumbnail (if exists)
     * - Remove the article record from the database
     */
    public function destroy(Article $article)
    {
        // Delete thumbnail file if it exists
        if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
