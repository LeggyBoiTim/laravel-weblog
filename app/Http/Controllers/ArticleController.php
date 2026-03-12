<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        $sortedArticles = $articles->sortByDesc('created_at');
        $categories = Category::all();
        $sortedCategories = $categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        return view('articles.index', ['title' => 'All Articles'], compact('sortedArticles', 'sortedCategories'));
    }

    /**
     * Display a listing of the resource belonging to the user.
     */
    public function myArticles()
    {
        $articles = Auth::user()->articles;
        $sortedArticles = $articles->sortByDesc('created_at');
        $categories = Auth::user()->categories;
        $sortedCategories = $categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        return view('articles.index', ['title' => 'My Articles'], compact('sortedArticles', 'sortedCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create', ['categories' => Auth::user()->categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        Article::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ])->categories()->attach($request->categories);

        return redirect()->route('articles.my-articles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        return view('articles.edit', ['categories' => Auth::user()->categories], compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);

        $article->update([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);
        $article->categories()->sync($request->categories);

        return redirect()->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        $article->delete();
        return redirect()->route('articles.my-articles');
    }
}
