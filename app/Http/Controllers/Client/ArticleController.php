<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a list of published articles.
     *
     * Responsibilities:
     * - Retrieve only published articles using the published scope
     * - Order articles by publication date (latest first)
     * - Apply pagination for the client-facing article list
     * - Render the client articles index page
     */
    public function index()
    {
        return view('pages.client.articles.index', [
            'articles' => Article::published()
                ->latest('published_at')
                ->paginate(6),
        ]);
    }

    /**
     * Display a single published article.
     *
     * Responsibilities:
     * - Receive the article instance via route model binding
     * - Render the client article detail page
     */
    public function show(Article $article)
    {
        return view('pages.client.articles.show', [
            'article' => $article,
        ]);
    }
}
