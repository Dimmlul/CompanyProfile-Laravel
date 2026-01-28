<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display list of published articles.
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
     * Display single article by slug.
     */
    public function show(Article $article)
    {
        return view('pages.client.articles.show', [
            'article' => $article,
        ]);
    }
}
