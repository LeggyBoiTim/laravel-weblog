<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
     * Display a listing of the resource marked as premium.
     */
    public function premiumArticles()
    {
        $articles = Article::where('is_premium', true)->get();
        $sortedArticles = $articles->sortByDesc('created_at');
        $categories = Category::all();
        $sortedCategories = $categories->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
        return view('articles.index', ['title' => 'Premium Articles'], compact('sortedArticles', 'sortedCategories'));
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
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        Article::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
            'is_premium' => $request->is_premium ? true : false,
        ])->categories()->attach($request->categories);

        return redirect()->route('articles.my-articles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        if ($article->is_premium && !Auth::user()->has_premium) {
            abort(403, 'No access to premium articles.');
        }
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

        $updateData = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'is_premium' => $request->is_premium ? true : false,
        ];

        if ($request->hasFile('image')) {
            if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
                Storage::disk('public')->delete($article->image_path);
            }
            $updateData['image_path'] = $request->file('image')->store('images', 'public');
        }

        $article->update($updateData);
        $article->categories()->sync($request->categories);

        return redirect()->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();
        return redirect()->route('articles.my-articles');
    }

    /**
     * Remove the image from the specified resource.
     */
    public function destroyImage(Article $article)
    {
        Gate::authorize('update', $article);

        if ($article->image_path && Storage::disk('public')->exists($article->image_path)) {
            Storage::disk('public')->delete($article->image_path);
        }
        $article->update(['image_path' => null]);

        return redirect()->route('articles.show', $article);
    }
}
