<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ArticleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Auth::user()->articles;
        $sortedArticles = $articles->sortByDesc('created_at');
        $categories = Auth::user()->categories;
        $sortedCategories = $categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        return view('articles.index', ['title' => 'My Articles'], compact('sortedArticles', 'sortedCategories'));
    }
}
