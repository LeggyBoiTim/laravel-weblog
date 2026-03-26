<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class ArticlePremiumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::where('is_premium', true)->get();
        $sortedArticles = $articles->sortByDesc('created_at');
        $categories = Category::all();
        $sortedCategories = $categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        return view('articles.index', ['title' => 'Premium Articles'], compact('sortedArticles', 'sortedCategories'));
    }
}
