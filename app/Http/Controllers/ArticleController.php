<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::all();
        $sortedArticles = $articles->sortByDesc('created_at');
        return view('articles.index', compact('sortedArticles'), ['title' => 'All Articles']);
    }

    /**
     * Display a listing of the resource belonging to the user.
     */
    public function myArticles()
    {
        $articles = Auth::user()->articles;
        $sortedArticles = $articles->sortByDesc('created_at');
        return view('articles.index', compact('sortedArticles'), ['title' => 'My Articles']);
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
        return view('articles.edit', ['categories' => Auth::user()->categories], compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
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
        $article->delete();
        return redirect()->route('articles.my-articles');
    }
}
